<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TypeCongeModel;

class TypeConge extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new TypeConoogeModel();
    }

    public function index()
    {
        $data['types'] = $this->model->findAll();
        $data['title'] = 'Types de congé';
        return view('types_conge/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Ajouter un type de congé';
        return view('types_conge/create', $data);
    }

    public function store()
    {
        $data = $this->request->getPost([
            'libelle', 'jours_annuels', 'deductible'
        ]);

        $this->model->insert($data);
        return redirect()->to('/admin/types_conge');
    }

    public function edit($id)
    {
        $data['type'] = $this->model->find($id);
        $data['title'] = 'Modifier le type de congé';
        return view('types_conge/edit', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost([
            'libelle', 'jours_annuels', 'deductible'
        ]);

        $this->model->update($id, $data);
        return redirect()->to('/admin/types_conge');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/admin/types_conge');
    }
}
