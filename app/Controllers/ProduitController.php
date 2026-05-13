<?php

namespace App\Controllers;

use App\Models\ProduitModel;

class ProduitController extends BaseController
{
    // public function index(){
    //     return "Liste des produits";
    // }

    public function index(){
    $model = new ProduitModel();
    $data['produits'] = $model->findAll();
    return view('produits', $data);
}
    public function show($id){
        return "Produit ID : " . $id;
    }
}