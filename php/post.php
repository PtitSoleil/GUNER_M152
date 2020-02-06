<?php
    if(isset($_FILES['imgFile'])) { 
        $dossier = '../uploads/';
        $fichier = basename($_FILES['imgFile']['name']);
        $taille_maxi = 3000000;
        $taille = filesize($_FILES['imgFile']['tmp_name']);
        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
        $extension = strrchr($_FILES['imgFile']['name'], '.');
        $type_file = $_FILES['imgFile']['type'];
        
        //Début des vérifications de sécurité...
        if(!in_array($extension, $extensions)){ //Si l'extension n'est pas dans le tableau
            $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
            }
        if($taille>$taille_maxi)
        {
            $erreur = 'Le fichier est trop gros...';
            }
        if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
        {
            $fichier = uniqid().$extension;
            //On formate le nom du fichier ici...
            $fichier = strtr($fichier, 
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
            if(move_uploaded_file($_FILES['imgFile']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
                echo 'Upload effectué avec succès !';
                header("Location: ../post.php");
            }
            else //Sinon (la fonction renvoie FALSE).
            {
                echo 'Echec de l\'upload !';
            }
        }
        else
        {
            echo $erreur;
        }
    }



    // test pour upload plusieur images
    
    // if(isset($_FILES) && is_array($_FILES) && count($_FILES)>0) {
    //     // Raccourci d'écriture pour le tableau reçu
    //     $fichiers = $_FILES['mesfichiers'];
    //     $dossier = '../uploads/';
    //     $taille_maxi = 3000000;
    //     $taille = filesize($_FILES['imgFile']['tmp_name']);
    //     $extensions = array('.png', '.gif', '.jpg', '.jpeg');
    //     $extension = strrchr($_FILES['imgFile']['name'], '.');
    //     $type_file = $_FILES['imgFile']['type'];
    //     // Boucle itérant sur chacun des fichiers
    //     for($i=0;$i<count($fichiers['name']);$i++){
    //         // Nettoyage du nom de fichier
    //         $nom_fichier = preg_replace('/[^a-z0-9\.\-]/ i','',$fichiers['name'][$i]);
    //         // Déplacement depuis le répertoire temporaire
    //         move_uploaded_file($fichiers['tmp_name'][$i],'uploads/'.$nom_fichier);
    //         // Si le type MIME correspond à une image, on l’affiche
    //         if(preg_match('/image/',$fichiers['type'][$i])) {
    //             echo '<br><img src="uploads/'.$nom_fichier.'">';
    //         }
    //         echo '</p>';
    //         }
    //     }