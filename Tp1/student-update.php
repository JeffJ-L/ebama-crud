<?php

require_once('Classe/CRUD.php');

$crud = new CRUD;

$update = $crud->update('etudiant', $_POST);


if($update){
    header('location: '.$_SERVER['HTTP_REFERER']); // Retourne toujours vers la page précédente.

}else{
    echo 'Error' ;
}