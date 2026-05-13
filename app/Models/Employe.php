<?php

namespace App\Models;

use CodeIgniter\Model;

class Employe extends Model
{
    protected $table = 'employes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nom', 'prenom', 'email', 'password', 'role', 'departement_id', 'date_embauche', 'actif'];
    protected $useTimestamps = false;
    
    protected $validationRules = [
        'nom' => 'required|string|min_length[2]|max_length[100]',
        'prenom' => 'required|string|min_length[2]|max_length[100]',
        'email' => 'required|valid_email|is_unique[employes.email,id,{id}]',
        'password' => 'permit_empty|string|min_length[6]',
        'role' => 'permit_empty|in_list[employe,rh,admin]',
        'departement_id' => 'required|integer|is_not_unique[departements.id]',
        'date_embauche' => 'required|valid_date[Y-m-d]',
        'actif' => 'permit_empty|in_list[0,1]',
    ];

    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom de l\'employé est requis.',
        ],
        'prenom' => [
            'required' => 'Le prénom de l\'employé est requis.',
        ],
        'email' => [
            'required' => 'L\'email est requis.',
            'valid_email' => 'Veuillez entrer un email valide.',
            'is_unique' => 'Cet email est déjà utilisé.',
        ],
        'departement_id' => [
            'required' => 'Le département est requis.',
            'is_not_unique' => 'Ce département n\'existe pas.',
        ],
        'date_embauche' => [
            'required' => 'La date d\'embauche est requise.',
            'valid_date' => 'Veuillez entrer une date valide (YYYY-MM-DD).',
        ],
        'role' => [
            'in_list' => 'Le rôle doit être employe, rh ou admin.',
        ],
        'actif' => [
            'in_list' => 'Le statut actif doit être 0 ou 1.',
        ],
    ];

    // Relation avec Departement
    public function getDepartement()
    {
        return $this->belongsTo('App\Models\Departement', 'departement_id', 'id');
    }
}
