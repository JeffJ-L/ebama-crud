<?php

require_once('Classe/CRUD.php');

$crud = new CRUD;

$insert = $crud->insert('etudiant', $_POST);

header('location:student-show.php?id='.$insert);