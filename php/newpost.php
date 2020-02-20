<?php
        
    //     //Début des vérifications de sécurité...
    //     if(!in_array($extension, $extensions)){ //Si l'extension n'est pas dans le tableau
    //         $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
    //         }
    //     if($taille>$taille_maxi)
    //     {
    //         $erreur = 'Le fichier est trop gros...';
    //         }
    //     if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
    //     {
    //         for($i=0;$i<count($fichier['name']);$i++){
    //         $fichier = uniqid().$extension;
    //         //On formate le nom du fichier ici...
    //         $fichier = strtr($fichier, 
    //             'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
    //             'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    //         $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
    //         if(move_uploaded_file($files['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
    //         {
    //             echo 'Upload effectué avec succès !';
    //             header("Location: ../post.php");
    //         }
    //         else //Sinon (la fonction renvoie FALSE).
    //         {
    //             echo 'Echec de l\'upload !';
    //         }
    //     }
    // }
    //     else
    //     {
    //         echo $erreur;
    //     }
    // }

    
     if(isset($_FILES) && is_array($_FILES) && count($_FILES)>0) {
         // Raccourci d'écriture pour le tableau reçu
         $fichiers = $_FILES['imgFile'];
         $totalSize = 0;
         // Boucle itérant sur chacun des fichiers
         for($i=0;$i<count($fichiers['name']);$i++){ 
                $totalSize += $fichiers['size'][$i];
                if($totalSize < 70000000 || $fichiers['size'][$i] < 3000000){
                    if($fichiers['type'][$i] == "image/gif" || $fichiers['type'][$i] == "image/jpeg" || $fichiers['type'][$i] == "image/jpg" || $fichiers['type'][$i] == "image/png"){
             // Nettoyage du nom de fichier
             $nom_fichier = preg_replace('/[^a-z0-9\.\-]/ i','',$fichiers['name'][$i]);
             $nom_fichier = $fichiers['name'][$i];
                $splitName = explode(".", $nom_fichier);
                $newName = uniqid();
                $finalName = $newName . "." . $splitName[1];
             // Déplacement depuis le répertoire temporaire
             move_uploaded_file($fichiers['tmp_name'][$i],'../uploads/'.$finalName);
                    }
                }

        }
        echo 'Upload effectué avec succès !';
        header("Location: ../index.php");
    }