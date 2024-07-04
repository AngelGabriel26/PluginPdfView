<?php

// Connect to the database
$host = 'localhost';
$db   = 'ojs-annotations';
$user = 'alejandra';
$pass = 'A1ejandr@.220';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Get data from the POST request body
$data = json_decode(file_get_contents('php://input'), true);
$type = $data['type'];
$text = $data['text'];
$note = isset($data['note']) ? $data['note'] : null;

// Save the annotation in the database
$stmt = $pdo->prepare('INSERT INTO annotations (type, text, note) VALUES (?, ?, ?)');
$stmt->execute([$type, $text, $note]);

echo json_encode(['status' => 'success']);

?>
