<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Privilege;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class UserController{

    public function __construct(){
        Auth::session();
    }
    public function create(){
        if($_SESSION['privilege_id']==1){
            // echo "Welcome to the User page!";
            $privilege = new Privilege;
            $privileges = $privilege->select('privilege');
            View::render('user/create', ['privileges'=>$privileges]);
        }else{
            return View::redirect('login');
        }
    }

    public function store($data){
        Auth::session();
        $validator = new Validator;
        $validator->field('name', $data['name'])->min(2)->max(50);
        $validator->field('username', $data['username'])->email()->required()->max(50)->isUnique('User');
        $validator->field('password', $data['password'])->min(5)->max(20);
        $validator->field('email', $data['email'])->email()->required()->max(50)->isUnique('User');
        $validator->field('privilege_id', $data['privilege_id'], 'privilege')->required()->isExist('Privilege');

        $validator->field('profile_picture', $_FILES['profile_picture'], 'Profile Picture')->isValidImageType($_FILES['profile_picture']['tmp_name'])->validateSize($_FILES['profile_picture']['size']);


        if($validator->isSuccess()){

            // Enregisder l'emplacement de l'image et le renommer et ensuite l'ajouter a la base de donnée
            $imagePath = $validator->image_name_check($_FILES['profile_picture']['name'], $_FILES['profile_picture']['tmp_name']);
            
            if ($imagePath) {
                $data['image'] = $imagePath;
            }

            $user = new User;
            $data['password'] = $user->hashPassword($data['password']);
            $insert = $user->insert($data);
            if($insert){
                return View::redirect('groupe');
            }else{
                return View::render('error');
            }

           
        }else{
            $errors = $validator->getErrors();
            $privilege = new Privilege;
            $privileges = $privilege->select('privilege');
            return View::render('user/create', ['errors'=>$errors, 'user'=>$data, 'privileges'=>$privileges]);
        }
    }
}