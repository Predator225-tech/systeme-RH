<?php

namespace App\Controllers;

use App\Models\CongeModel;
use App\Models\TypeCongeModel;
use App\Models\SoldeModel;

class User extends BaseController
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
        $userId = session()->get('user_id');
        if (!$userId) return redirect()->to('/login');

        // Récupérer les soldes de l'employé
        $soldes = $this->soldeModel->where('employe_id', $userId)
                                   ->where('annee', date('Y'))
                                   ->findAll();

        // Récupérer l'historique des demandes
        $db = \Config\Database::connect();
        $builder = $db->table('conges');
        $builder->select('conges.*, types_conge.libelle as type_conge');
        $builder->join('types_conge', 'types_conge.id = conges.type_conge_id');
        $builder->where('conges.employe_id', $userId);
        $builder->orderBy('conges.created_at', 'DESC');
        $historique = $builder->get()->getResultArray();

        $data = [
            'title' => 'Mon Espace',
            'soldes' => $soldes,
            'historique' => $historique,
            'typesConge' => $this->typeCongeModel->findAll() // Pour associer le libellé aux soldes plus facilement
        ];

        return view('user/index', $data);
    }

    public function demander()
    {
        $userId = session()->get('user_id');
        if (!$userId) return redirect()->to('/login');

        $data = [
            'title' => 'Demander un congé',
            'typesConge' => $this->typeCongeModel->findAll()
        ];
        return view('user/demander', $data);
    }

    public function store()
    {
        $userId = session()->get('user_id');
        if (!$userId) return redirect()->to('/login');

        $typeId = $this->request->getPost('type_conge_id');
        $dateDebut = $this->request->getPost('date_debut');
        $dateFin = $this->request->getPost('date_fin');
        $motif = $this->request->getPost('motif');

        // Calculer nb jours (basique)
        $d1 = new \DateTime($dateDebut);
        $d2 = new \DateTime($dateFin);
        $nbJours = $d1->diff($d2)->days + 1; // +1 pour inclure le premier et dernier jour

        if ($nbJours <= 0) {
            return redirect()->back()->withInput()->with('error', 'Dates invalides.');
        }

        $this->congeModel->insert([
            'employe_id' => $userId,
            'type_conge_id' => $typeId,
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
            'nb_jours' => $nbJours,
            'motif' => $motif,
            'statut' => 'en_attente'
        ]);

        return redirect()->to('/user')->with('success', 'Votre demande de congé a bien été envoyée.');
    }
}