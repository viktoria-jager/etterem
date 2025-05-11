<?php

class DishModel
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
        $sql = 'SELECT * FROM dishes ORDER BY name ASC';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function listActiveByDishType($dishTypeId, $limit = null)
    {
        $sql = 'SELECT * FROM dishes WHERE isActive = 1 AND dishTypeId = ? ORDER BY name ASC';
        if ($limit) {
            $sql .= ' LIMIT ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $dishTypeId, $limit);
        } else {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $dishTypeId);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function getOneById($id)
    {
        $sql = 'SELECT * FROM dishes WHERE id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_array();
    }

    public function create(array $args)
    {
        $sql = 'INSERT INTO dishes (name, price, description, imageUrl, isActive, dishTypeId) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdssii", ...$args);
        $stmt->execute();
        return true;
    }

    public function update(array $args)
    {
        $sql = 'UPDATE dishes SET name = ?, price = ?, description = ?, imageUrl = ?, isActive = ?, dishTypeId = ? WHERE id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdssiii", ...$args);
        $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM dishes WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
