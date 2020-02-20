<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/GUNERA_152/php/server/database.php';


function insertPost($commentaire, $date){

    $db = EDatabase::getInstance();
    $date = date("Y-m-d H:i:s")
    try {
        $db->query('INSERT INTO post (commentaire,creationDate,modificationDate) VALUES ("' . $commentaire . '","' . $creationDate . '","' . $modificationDate . '")');
        header("Location: ./index.php");
    } catch (PDOException $ex) {
        echo "An Error occured!"; // user friendly message
        error_log($ex->getMessage());
    }

}

function insertMedia($nomFichierMedia,$typeMedia){

    $db = EDatabase::getInstance();
    try {
        $db->query('INSERT INTO post (nomFichierMedia,typeMedia,creationDate,modificationDate) VALUES ("' . $commentaire . '","' . $creationDate . '","' . $modificationDate . '")');
        header("Location: ./index.php");
    } catch (PDOException $ex) {
        echo "An Error occured!"; // user friendly message
        error_log($ex->getMessage());
    }
}

function getIdPost(){
    
}

function insertData($commentaire, $date){
    insertPost($commentaire, $date)
}
?>