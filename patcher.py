import sys
with open('app/Controllers/Admin.php', 'r') as f:
    content = f.read()

target = "// ============ DEPARTEMENTS ============"

addition = """    // ============ SOLDES (ATTRIBUTION) ============

    public function soldes($employeId)
    {
        $employe = $this->employeModel->find($employeId);
        if (!$employe) return redirect()->to('/admin/employes')->with('error', 'Employé non trouvé.');

        $typesConge = $this->typeCongeModel->findAll();
        $soldesExistants = $this->soldeModel->where('employe_id', $employeId)->findAll();
        
        $soldesParType = [];
        foreach ($soldesExistants as $s) {
            if ($s['annee'] == date('Y')) {
                $soldesParType[$s['type_conge_id']] = $s;
            }
        }

        $data = [
            'title' => 'Gérer les soldes de ' . esc($employe['prenom']) . ' ' . esc($employe['nom']),
            'employe' => $employe,
            'typesConge' => $typesConge,
            'soldes' => $soldesParType,
            'annee' => date('Y')
        ];

        return view('admin/employes/soldes', $data);
    }

    public function updateSoldes($employeId)
    {
        $employe = $this->employeModel->find($employeId);
        if (!$employe) return redirect()->to('/admin/employes')->with('error', 'Employé non trouvé.');

        $soldesInput = $this->request->getPost('soldes');
        $annee = date('Y');

        if ($soldesInput && is_array($soldesInput)) {
            foreach ($soldesInput as $typeId => $joursAttribues) {
                $solde = $this->soldeModel->where('employe_id', $employeId)->where('type_conge_id', $typeId)->where('annee', $annee)->first();
                
                if ($solde) {
                    $this->soldeModel->update($solde['id'], ['jours_attribues' => (int) $joursAttribues]);
                } else {
                    $this->soldeModel->insert([
                        'employe_id' => $employeId, 
                        'type_conge_id' => $typeId, 
                        'annee' => $annee, 
                        'jours_attribues' => (int) $joursAttribues, 
                        'jours_pris' => 0
                    ]);
                }
            }
        }

        return redirect()->to("/admin/employes/{$employeId}/soldes")->with('success', "Soldes mis à jour pour l\'année " . $annee);
    }

    // ============ DEPARTEMENTS ============"""

content = content.replace(target, addition)

with open('app/Controllers/Admin.php', 'w') as f:
    f.write(content)

print("Done patching.")
