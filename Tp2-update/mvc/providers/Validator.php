<?php
namespace App\Providers;

class Validator {
    private $errors = array();
    private $key;
    private $value;
    private $name;

    public function field($key, $value, $name = null){
        $this->key = $key;
        $this->value = $value;
        if($name == null){
            $this->name = ucfirst($key);
        }else{
            $this->name = ucfirst($name);
        }
        return $this;
    }

    public function required(){
        if (empty($this->value)){
            $this->errors[$this->key] = "$this->name is required";
        }
        return $this;
    }

    public function max($length){
        if(strlen($this->value) > $length){
            $this->errors[$this->key] = "$this->name must be less than $length characters";
        }
        return $this;
    }

    public function min($length){
        if(strlen($this->value) < $length){
            $this->errors[$this->key] = "$this->name must be more than $length characters";
        }
        return $this;
    }

    public function email(){
        if(!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_EMAIL)){
            $this->errors[$this->key] = "Invalid $this->name format";
        }
        return $this;
    }

    public function isUnique($model){
        $model = 'App\\Models\\'.$model;
        $model = new $model;
        $unique = $model->unique($this->key, $this->value);
        if($unique){
            $this->errors[$this->key]="$this->name must be unique";
        }
        return $this;
    }

    public function isExist($model, $field = 'id'){
        $model = 'App\\Models\\'.$model;
        $model = new $model;
        $unique = $model->unique($field, $this->value);
        if(!$unique){
            $this->errors[$this->key]="$this->name must exist";
        }
        return $this;

    }

    /**
     * Vérifie si le nom de l'image est défini.
     *
     * @param string $image_name
     *
     * @return $this
     */
    public function image_name_check($image_name, $image_temp){
        if(empty($image_name)){
            
            $this->errors[$this->key] = "$this->name is required";

            return $this;
        }

        $new_image_name = $this->rename_image($image_name);

        $change_location = move_uploaded_file($image_temp, "image/".$new_image_name);

        if(!$change_location){
            $this->errors[$this->key] = "Failed to upload $this->name";
        }
        return $new_image_name;
    }

    /**
     * Vérifie si le type MIME de l'image temporaire correspond à un type d'image autorisée.
     *
     * @param string $image_temp est le chemin temporaire de l'image.
     *
     * @return self
     */
    public function isValidImageType($image_temp){
        $file_info = new \finfo(FILEINFO_MIME_TYPE);
        $mime_type = $file_info->file($image_temp);
        $allowed_image_types = ["image/jpeg", "image/jpg", "image/png"];

        if(in_array($mime_type, $allowed_image_types) == false){
            $this->errors[$this->key] = "Invalid $this->name format, accepted formats: jpeg, jpg, png";
        }
        return $this;
    }

    /**
     * Vérifie si la taille de l'image ne dépasse pas 2MB.
     *
     * @param int $image_size est la taille de l'image en octets.
     *
     * @return self
     */
    public function validateSize($image_size){
        $max_size = 2097152; // 2MB (2 *1024*1024)
        if($image_size > $max_size){
            $this->errors[$this->key] = "Image size must be less than 2MB";
        }
        return $this;
    }


    public function rename_image($image_name){
        $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $size = 15;
        $shuffle_chars = str_shuffle($chars);
        $random_name = substr($shuffle_chars, 0, $size);
        $extensions = pathinfo($image_name, PATHINFO_EXTENSION);
        $new_image_name = $random_name.'.'.$extensions;

        if(file_exists('image/' . $new_image_name)){
            // Si l'image existe, on renomme l'image avec un nouveau nom aleatoire
            return $this->rename_image($image_name);
        }else{
            // Sinon, on procède à la sauvegarde
            return $new_image_name;
        }
    }

    public function isSuccess(){
        if(empty($this->errors)) return true;
    }

    public function getErrors(){
        if(!$this->isSuccess()) return $this->errors;
    }
}

?>