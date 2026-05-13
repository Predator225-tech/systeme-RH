<?php

namespace App\Models;

use CodeIgniter\Model;

class Departement extends Model
{
    protected $table = 'departements';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nom', 'description'];
    protected $useTimestamps = false;
    
    protected $validationRules = [
        'nom' => 'required|string|min_length[2]|max_length[100]|is_unique[departements.nom,id,{id}]',
        'description' => 'permit_empty|string|max_length[500]',
    ];

    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom du département est requis.',
            'is_unique' => 'Ce nom de département existe déjà.',
        ],
    ];

    // Relation avec Employe
    public function getEmployes()
    {
        return $this->hasMany('App\Models\Employe', 'departement_id', 'id');
    }
}
