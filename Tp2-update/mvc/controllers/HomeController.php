<?php
namespace App\Controllers;

use App\Models\ExampleModel;

class HomeController{
    public function index(){
        //echo 'Home Controller';
        // echo "Welcome to the Home page!";
        $model = new ExampleModel;
        $data = $model->getData();
        include('views/home.php');
    }

    public function test(){
        echo 'test';
    }
}

?>