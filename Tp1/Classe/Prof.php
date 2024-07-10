<?php
class Prof {
    public string $name;
    public string $department;
    public string $email;
    public string $phone;

    public function assignCourse($course): void {
        // Assigner un cours à un prof
        echo "Le cours {$course->title} est enseigne par {$this->name}.";
    }

    public function getProfDetails(): string {
        return "Name: $this->name, Department: $this->department, Email: $this->email, Phone: $this->phone";
    }
}
?>
