<?php

namespace App\Core\Database;

use PDO;
use PDOException;

class Database
{
    protected $pdo;
    protected string $host;
    protected string $port;
    protected string $name;
    protected string $user;
    protected string $pass;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        // Establish a connection to the database
        $this->pdo = $this->connect();
    }

    /**
     * Establish a connection to the database.
     *
     * @return PDO
     */
    private function connect(): PDO
    {
        // Set database connection parameters
        $this->host = DB_HOST;
        $this->port = DB_PORT;
        $this->name = DB_NAME;
        $this->user = DB_USER;
        $this->pass = DB_PASS;

        try {
            // Create a PDO connection
            $connect = "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->name . ";charset=utf8mb4";
            $options = [PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC];
            return new PDO($connect, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            // Handle database connection error
            http_response_code(500);
            die('Database Connection Error: ' . $e->getMessage() . ' (check database connection variables on the app.php)');
        }
    }
}
