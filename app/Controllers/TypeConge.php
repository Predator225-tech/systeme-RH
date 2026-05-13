<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TypeCongeModel;

class TypeConge extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new TypeCongeModel();
    }

    public function index()
    {
        $data['types'] = $this->model->findAll();
        echo view('types_conge/index', $data);
    }

    public function create()
    {
        echo view('types_conge/create');
    }

    public function store()
    {
        $data = $this->request->getPost([
            'libelle', 'jours_annuels', 'deductible'
        ]);

        $this->model->insert($data);
        return redirect()->to('/types_conge');
    }

    public function edit($id)
    {
        $data['type'] = $this->model->find($id);
        echo view('types_conge/edit', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost([
            'libelle', 'jours_annuels', 'deductible'
        ]);

        $this->model->update($id, $data);
        return redirect()->to('/types_conge');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/types_conge');
    }
}
