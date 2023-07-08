<?php

class DatabaseConnection {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            throw new Exception("Verbindung zur Datenbank fehlgeschlagen: " . $e->getMessage());
        }
    }

    public function executeQuery($query, $params = array()) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            throw new Exception("Fehler bei der Abfrage: " . $e->getMessage());
        }
    }

    public function executeSingleRowQuery($query, $params = array()) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            throw new Exception("Fehler bei der Abfrage: " . $e->getMessage());
        }
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
/* Example

try {
    $db = new DatabaseConnection("localhost", "dein_username", "dein_passwort", "deine_datenbank");

    $query = "SELECT * FROM deine_tabelle WHERE id = :id";
    $params = array(':id' => 1);
    $result = $db->executeQuery($query, $params);

    foreach ($result as $row) {
        echo "ID: " . $row['id'] . ", Name: " . $row['name'] . "<br>";
    }

    $db->closeConnection();
} catch (Exception $e) {
    echo "Fehler: " . $e->getMessage();
}


*/
?>
