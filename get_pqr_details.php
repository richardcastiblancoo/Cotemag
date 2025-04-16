<?php
require_once 'config/db.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    
    try {
        $sql = "SELECT * FROM pqr_solicitudes WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $pqr = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($pqr) {
            header('Content-Type: application/json');
            echo json_encode($pqr);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'PQR not found']);
        }
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'ID not provided']);
}
?>