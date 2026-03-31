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
  rec_image VARCHAR(255) NOT NULL DEFAULT 'https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',
  rec_uti_id INT,
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

-- =========================
-- UTILISATEURS (20+)
-- =========================
INSERT INTO utilisateur (uti_nom, uti_prenom, uti_login, uti_motdepasse, uti_role, uti_email) VALUES
('Admin', 'Root', 'celoumar', 'celoumar', 'admin', 'admin@site.com'),

('Dupont','Jean','jdupont','1234','user','jean1@mail.com'),
('Martin','Claire','cmartin','1234','user','claire@mail.com'),
('Durand','Paul','pdurand','1234','user','paul@mail.com'),
('Bernard','Julie','jbernard','1234','user','julie@mail.com'),
('Petit','Lucas','lpetit','1234','user','lucas@mail.com'),
('Robert','Emma','erobert','1234','user','emma@mail.com'),
('Richard','Hugo','hrichard','1234','user','hugo@mail.com'),
('Moreau','Chloe','cmoreau','1234','user','chloe@mail.com'),
('Simon','Louis','lsimon','1234','user','louis@mail.com'),
('Laurent','Lea','llaurent','1234','user','lea@mail.com'),
('Lefebvre','Tom','tlefebvre','1234','user','tom@mail.com'),
('Michel','Manon','mmichel','1234','user','manon@mail.com'),
('Garcia','Nina','ngarcia','1234','user','nina@mail.com'),
('David','Leo','ldavid','1234','user','leo@mail.com'),
('Bertrand','Eva','ebertrand','1234','user','eva@mail.com'),
('Roux','Noah','nroux','1234','user','noah@mail.com'),
('Vincent','Lina','lvincent','1234','user','lina@mail.com'),
('Fournier','Adam','afournier','1234','user','adam@mail.com'),
('Morel','Jade','jmorel','1234','user','jade@mail.com'),
('Girard','Ethan','egirard','1234','user','ethan@mail.com');

-- =========================
-- CATEGORIES (20)
-- =========================
INSERT INTO categorie (cat_nom) VALUES
('Entrée'),('Plat'),('Dessert'),('Boisson'),('Végétarien'),
('Vegan'),('Rapide'),('Healthy'),('Snack'),('Petit-déjeuner'),
('Pâtes'),('Viande'),('Poisson'),('Salade'),('Soupe'),
('BBQ'),('Italien'),('Asiatique'),('Fast-food'),('Gourmand');

-- =========================
-- TAGS (20)
-- =========================
INSERT INTO tag (tag_nom) VALUES
('facile'),('rapide'),('pas cher'),('épicé'),('sucré'),
('salé'),('sans gluten'),('bio'),('maison'),('light'),
('protéiné'),('healthy'),('traditionnel'),('moderne'),('fête'),
('été'),('hiver'),('express'),('gourmet'),('comfort food');

-- =========================
-- RECETTES (20)
-- =========================
INSERT INTO recette 
(rec_titre, rec_description, rec_ingredients, rec_etapes, rec_temps_preparation, rec_difficulte, rec_image, rec_uti_id, rec_cat_id) VALUES

('Pâtes carbo','Classique italienne','pâtes,lardons,crème','cuire,mélanger',20,'facile','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',1,11),
('Salade César','Fraîche et rapide','salade,poulet,parmesan','mélanger',15,'facile','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',2,14),
('Burger maison','Délicieux burger','pain,steak,salade','cuire,assembler',25,'moyen','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',3,19),
('Pizza margarita','Simple','pâte,tomate,mozza','cuire',30,'facile','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',4,17),
('Soupe légumes','Healthy','légumes,eau','cuire,mixer',40,'facile','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',5,15),
('Tiramisu','Dessert italien','mascarpone,café','monter',35,'moyen','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',6,3),
('Crêpes','Classique','farine,lait,oeufs','mélanger,cuire',20,'facile','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',7,10),
('Omelette','Rapide','oeufs,sel','cuire',10,'facile','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',8,7),
('Poulet rôti','Savoureux','poulet,épices','cuire',60,'moyen','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',9,12),
('Sushi','Japonais','riz,poisson','assembler',50,'difficile','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',10,18),
('Tacos','Mexicain','tortilla,viande','assembler',20,'facile','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',11,19),
('Lasagnes','Italien','pâtes,bolognaise','cuire',70,'moyen','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',12,17),
('Smoothie','Boisson fruitée','fruits,lait','mixer',5,'facile','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',13,4),
('Salade fruits','Frais','fruits','couper',10,'facile','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',14,3),
('Steak frites','Classique','viande,pommes','cuire',30,'facile','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',15,12),
('Quiche','Maison','oeufs,crème','cuire',45,'moyen','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',16,2),
('Ramen','Asiatique','nouilles,bouillon','cuire',50,'moyen','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',17,18),
('Wrap','Snack','tortilla,poulet','assembler',15,'facile','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',18,9),
('Brownie','Chocolat','chocolat,farine','cuire',35,'facile','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',19,3),
('Glace maison','Dessert froid','lait,sucre','congeler',120,'moyen','https://cache.marieclaire.fr/data/photo/w1000_ci/61/meilleures-recettes-du-monde.jpg',20,3);

-- =========================
-- TAG_RECETTE (20+)
-- =========================
INSERT INTO tag_recette (tre_rec_id, tre_tag_id) VALUES
(1,1),(1,2),
(2,2),(2,10),
(3,3),(3,19),
(4,1),(4,14),
(5,8),(5,12),
(6,5),(6,19),
(7,1),(7,5),
(8,2),(8,1),
(9,13),(9,16),
(10,14),(10,19),
(11,3),(11,4),
(12,13),(12,19),
(13,2),(13,12),
(14,5),(14,10),
(15,13),(15,6),
(16,13),(16,9),
(17,14),(17,17),
(18,2),(18,9),
(19,5),(19,19),
(20,5),(20,16);