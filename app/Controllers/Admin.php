<?php

namespace App\Controllers;

use App\Models\Employe;
use App\Models\Departement;
use App\Models\TypeCongeModel;

class Admin extends BaseController
{
    protected $employeModel;
    protected $departementModel;
    protected $typeCongeModel;

    public function __construct()
    {
        $this->employeModel = new Employe();
        $this->departementModel = new Departement();
        $this->typeCongeModel = new TypeCongeModel();
    }

    /**
     * Affiche le tableau de bord admin
     */
    public function index()
    {
        $data = [
            'title' => 'Tableau de bord Admin',
            'totalEmployes' => $this->employeModel->countAll(),
            'totalDepartements' => $this->departementModel->countAll(),
            'employesActifs' => $this->employeModel->where('actif', 1)->countAllResults(),
            'totalTypesConge' => $this->typeCongeModel->countAll(),
        ];

        return view('admin/index', $data);
    }

    // ============ EMPLOYES ============

    /**
     * Liste tous les employés
     */
    public function employes()
    {
        $employes = $this->employeModel->findAll();
        $departements = $this->departementModel->findAll();
        
        $data = [
            'title' => 'Gestion des Employés',
            'employes' => $employes,
            'departements' => $departements,
        ];

        return view('admin/employes/index', $data);
    }

    /**
     * Formulaire de création d'employé
     */
    public function createEmploye()
    {
        $departements = $this->departementModel->findAll();
        
        $data = [
            'title' => 'Créer un Employé',
            'departements' => $departements,
            'employe' => null,
        ];

        return view('admin/employes/form', $data);
    }

    /**
     * Sauvegarde un nouvel employé
     */
    public function storeEmploye()
    {
        $input = $this->request->getPost();

        // Hash le mot de passe
        if (!empty($input['password'])) {
            $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
        }

        if (!$this->employeModel->save($input)) {
            return redirect()->back()->withInput()->with('errors', $this->employeModel->errors());
        }

        return redirect()->to('/admin/employes')->with('success', 'Employé créé avec succès.');
    }

    /**
     * Formulaire de modification d'employé
     */
    public function editEmploye($id)
    {
        $employe = $this->employeModel->find($id);

        if (!$employe) {
            return redirect()->to('/admin/employes')->with('error', 'Employé non trouvé.');
        }

        $departements = $this->departementModel->findAll();

        $data = [
            'title' => 'Modifier l\'Employé',
            'employe' => $employe,
            'departements' => $departements,
        ];

        return view('admin/employes/form', $data);
    }

    /**
     * Met à jour un employé
     */
    public function updateEmploye($id)
    {
        $employe = $this->employeModel->find($id);

        if (!$employe) {
            return redirect()->to('/admin/employes')->with('error', 'Employé non trouvé.');
        }

        $input = $this->request->getPost();
        $input['id'] = $id;

        // Hash le mot de passe seulement s'il est fourni
        if (!empty($input['password'])) {
            $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
        } else {
            // Si vide, on supprime le champ pour ne pas l'écraser
            unset($input['password']);
        }

        if (!$this->employeModel->save($input)) {
            return redirect()->back()->withInput()->with('errors', $this->employeModel->errors());
        }

        return redirect()->to('/admin/employes')->with('success', 'Employé mis à jour avec succès.');
    }

    /**
     * Supprime un employé
     */
    public function deleteEmploye($id)
    {
        $employe = $this->employeModel->find($id);

        if (!$employe) {
            return redirect()->to('/admin/employes')->with('error', 'Employé non trouvé.');
        }

        $this->employeModel->delete($id);

        return redirect()->to('/admin/employes')->with('success', 'Employé supprimé avec succès.');
    }

    // ============ DEPARTEMENTS ============

    /**
     * Liste tous les départements
     */
    public function departements()
    {
        $departements = $this->departementModel->findAll();

        $data = [
            'title' => 'Gestion des Départements',
            'departements' => $departements,
        ];

        return view('admin/departements/index', $data);
    }

    /**
     * Formulaire de création de département
     */
    public function createDepartement()
    {
        $data = [
            'title' => 'Créer un Département',
            'departement' => null,
        ];

        return view('admin/departements/form', $data);
    }

    /**
     * Sauvegarde un nouveau département
     */
    public function storeDepartement()
    {
        $input = $this->request->getPost();

        if (!$this->departementModel->save($input)) {
            return redirect()->back()->withInput()->with('errors', $this->departementModel->errors());
        }

        return redirect()->to('/admin/departements')->with('success', 'Département créé avec succès.');
    }

    /**
     * Formulaire de modification de département
     */
    public function editDepartement($id)
    {
        $departement = $this->departementModel->find($id);

        if (!$departement) {
            return redirect()->to('/admin/departements')->with('error', 'Département non trouvé.');
        }

        $data = [
            'title' => 'Modifier le Département',
            'departement' => $departement,
        ];

        return view('admin/departements/form', $data);
    }

    /**
     * Met à jour un département
     */
    public function updateDepartement($id)
    {
        $departement = $this->departementModel->find($id);

        if (!$departement) {
            return redirect()->to('/admin/departements')->with('error', 'Département non trouvé.');
        }

        $input = $this->request->getPost();
        $input['id'] = $id;

        if (!$this->departementModel->save($input)) {
            return redirect()->back()->withInput()->with('errors', $this->departementModel->errors());
        }

        return redirect()->to('/admin/departements')->with('success', 'Département mis à jour avec succès.');
    }

    /**
     * Supprime un département
     */
    public function deleteDepartement($id)
    {
        $departement = $this->departementModel->find($id);

        if (!$departement) {
            return redirect()->to('/admin/departements')->with('error', 'Département non trouvé.');
        }

        $this->departementModel->delete($id);

        return redirect()->to('/admin/departements')->with('success', 'Département supprimé avec succès.');
    }
}
