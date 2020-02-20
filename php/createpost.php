<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/GUNER_M152/php/server/database.php';


function insertPost($commentaire, $fichiers= null){
    $date = date("Y-m-d H:i:s");

    try {
        $db = EDatabase::getInstance();

        $db->query('INSERT INTO post (commentaire,creationDate,modificationDate) VALUES ("' . $commentaire . '","' . $date . '","' . $date . '")');

        if($fichiers!=null){
        $lastInsertId = EDatabase::getInstance()->lastInsertId();
        for ($i=0; $i < count($fichiers['name']); $i++) { 
            insertMedia($fichiers['name'][$i], $fichiers['type'][$i], $fichiers['tmp_name'][$i],$lastInsertId);
        }}
    } catch (PDOException $ex) {
        echo "An Error occured!"; // user friendly message
        error_log($ex->getMessage());
    }

}

function insertMedia($nomFichierMedia,$typeMedia, $tmpName, $idPost){
    $date = date("Y-m-d H:i:s");
    try {
        $db = EDatabase::getInstance();
        // Nettoyage du nom de fichier
        $nom_fichier = preg_replace('/[^a-z0-9\.\-]/ i','',$nomFichierMedia);
        $nom_fichier = $nomFichierMedia;
        $splitName = explode(".", $nom_fichier);
        $newName = uniqid();
        $finalName = $newName . "." . $splitName[1];
        $db->query('INSERT INTO media (nomMedia,typeMedia,creationDate,modificationDate) VALUES ("' . $finalName . '","' . $typeMedia . '","' . $date . '","' . $date . '")');
        $lastInsertId = EDatabase::getInstance()->lastInsertId();
        
        // Déplacement depuis le répertoire temporaire
        if(move_uploaded_file($tmpName,'../uploads/'.$finalName)){
            insertContain($idPost,$lastInsertId);
        }
    } catch (PDOException $ex) {
        echo "An Error occured!"; // user friendly message
        error_log($ex->getMessage());
    }
}

function insertContain($idPost, $idMedia){
    try {
        $db = EDatabase::getInstance();
        $db->query('INSERT INTO contenir (idPost,idMedia) VALUES ("' . $idPost . '","' . $idMedia . '")');
    } catch (PDOException $ex) {
        echo "An Error occured!"; // user friendly message
        error_log($ex->getMessage());
    }
}