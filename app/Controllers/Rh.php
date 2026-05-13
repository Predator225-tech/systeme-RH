<?php

namespace App\Controllers;

use App\Models\CongeModel;
use App\Models\TypeCongeModel;
use App\Models\SoldeModel;

class Rh extends BaseController
{
    protected $congeModel;
    protected $typeCongeModel;
    protected $soldeModel;

    public function __construct()
    {
        $this->congeModel = new CongeModel();
        $this->typeCongeModel = new TypeCongeModel();
        $this->soldeModel = new SoldeModel();
    }

    public function index()
    {
        if (session()->get('role') !== 'rh' && session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $builder = $db->table('conges');
        $builder->select('conges.*, employes.nom, employes.prenom, types_conge.libelle as type_conge');
        $builder->join('employes', 'employes.id = conges.employe_id');
        $builder->join('types_conge', 'types_conge.id = conges.type_conge_id');
        $builder->where('conges.statut', 'en_attente');
        $demandes = $builder->get()->getResultArray();

        
        // Fetch soldes for all employees except admin and current RH
        $builderSoldes = $db->table('soldes');
        $builderSoldes->select('soldes.*, employes.nom, employes.prenom, types_conge.libelle as type_conge');
        $builderSoldes->join('employes', 'employes.id = soldes.employe_id');
        $builderSoldes->join('types_conge', 'types_conge.id = soldes.type_conge_id');
        $builderSoldes->where('employes.role !=', 'admin');
        $builderSoldes->where('employes.id !=', session()->get('user_id'));
        $soldes_employes = $builderSoldes->get()->getResultArray();

        $data = [
            'title' => 'Espace RH - Demandes en attente',
            'demandes' => $demandes,
            'soldes_employes' => $soldes_employes
        ];


        return view('rh/index', $data);
    }

    public function traiter($id)
    {
        if (session()->get('role') !== 'rh' && session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $action = $this->request->getPost('action'); // 'approuver' ou 'refuser'
        $conge = $this->congeModel->find($id);

        if (!$conge || $conge['statut'] !== 'en_attente') {
            return redirect()->to('/rh')->with('error', 'Demande invalide ou déjà traitée.');
        }

        if ($action === 'approuver') {
            $this->congeModel->update($id, [
                'statut' => 'approuvee',
                'traite_par' => session()->get('user_id')
            ]);

            // Deduction logique des soldes
            $solde = $this->soldeModel->where('employe_id', $conge['employe_id'])
                                      ->where('type_conge_id', $conge['type_conge_id'])
                                      ->where('annee', date('Y'))
                                      ->first();

            if ($solde) {
                $this->soldeModel->update($solde['id'], [
                    'jours_pris' => $solde['jours_pris'] + $conge['nb_jours'],
                    'jours_attribues' => $solde['jours_attribues'] - $conge['nb_jours']
                ]);
            } else {
                // If it doesn't exist, create it with default values from type
                $type = $this->typeCongeModel->find($conge['type_conge_id']);
                $this->soldeModel->insert([
                    'employe_id' => $conge['employe_id'],
                    'type_conge_id' => $conge['type_conge_id'],
                    'annee' => date('Y'),
                    'jours_attribues' => ($type ? $type['jours_annuels'] : 0) - $conge['nb_jours'],
                    'jours_pris' => $conge['nb_jours']
                ]);
            }

            return redirect()->to('/rh')->with('success', 'Congé approuvé avec succès.');

        } else {
            $this->congeModel->update($id, [
                'statut' => 'refusee',
                'traite_par' => session()->get('user_id')
            ]);
            return redirect()->to('/rh')->with('success', 'Congé refusé.');
        }
    }
}