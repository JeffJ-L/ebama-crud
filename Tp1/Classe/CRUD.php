<?php  

class CRUD extends PDO{
    public function __construct() {
        parent::__construct('mysql:host=localhost; dbname=; port=3306; charset=utf8',
    'root', '');
    }


    /**
     * Select all records from a specified table in the database and return them as an array.
     *
     * @param string $table The name of the table to select records from.
     * @param string $field The field to order by (default is 'id').
     * @param string $order The order of the results ('ASC' by default).
     * @return array An array containing all the selected records.
     */
    public function select($table, $field= 'id', $order = 'ASC'){
        $sql = "SELECT * FROM $table ORDER BY $field $order";
        $stmt = $this->query($sql);

        return $stmt->fetchAll();
    }


    // Par default le field est set à id mais on peut changer si notre base de donnée a une autre valeur
    public function selectId($table, $value, $field= 'id') {

        $sql = "SELECT * FROM $table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 1){
            return $stmt->fetch();

        }else {
            return false;
        }

    }

    public function insert($table, $data){

        $fieldName = implode(', ', array_keys($data)) ;
        $fieldValues = ":".implode(', :', array_keys($data));
        

        // echo $fieldName;

        $sql = "INSERT INTO $table ($fieldName) values ($fieldValues)";
        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();

        // echo "<br>";
        return $this->lastInsertId();

    }


    public function update($table, $data, $field = 'id'){
        $fieldName = null;
        foreach($data as $key=>$value){
            $fieldName .= "$key = :$key, ";
        }

        $fieldName = rtrim($fieldName, ', ');

        $sql = "UPDATE $table SET $fieldName WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }
        if($stmt->execute()){
            return true;
        }else {
            return false;
        };

    }


    public function delete($table, $value, $field = 'id'){

        $sql = "DELETE FROM $table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}


?>