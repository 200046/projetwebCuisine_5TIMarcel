USE projetwebcuisine;

-- 1. D'abord supprimer les tables qui dépendent de utilisateur
DROP TABLE IF EXISTS tag_recette;
DROP TABLE IF EXISTS recette;

-- 2. Puis supprimer les autres tables indépendantes
DROP TABLE IF EXISTS tag;
DROP TABLE IF EXISTS categorie;

-- 3. Enfin supprimer utilisateur

DROP TABLE IF EXISTS utilisateur;

-- 4. Maintenant tu peux recréer toutes les tables
CREATE TABLE utilisateur (
  id int NOT NULL AUTO_INCREMENT,
  nomUser varchar(255) NOT NULL,
  prenomUser varchar(25) NOT NULL,
  loginUser varchar(25) NOT NULL,
  passWordUser varchar(25) NOT NULL,
  role varchar(255) DEFAULT 'user',
  emailUser varchar(40) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- 5. Recréer les autres tables dans l'ordre
CREATE TABLE categorie (
  categorieId int NOT NULL AUTO_INCREMENT,
  nom varchar(255) NOT NULL,
  PRIMARY KEY (categorieId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE tag (
  tagId int NOT NULL AUTO_INCREMENT,
  nom varchar(255) NOT NULL,
  PRIMARY KEY (tagId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE recette (
  recetteId int NOT NULL AUTO_INCREMENT,
  recetteTitre varchar(255) NOT NULL,
  recetteDescription text,
  recetteIngredients text NOT NULL,
  recetteEtapes text NOT NULL,
  recetteTempsPreparation int NOT NULL,
  recetteDifficulte varchar(25) NOT NULL,
  recetteImage varchar(255) DEFAULT NULL,
  utilisateurId int DEFAULT NULL,
  categorieId int DEFAULT NULL,
  PRIMARY KEY (recetteId),
  KEY utilisateurId (utilisateurId),
  KEY categorieId (categorieId),
  CONSTRAINT recette_ibfk_1 FOREIGN KEY (utilisateurId) REFERENCES utilisateur (id),
  CONSTRAINT recette_ibfk_2 FOREIGN KEY (categorieId) REFERENCES categorie (categorieId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE tag_recette (
  tagRecetteId int NOT NULL AUTO_INCREMENT,
  recetteId int DEFAULT NULL,
  tagId int DEFAULT NULL,
  PRIMARY KEY (tagRecetteId),
  KEY recetteId (recetteId),
  KEY tagId (tagId),
  CONSTRAINT tag_recette_ibfk_1 FOREIGN KEY (recetteId) REFERENCES recette (recetteId),
  CONSTRAINT tag_recette_ibfk_2 FOREIGN KEY (tagId) REFERENCES tag (tagId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- 6. Insérer les données de base
INSERT INTO utilisateur (nomUser, prenomUser, loginUser, passWordUser, role, emailUser) 
VALUES ('Mar', 'Célou', 'celoumar', 'celoumar', 'admin', 'celoumar@gmail.com');

INSERT INTO categorie (nom) VALUES
('Entrée'),
('Plat principal'),
('Dessert'),
('Apéritif'),
('Boisson'),
('Sauce'),
('Accompagnement');

INSERT INTO tag (nom) VALUES
('végétarien'),
('végétalien'),
('sans gluten'),
('rapide'),
('économique'),
('healthy'),
('comfort food'),
('épicé'),
('sucré'),
('salé'),
('saison'),
('été'),
('hiver'),
('printemps'),
('automne'),
('français'),
('italien'),
('asiatique'),
('mexicain');

INSERT INTO recette (recetteTitre, recetteDescription, recetteIngredients, recetteEtapes, recetteTempsPreparation, recetteDifficulte, utilisateurId, categorieId) VALUES
('Soupe de légumes maison', 'Une soupe réconfortante pour les soirées fraîches', '2 carottes\n2 pommes de terre\n1 oignon\n1 litre de bouillon de légumes\nSel, poivre\nPersil frais', '1. Éplucher et couper les légumes en dés\n2. Faire revenir l\'oignon dans un peu d\'huile\n3. Ajouter les carottes et pommes de terre\n4. Verser le bouillon de légumes\n5. Porter à ébullition puis laisser mijoter 30 minutes\n6. Mixer jusqu\'à obtenir la texture souhaitée\n7. Saler, poivrer et ajouter le persil\n8. Servir chaud avec du pain frais', 45, 'facile', 1, 1);