-- 1. Effacer l'existant (Recommandé par le document [cite: 2])
DROP TABLE IF EXISTS tag_recette;
DROP TABLE IF EXISTS tag;
DROP TABLE IF EXISTS recette;
DROP TABLE IF EXISTS categorie;
DROP TABLE IF EXISTS utilisateur;

-- 2. Création des tables
CREATE TABLE utilisateur (
  uti_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  uti_nom VARCHAR(255) NOT NULL,
  uti_prenom VARCHAR(255) NOT NULL,
  uti_login VARCHAR(25) NOT NULL,
  uti_motdepasse VARCHAR(255) NOT NULL, -- "uti_motdepasse" utilisé dans l'exemple 
  uti_role VARCHAR(50) NOT NULL DEFAULT 'user',
  uti_email VARCHAR(150) NOT NULL UNIQUE,
  uti_est_suspendu TINYINT(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE categorie (
  cat_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  cat_nom VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE tag (
  tag_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  tag_nom VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE recette (
  rec_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  rec_titre VARCHAR(255) NOT NULL,
  rec_description TEXT,
  rec_ingredients TEXT NOT NULL,
  rec_etapes TEXT NOT NULL,
  rec_temps_preparation INT NOT NULL,
  rec_difficulte VARCHAR(25) NOT NULL,
  rec_image VARCHAR(255),
  rec_uti_id INT, -- Préfixe + nom explicite 
  rec_cat_id INT,
  FOREIGN KEY (rec_uti_id) REFERENCES utilisateur(uti_id),
  FOREIGN KEY (rec_cat_id) REFERENCES categorie(cat_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE tag_recette (
  tre_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  tre_rec_id INT,
  tre_tag_id INT,
  FOREIGN KEY (tre_rec_id) REFERENCES recette(rec_id),
  FOREIGN KEY (tre_tag_id) REFERENCES tag(tag_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;