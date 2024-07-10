<?php
class Cours {
    public string $title;
    public string $description;
    public string $duration;
    public string $level;

    public function getCourseDetails(): string {
        return "Title: $this->title, Description: $this->description, Duration: $this->duration hours, Level: $this->level";
    }

    public function updateCourseInfo(string $newTitle, string $newDescription, string $newDuration): void {
        $this->title = $newTitle;
        $this->description = $newDescription;
        $this->duration = $newDuration;
    }
}
?>
