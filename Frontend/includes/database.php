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
            LOGGER::log($this->completeQuery($stmt->queryString, $params));
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            throw new Exception("Fehler bei der Abfrage: " . $e->getMessage() . "<br> Query: " . $query);
        }
    }

    public function executeSingleRowQuery($query, $params = array()) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            LOGGER::log($this->completeQuery($stmt->queryString, $params));
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            throw new Exception("Fehler bei der Abfrage: " . $e->getMessage());
        }
    }

    public function executeExists($query, $params = array()) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            LOGGER::log($this->completeQuery($stmt->queryString, $params));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return ($row !== false);
        } catch(PDOException $e) {
            throw new Exception("Fehler bei der Abfrage: " . $e->getMessage());
        }
    }

    public function closeConnection() {
        $this->conn = null;
    }

    # Creates the complete sql query for logging
    public function completeQuery($query, $params = array()) {
        $sql = $query;
        foreach ($params as $param => $value) {
            $sql = str_replace($param, "'" . $value . "'", $sql);
        }
        return $sql;
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
