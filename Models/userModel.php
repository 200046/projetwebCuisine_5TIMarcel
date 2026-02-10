<?php 
function connectUser($pdo) {
    try {
        $query = 'select * FROM utilisateur where loginUser = :loginUser and passWordUser = :passWordUser';
        $connectUser = $pdo->prepare($query);
        $connectUser->execute([
            'loginUser' => $_POST['login'],
            'passWordUser' => $_POST['mot_de_passe']
        ]);
        $user = $connectUser->fetch();
        if (!$user) {
            return false;
        } else {
            $_SESSION["user"] = $user;
            return true;
        }
        
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
}}

function createUser($pdo) {
    try {
        $query = 'INSERT INTO utilisateur (nomUser, prenomUser, loginUser, passWordUser, emailUser, role) 
                  VALUES (:nomUser, :prenomUser, :loginUser, :passWordUser, :emailUser, :role)';
        
        $ajouterUser = $pdo->prepare($query);
        $ajouterUser->execute([
            ':nomUser' => $_POST["nom"],
            ':prenomUser' => $_POST["prenom"],
            ':loginUser' => $_POST["login"],
            ':passWordUser' => $_POST["mot_de_passe"],
            ':emailUser' => $_POST["email"],
            ':role' => 'user'
        ]);

        echo "Utilisateur ajouté avec succès !";
    } 
    catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}


function verifEmptyData() {
    foreach($_POST as $key => $value) {
        if ($key != 'btnEnvoi') {
        if (empty(str_replace(' ', '', $value))) {
            $messageError[$key] = "Votre " . $key . " est vide";
        } }
    }
    if (isset($messageError)) {
        return $messageError;
    } else {
        return false;
    }
}
function updateUser($pdo) {
    try {
        $query = 'UPDATE utilisateur SET nomUser = :nomUser, prenomUser = :prenomUser, passWordUser = :passWordUser, emailUser = :emailUser
                  WHERE id = :id';
         $ajouterUser = $pdo->prepare($query);
         $ajouterUser->execute([
            'nomUser' => $_POST["nom"],
            'prenomUser' => $_POST["prenom"],
            'emailUser' => $_POST["email"],
            'passWordUser' => $_POST["mot_de_passe"],
            'id' => $_SESSION["user"]->id
         ]);
        }   catch (PDOException $e) {
            $message = $e->getMessage();
            die($message);
        }
}
function updateSession($pdo) {
    try {
        $query = 'select * from utilisateur where id = :id';
        $selectUser = $pdo->prepare($query);
        $selectUser->execute([
            'id' => $_SESSION["user"]->id
        ]);
        $user = $selectUser->fetch();
        $_SESSION["user"] = $user;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }   
}
function DeleteUser($pdo) {
    try {
        $query = 'delete from utilisateurs where id = :id';
        $delUser = $pdo->prepare($query);
    $delUser->execute([
        'id' => $_SESSION["user"]->id
    ]);
    }
    catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }  
}