<?php
require_once('Classe/CRUD.php');

$crud = new CRUD;


$id = $_POST['id'];
$delete = $crud->delete('etudiant', $id);

if($delete){
    header('location: '.$_SERVER['HTTP_REFERER']); // Retourne toujours vers la page précédente.

}else{
    echo 'Error' ;
}
