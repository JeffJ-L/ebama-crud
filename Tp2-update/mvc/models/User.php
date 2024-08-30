<?php

namespace App\Models;
use App\Models\CRUD;

class User extends CRUD{
    protected $table = "user";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'username', 'password', 'email', 'privilege_id', 'image'];
    // private $salt = "&B@M@";

    public function hashPassword($password, $cost = 10){
        $options = [
            'cost' => $cost
        ];
        
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public function checkUser($username, $password){
        $user = $this->unique('username', $username);
        if($user){
            // $newHashedPassword = $this->hashPassword('hashed_password2');
            // echo "hashed_password2 is ".  $newHashedPassword;


            if(password_verify($password, $user['password'])){
                session_regenerate_id();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['privilege_id'] = $user['privilege_id'];
                $_SESSION['image'] = $user['image'];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


}