<?php

class DishTypeModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "etterem");

        if ($this->conn->connect_error) {
            die("Adatbázis kapcsolat sikertelen: " . $this->conn->connect_error);
        }
    }

    public function list()
    {
        $sql = 'SELECT * FROM dishTypes ORDER BY name ASC';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOneById($id)
    {
        $sql = 'SELECT * FROM dishTypes WHERE id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_array();
    }

    public function create(array $args)
    {
        $sql = 'INSERT INTO dishTypes (name) VALUES (?)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", ...$args);
        $stmt->execute();
        return true;
    }

    public function update(array $args)
    {
        $sql = 'UPDATE dishTypes SET name = ? WHERE id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", ...$args);
        $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM dishTypes WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
