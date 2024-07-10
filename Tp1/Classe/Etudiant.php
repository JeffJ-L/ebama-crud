<?php
class Etudiant { 
    public string $name;
    public string $address;
    public string $email;
    public string $phone;
    public string $cours;

    public function enrollInCourse($course): void {
        $this->cours = $course->title;
    }

    public function getStudentDetails(): string {
        return "Name: $this->name, Address: $this->address, Email: $this->email, Phone: $this->phone, Course: $this->cours";
    }
}
?>
