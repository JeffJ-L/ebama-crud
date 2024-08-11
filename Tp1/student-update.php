<?php

require_once('Classe/CRUD.php');

$crud = new CRUD;

$update = $crud->update('etudiant', $_POST);

print_r($update);

if($update){

    header('location: index.php');
    // header('location: '.$_SERVER['HTTP_REFERER']); // Retourne toujours vers la page précédente.

}else{
    echo 'Error' ;
}