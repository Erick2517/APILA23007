<?php
declare(strict_types=1);
namespace App;
use PDO;

class Database {
    private string $host;
    private string $port;
    private string $user;
    private string $pass;
    private string $db;
    private string $charset;

    public function __construct() {
        $this->host = $_ENV['DB_HOST'] ?? 'localhost';
        $this->port = $_ENV['DB_PORT'] ?? '3306';
        $this->user = $_ENV['DB_USER'] ?? 'apila23007';
        $this->pass = $_ENV['DB_PASS'] ?? 'apila23007';
        $this->db = $_ENV['DB_NAME'] ?? 'apila23007';
        $this->charset = $_ENV['DB_CHARSET'] ?? 'utf8mb4';
    }

    public function connection(): PDO {
        $dsn = "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db . ";charset=" . $this->charset;
        $pdo = new PDO($dsn, $this->user, $this->pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    }

}