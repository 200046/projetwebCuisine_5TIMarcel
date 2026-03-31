CREATE TABLE utilisateur (
  id INT NOT NULL AUTO_INCREMENT,
  nomUser VARCHAR(255) NOT NULL,
  prenomUser VARCHAR(25) NOT NULL,
  loginUser VARCHAR(25) NOT NULL,
  passWordUser VARCHAR(25) NOT NULL,
  role VARCHAR(255) DEFAULT 'user',
  emailUser VARCHAR(40),
  estSuspendu TINYINT(1) NOT NULL DEFAULT 0 COMMENT '0 = actif, 1 = suspendu',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE categorie (
  categorieId INT NOT NULL AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  PRIMARY KEY (categorieId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE tag (
  tagId INT NOT NULL AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  PRIMARY KEY (tagId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE recette (
  recetteId INT NOT NULL AUTO_INCREMENT,
  recetteTitre VARCHAR(255) NOT NULL,
  recetteDescription TEXT,
  recetteIngredients TEXT NOT NULL,
  recetteEtapes TEXT NOT NULL,
  recetteTempsPreparation INT NOT NULL,
  recetteDifficulte VARCHAR(25) NOT NULL,
  recetteImage VARCHAR(255),
  utilisateurId INT
  categorieId INT,
  PRIMARY KEY (recetteId),
  FOREIGN KEY (utilisateurId) REFERENCES utilisateur(id),
  FOREIGN KEY (categorieId) REFERENCES categorie(categorieId)
);

CREATE TABLE tag_recette (
  tagRecetteId INT NOT NULL AUTO_INCREMENT,
  recetteId INT,
  tagId INT,
  PRIMARY KEY (tagRecetteId),
  FOREIGN KEY (recetteId) REFERENCES recette(recetteId),
  FOREIGN KEY (tagId) REFERENCES tag(tagId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;