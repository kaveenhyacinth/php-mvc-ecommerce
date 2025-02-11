<?php

    namespace App\Models;

    use App\Core\Model;

    class Cart extends Model
    {
        public function createCart(string $sessionId): int
        {
            $insertQuery = "INSERT INTO carts (session_id) VALUES (:session_id)";
            $stmt = $this->db->prepare($insertQuery);
            $stmt->bindParam(':session_id', $sessionId);
            $stmt->execute();
            $lastId = $this->db->lastInsertId();
            return (int)$lastId;
        }

        public function addToCart(int $cartId, int $productId): void
        {
            $selectQuery = "SELECT * from cart_items WHERE cart_id = :cart_id AND product_id = :product_id LIMIT 1";
            $stmt1 = $this->db->prepare($selectQuery);
            $stmt1->bindParam(':cart_id', $cartId);
            $stmt1->bindParam(':product_id', $productId);
            $stmt1->execute();
            $result = $stmt1->fetch();

            if ($result) {
                $updateQuery = "UPDATE cart_items SET quantity = quantity + 1 WHERE cart_id = :cart_id AND product_id = :product_id";
                $stmt2 = $this->db->prepare($updateQuery);
                $stmt2->bindParam(':cart_id', $cartId);
                $stmt2->bindParam(':product_id', $productId);
                $stmt2->execute();
                return;
            }

            $insertQuery = "INSERT INTO cart_items (cart_id, product_id) VALUES (:cart_id, :product_id)";
            $stmt = $this->db->prepare($insertQuery);
            $stmt->bindParam(':cart_id', $cartId);
            $stmt->bindParam(':product_id', $productId);
            $stmt->execute();
        }

        public function fetchCartBySessionId(string $sessionId)
        {
            $query = "SELECT * FROM carts WHERE session_id = :session_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':session_id', $sessionId);
            $stmt->execute();
            $result = $stmt->fetch();
            if (!$result) {
                return null;
            }
            return $result['id'];
        }

        public function fetchCartItems(int $cartId): array
        {
            $query = <<<SQL
                SELECT 
                    ci.*, p.* 
                FROM cart_items as ci 
                    INNER JOIN products as p 
                        ON ci.product_id = p.id
                WHERE cart_id = :cart_id
            SQL;
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':cart_id', $cartId);
            $stmt->execute();

            return $stmt->fetchAll();
        }

    }