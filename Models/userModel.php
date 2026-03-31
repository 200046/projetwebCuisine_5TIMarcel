<?php 

// ============================================
// FONCTIONS D'AUTHENTIFICATION ET UTILISATEUR
// ============================================

// -----------------------------
// Connexion utilisateur
// -----------------------------
function connectUser($pdo) {

    $errors = verifEmptyData();

    if ($errors) {
        return $errors;
    }

    try {

        $query = 'SELECT * FROM utilisateur 
                  WHERE uti_login = :uti_login 
                  AND uti_motdepasse = :uti_motdepasse';

        $connectUser = $pdo->prepare($query);

        $connectUser->execute([
            'uti_login' => $_POST['login'],
            'uti_motdepasse' => $_POST['mot_de_passe']
        ]);

        $user = $connectUser->fetch(PDO::FETCH_OBJ);

        if (!$user) {
            return false;
        }
        
        // Vérifier si le compte est suspendu
        if ($user->uti_est_suspendu == 1) {
            return "suspendu";
        }
        
        $_SESSION["utilisateur"] = $user;
        return true;

    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}


// -----------------------------
// Création d'un utilisateur
// -----------------------------
function createUser($pdo) {

    $errors = verifEmptyData();

    if ($errors) {
        return $errors;
    }

    try {

        $query = 'INSERT INTO utilisateur 
                  (uti_nom, uti_prenom, uti_login, uti_motdepasse, uti_email, uti_role, uti_est_suspendu) 
                  VALUES 
                  (:uti_nom, :uti_prenom, :uti_login, :uti_motdepasse, :uti_email, :uti_role, 0)';

        $createUser = $pdo->prepare($query);

        $createUser->execute([
            'uti_nom'        => $_POST["nom"],
            'uti_prenom'     => $_POST["prenom"],
            'uti_login'      => $_POST["login"],
            'uti_motdepasse' => $_POST["mot_de_passe"],
            'uti_email'      => $_POST["email"],
            'uti_role'       => 'user'
        ]);

        return true;

    } catch (PDOException $e) {

        $message = $e->getMessage();
        die($message);

    }
}


// -----------------------------
// Modifier un utilisateur
// -----------------------------
function updateUser($pdo) {

    try {

        $query = 'UPDATE utilisateur 
                  SET uti_nom = :uti_nom, 
                      uti_prenom = :uti_prenom, 
                      uti_motdepasse = :uti_motdepasse, 
                      uti_email = :uti_email
                  WHERE uti_id = :uti_id';

        $updateUser = $pdo->prepare($query);

        $updateUser->execute([
            'uti_nom'        => $_POST["nom"],
            'uti_prenom'     => $_POST["prenom"],
            'uti_email'      => $_POST["email"],
            'uti_motdepasse' => $_POST["mot_de_passe"],
            'uti_id'         => $_SESSION["utilisateur"]->uti_id
        ]);

    } catch (PDOException $e) {

        $message = $e->getMessage();
        die($message);

    }
}


// -----------------------------
// Mettre à jour la session utilisateur
// -----------------------------
function updateSession($pdo) {

    try {

        $query = 'SELECT * FROM utilisateur WHERE uti_id = :uti_id';

        $selectUser = $pdo->prepare($query);

        $selectUser->execute([
            'uti_id' => $_SESSION["utilisateur"]->uti_id
        ]);

        $user = $selectUser->fetch(PDO::FETCH_OBJ);

        $_SESSION["utilisateur"] = $user;

    } catch (PDOException $e) {

        $message = $e->getMessage();
        die($message);

    }

}


// -----------------------------
// Supprimer un utilisateur
// -----------------------------
function deleteUser($pdo) {

    try {

        $id = $_SESSION["utilisateur"]->uti_id;

        // Supprimer les tags liés aux recettes de l'utilisateur
        $queryTags = 'DELETE tag_recette 
                      FROM tag_recette
                      INNER JOIN recette 
                      ON tag_recette.tre_rec_id = recette.rec_id
                      WHERE recette.rec_uti_id = :id';

        $deleteTags = $pdo->prepare($queryTags);

        $deleteTags->execute([
            'id' => $id
        ]);


        // Supprimer les recettes
        $queryRecettes = 'DELETE FROM recette WHERE rec_uti_id = :id';

        $deleteRecettes = $pdo->prepare($queryRecettes);

        $deleteRecettes->execute([
            'id' => $id
        ]);


        // Supprimer l'utilisateur
        $queryUser = 'DELETE FROM utilisateur WHERE uti_id = :id';

        $deleteUser = $pdo->prepare($queryUser);

        $deleteUser->execute([
            'id' => $id
        ]);


        // Détruire la session
        session_unset();
        session_destroy();

    } catch (PDOException $e) {

        $message = $e->getMessage();
        die($message);

    }

}


// ============================================
// FONCTIONS D'ADMINISTRATION (GESTION DES COMPTES)
// ============================================

// -----------------------------
// Récupérer tous les utilisateurs
// -----------------------------
function getAllUtilisateurs($pdo) {

    try {

        $query = 'SELECT uti_id, uti_nom, uti_prenom, uti_login, uti_role, uti_email, uti_est_suspendu
                  FROM utilisateur 
                  ORDER BY uti_id';

        $getAllUtilisateurs = $pdo->prepare($query);
        $getAllUtilisateurs->execute();

        $utilisateurs = $getAllUtilisateurs->fetchAll(PDO::FETCH_OBJ);

        return $utilisateurs;

    } catch (PDOException $e) {

        $message = $e->getMessage();
        die($message);

    }

}


// -----------------------------
// Suspendre un utilisateur
// -----------------------------
function suspendreUtilisateur($pdo, $id) {

    try {

        $query = 'UPDATE utilisateur 
                  SET uti_est_suspendu = 1 
                  WHERE uti_id = :id';

        $suspendreUser = $pdo->prepare($query);

        $suspendreUser->execute([
            'id' => $id
        ]);

        return true;

    } catch (PDOException $e) {

        $message = $e->getMessage();
        die($message);

    }

}


// -----------------------------
// Réactiver un utilisateur
// -----------------------------
function reactiverUtilisateur($pdo, $id) {

    try {

        $query = 'UPDATE utilisateur 
                  SET uti_est_suspendu = 0 
                  WHERE uti_id = :id';

        $reactiverUser = $pdo->prepare($query);

        $reactiverUser->execute([
            'id' => $id
        ]);

        return true;

    } catch (PDOException $e) {

        $message = $e->getMessage();
        die($message);

    }

}


// -----------------------------
// Récupérer le statut de suspension
// -----------------------------
function getStatutSuspension($pdo, $id) {

    try {

        $query = 'SELECT uti_est_suspendu FROM utilisateur WHERE uti_id = :id';

        $getStatut = $pdo->prepare($query);

        $getStatut->execute([
            'id' => $id
        ]);

        $user = $getStatut->fetch(PDO::FETCH_OBJ);

        if ($user) {
            return $user->uti_est_suspendu;
        } else {
            return null;
        }

    } catch (PDOException $e) {

        $message = $e->getMessage();
        die($message);

    }

}


// -----------------------------
// Vérifier si l'utilisateur est admin
// -----------------------------
function verifAdmin($pdo, $userId) {

    try {

        $query = 'SELECT uti_role FROM utilisateur WHERE uti_id = :id';

        $verifAdmin = $pdo->prepare($query);

        $verifAdmin->execute([
            'id' => $userId
        ]);

        $user = $verifAdmin->fetch(PDO::FETCH_OBJ);

        if ($user && $user->uti_role === 'admin') {
            return true;
        } else {
            return false;
        }

    } catch (PDOException $e) {

        $message = $e->getMessage();
        die($message);

    }

}


// -----------------------------
// Compter les recettes d'un utilisateur
// -----------------------------
function countRecettesByUser($pdo, $userId) {

    try {

        $query = 'SELECT COUNT(*) as total 
                  FROM recette 
                  WHERE rec_uti_id = :userId';

        $countRecettes = $pdo->prepare($query);

        $countRecettes->execute([
            'userId' => $userId
        ]);

        $result = $countRecettes->fetch(PDO::FETCH_OBJ);

        return $result->total;

    } catch (PDOException $e) {

        $message = $e->getMessage();
        die($message);

    }

}


// ============================================
// FONCTIONS UTILITAIRES
// ============================================

// -----------------------------
// Vérification des champs vides
// -----------------------------
function verifEmptyData() {

    foreach($_POST as $key => $value) {

        if ($key != 'btnEnvoi') {

            if (str_replace(' ', '', $value) == '') {

                $messageError[$key] = "Votre " . $key . " est vide";

            }

        }

    }

    if (isset($messageError)) {
        return $messageError;
    } else {
        return false;
    }

}

function promouvoirModerateur($pdo, $id) {
    try {
        $query = 'UPDATE utilisateur SET uti_role = :uti_role WHERE uti_id = :id';
        $stmt = $pdo->prepare($query);
        $stmt->execute(['uti_role' => 'moderateur', 'id' => $id]);
        return true;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function retrograderUtilisateur($pdo, $id) {
    try {
        $query = 'UPDATE utilisateur SET uti_role = :uti_role WHERE uti_id = :id';
        $stmt = $pdo->prepare($query);
        $stmt->execute(['uti_role' => 'user', 'id' => $id]);
        return true;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

// -----------------------------
// Récupérer un utilisateur par son id
// -----------------------------
function getUserById($pdo, $id)
{
    try {
        $query = 'SELECT * FROM utilisateur WHERE uti_id = :id';
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
/*
 * Projet : Gestion de Recettes
 * Date : 31/03/2026
 */
