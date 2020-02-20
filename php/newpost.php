<?php
require_once './createpost.php';
    $commentaire = filter_input(INPUT_POST, "commentary", FILTER_SANITIZE_STRING);

     if(isset($_FILES) && is_array($_FILES) && count($_FILES)>0) {
         // Raccourci d'écriture pour le tableau reçu
         $fichiers = $_FILES['imgFile'];
         $totalSize = 0;
         // Boucle itérant sur chacun des fichiers
         for($i=0;$i<count($fichiers['name']);$i++){ 
                $totalSize += $fichiers['size'][$i];
                if($totalSize > 70000000 || $fichiers['size'][$i] > 3000000){
                    if($fichiers['type'][$i] != "image/gif" || $fichiers['type'][$i] != "image/jpeg" || $fichiers['type'][$i] != "image/jpg" || $fichiers['type'][$i] != "image/png"){
                        echo 'Erreur';
                    }
                    echo 'Erreur';
                }

        }
        insertPost($commentaire,$fichiers);
        echo 'Upload effectué avec succès !';
        header("Location: ../index.php");
    }