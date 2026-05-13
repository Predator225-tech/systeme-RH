-- Table: departements
CREATE TABLE departements (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    description TEXT
);

-- Table: types_conge
CREATE TABLE types_conge (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    libelle TEXT NOT NULL,
    jours_annuels INTEGER DEFAULT 0,
    deductible INTEGER DEFAULT 1 
);

-- Table: employes
CREATE TABLE employes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    prenom TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    role TEXT CHECK(role IN ('employe', 'rh', 'admin')) DEFAULT 'employe',
    departement_id INTEGER,
    date_embauche TEXT NOT NULL,
    actif INTEGER DEFAULT 1,
    FOREIGN KEY (departement_id) REFERENCES departements(id) ON DELETE SET NULL
);

-- Table: soldes
CREATE TABLE soldes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    employe_id INTEGER NOT NULL,
    type_conge_id INTEGER NOT NULL,
    annee INTEGER NOT NULL,
    jours_attribues INTEGER DEFAULT 0,
    jours_pris INTEGER DEFAULT 0,
    FOREIGN KEY (employe_id) REFERENCES employes(id) ON DELETE CASCADE,
    FOREIGN KEY (type_conge_id) REFERENCES types_conge(id) ON DELETE CASCADE
);

-- Table: conges
CREATE TABLE conges (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    employe_id INTEGER NOT NULL,
    type_conge_id INTEGER NOT NULL,
    date_debut TEXT NOT NULL,
    date_fin TEXT NOT NULL,
    nb_jours INTEGER NOT NULL,
    motif TEXT,
    statut TEXT CHECK(statut IN ('en_attente', 'approuvee', 'refusee', 'annulee')) DEFAULT 'en_attente',
    commentaire_rh TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    traite_par INTEGER,
    FOREIGN KEY (employe_id) REFERENCES employes(id) ON DELETE CASCADE,
    FOREIGN KEY (type_conge_id) REFERENCES types_conge(id) ON DELETE CASCADE,
    FOREIGN KEY (traite_par) REFERENCES employes(id) ON DELETE SET NULL
);