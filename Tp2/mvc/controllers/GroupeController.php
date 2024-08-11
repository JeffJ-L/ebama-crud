<?php
namespace App\Controllers;

use App\Models\Groupe;
use App\Providers\View;
use App\Providers\Validator;

class GroupeController {
    
    public function index() {
        // echo "This is the Groupe index!";
        $groupe = new Groupe;
        $select = $groupe->select();
        View::render('groupe/index', ['groupes' => $select]);
    }

    public function create() {
        View::render('groupe/create');
    }

    public function show($data = []){
        if(isset($data['id']) && $data['id'] != null){
            $groupe = new Groupe;
            $selectId = $groupe->selectId($data['id']);
            if($selectId){
                $professors = $groupe->getProfessors($data['id']);
                $student_count = $groupe->getStudentCount($data['id']);
                
                return View::render('groupe/show', [
                    'groupe' => $selectId,
                    'professors' => $professors,
                    'student_count' => $student_count
                ]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['msg' => 'No group found!']);
        }    
    }
    

    public function edit($data = []){
        if(isset($_GET['id']) && $data['id'] != null){
            $groupe = new Groupe;
            $selectId = $groupe->selectId($data['id']);
            if($selectId){
                return View::render('groupe/edit', ['groupe' => $selectId]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error');
        }    
    }

    public function store($data = []){
       $validator = new Validator;
       $validator->field('name', $data['name'])->min(3)->max(45);
       $validator->field('description', $data['description'])->max(255);

       if($validator->isSuccess()){
            $groupe = new Groupe;
            $insert = $groupe->insert($data);
            
            if($insert){
                return View::redirect('groupe/show?id='.$insert);
            } else {
                return View::render('error');
            }
       } else {
            $errors = $validator->getErrors();
            return View::render('groupe/create', ['errors' => $errors, 'groupe' => $data]);
       }
    }

    public function update($data, $get_data) {
        if(isset($get_data['id']) && $get_data['id'] != null){
            $id = $get_data['id'];
            $validator = new Validator;
            $validator->field('name', $data['name'])->min(3)->max(45);
            $validator->field('description', $data['description'])->max(255);

            if($validator->isSuccess()){
                $groupe = new Groupe;
                $update = $groupe->update($data, $id);
                if($update){
                    return View::redirect('groupe/show?id='.$id);
                } else {
                    return View::render('error');
                }
            } else {
                $errors = $validator->getErrors();
                return View::render('groupe/edit', ['errors' => $errors, 'groupe' => $data]);
            }
        } else {
            return View::render('error');
        }
    }

    public function delete($data){
        $groupe = new Groupe;
        $delete = $groupe->delete($data['id']);
        if($delete){
            return View::redirect('groupe');
        } else {
            return View::render('error');
        }
    }
}
