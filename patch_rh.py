import re

with open('app/Controllers/Rh.php', 'r') as f:
    content = f.read()

# We need to add the query for soldes_employes inside index() method before view
new_code = """
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
"""

content = re.sub(r'\$data = \[\s*\'title\' => \'Espace RH - Demandes en attente\',\s*\'demandes\' => \$demandes\s*\];', new_code, content)

with open('app/Controllers/Rh.php', 'w') as f:
    f.write(content)

