<?php 

require_once $_SERVER["DOCUMENT_ROOT"].'/GUNER_M152/php/server/database.php';

function showPost(){
        $db = EDatabase::getInstance();
    
        try {
            foreach ($db->query('SELECT p.creationDate AS creaDate, p.modificationDate AS modifDate, p.commentaire AS comment,
            group_concat(m.nomFichierMedia ORDER BY m.idMedia) AS medias,
            group_concat(m.typeMedia ORDER BY m.idmedia) AS types
            FROM post AS p
            JOIN contenir AS c ON p.idPost = c.Post_idPost
            JOIN media AS m ON m.idmedia = c.media_idmedia
            GROUP BY p.idPost
            UNION
            SELECT p.creationDate, p.modificationDate, p.commentaire,
            null AS medias,
            null AS types
            FROM post AS p
            WHERE p.idPost NOT IN (
              SELECT contenir.Post_idPost
              FROM contenir)
            GROUP BY p.idPost
            ORDER BY creaDate desc') as $row) {
                echo '<div class="card mt-2">';
                $splitedMedias = explode(",", $row['medias']);
                foreach($splitedMedias as $splitedMedia){
                echo '<img class="card-img-top"alt="'.$splitedMedia.'" src="./uploads/'.$splitedMedia. '">';
                }
                echo '<div class="card-body">';
                echo '<h5 class="card-title">'.$row['comment'].'</h5>';
                $splitedCreaDate = explode(" ", $row['creaDate']);
                echo '<p class="card-text">'.$row['creaDate'].'</p>';
                echo '<i class="fas fa-edit mr-2"></i>';
                echo '<i class="fas fa-trash-alt mr-2"></i>';
                echo '</div>';
                echo '</div>';
            }
    
        } catch (PDOException $ex) {
            echo 'An Error occured!'; // user friendly message
            error_log($ex->getMessage());
        }
    
        echo '</div>';
    } 
