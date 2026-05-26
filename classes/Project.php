<?php

class Project {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllProjects($userId) {
        $stmt = $this->pdo->prepare("
            SELECT 
                projektet.*,
                klientet.emri AS klienti_emri,
                perdoruesit.emri AS krijuesi_emri
            FROM projektet
            LEFT JOIN klientet ON projektet.klienti_id = klientet.id
            LEFT JOIN perdoruesit ON projektet.krijuar_nga = perdoruesit.id
            WHERE projektet.krijuar_nga = ?
            ORDER BY projektet.id DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProjectById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM projektet WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addProject($klienti_id, $titulli, $pershkrimi, $afati, $statusi, $prioriteti, $buxheti, $fajlli, $krijuar_nga) {
        $stmt = $this->pdo->prepare("
            INSERT INTO projektet 
            (klienti_id, titulli, pershkrimi, afati, statusi, prioriteti, buxheti, fajlli, krijuar_nga)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $klienti_id,
            $titulli,
            $pershkrimi,
            $afati,
            $statusi,
            $prioriteti,
            $buxheti,
            $fajlli,
            $krijuar_nga
        ]);
    }

    public function updateProject($id, $klienti_id, $titulli, $pershkrimi, $afati, $statusi, $prioriteti, $buxheti) {
        $stmt = $this->pdo->prepare("
            UPDATE projektet
            SET 
                klienti_id = ?,
                titulli = ?,
                pershkrimi = ?,
                afati = ?,
                statusi = ?,
                prioriteti = ?,
                buxheti = ?
            WHERE id = ?
        ");

        return $stmt->execute([
            $klienti_id,
            $titulli,
            $pershkrimi,
            $afati,
            $statusi,
            $prioriteti,
            $buxheti,
            $id
        ]);
    }

    public function deleteProject($id) {
        $stmt = $this->pdo->prepare("DELETE FROM projektet WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getClients() {
        $stmt = $this->pdo->prepare("SELECT id, emri, kompania FROM klientet ORDER BY emri ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
