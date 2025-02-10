<?php

    namespace App\Models;

    use App\Core\Model;

    class Product extends Model
    {
        public function fetchAll(): array
        {
            $query = "SELECT * FROM products";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function fetchById(int $id)
        {
            $query = "SELECT * FROM products WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        }
    }