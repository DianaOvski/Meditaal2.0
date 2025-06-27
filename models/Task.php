<?php
require_once __DIR__ . '/../config/database.php';

class Task {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO task (user_id, title, description, due_date, priority, completed, create_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param(
            "issssi",
            $data['user_id'],
            $data['title'],
            $data['description'],
            $data['due_date'],
            $data['priority'],
            $data['completed']
        );
        $stmt->execute();
        $stmt->close();
    }
}
