<?php
namespace App\Models;
use App\Models\CRUD;

class Groupe extends CRUD {
    protected $table = "groupe";
    protected $primaryKey = "gid";
    protected $fillable = ['name', 'description'];

    public function getProfessors($gid) {
        $sql = "SELECT 
                    prof.name AS professor_name,
                    prof.email AS professor_email
                FROM 
                    groupe
                JOIN 
                    groupe_has_cours ON groupe.gid = groupe_has_cours.groupe_gid
                JOIN 
                    prof ON groupe_has_cours.prof_pid = prof.pid
                WHERE 
                    groupe.gid = :gid";

        $stmt = $this->prepare($sql);
        $stmt->bindParam(':gid', $gid, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getStudentCount($gid) {
        $sql = "SELECT 
                    COUNT(DISTINCT etudiant.id) AS student_count
                FROM 
                    etudiant
                JOIN 
                    etudiant_has_groupe_has_cours ON etudiant.id = etudiant_has_groupe_has_cours.etudiant_id
                JOIN 
                    groupe_has_cours ON etudiant_has_groupe_has_cours.groupe_has_cours_groupe_gid = groupe_has_cours.groupe_gid
                WHERE 
                    groupe_has_cours.groupe_gid = :gid";

        $stmt = $this->prepare($sql);
        $stmt->bindParam(':gid', $gid, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result['student_count'];
    }
}
