create table produits(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prix DECIMAL(10,2) NOT NULL
);

INSERT INTO produits (nom,prix) VALUES
('popol',50000),
('kenny',1),
('za',100000);

