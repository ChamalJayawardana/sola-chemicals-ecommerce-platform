<?php
include $_SERVER['DOCUMENT_ROOT']."/context/connect.php";

class Order {
    private $order_id;
    private $item_id;
    private $user_id;
    private $quantity;
    private $delivery_method_id;
    private $status;
    private $total;
    private $delivered_date;

    public function __construct($order_id = null, $item_id = null, $user_id = null, $quantity = null, $delivery_method_id = null, $status = null, $total = null, $delivered_date = null) {
        global $conn;
        if ($order_id === null) {
            $this->item_id = $item_id;
            $this->user_id = $user_id;
            $this->quantity = $quantity;
            $this->delivery_method_id = $delivery_method_id;
            $this->status = $status;
            $this->total = $total;
            $this->delivered_date = $delivered_date;

            // Insert order data
            $stmt = $conn->prepare("INSERT INTO `order` (item_id, user_id, quantity, delivery_method_id, status, total, delivered_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $this->item_id);
            $stmt->bindValue(2, $this->user_id);
            $stmt->bindValue(3, $this->quantity);
            $stmt->bindValue(4, $this->delivery_method_id);
            $stmt->bindValue(5, $this->status);
            $stmt->bindValue(6, $this->total);
            $stmt->bindValue(7, $this->delivered_date);
            $stmt->execute();
            $this->order_id = $conn->lastInsertId();
            $stmt = null;
        } else {
            $this->order_id = $order_id;

            // Retrieve order data
            $stmt = $conn->prepare("SELECT item_id, user_id, quantity, delivery_method_id, status, total, delivered_date FROM `order` WHERE id = ?");
            $stmt->bindValue(1, $this->order_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->item_id);
            $stmt->bindColumn(2, $this->user_id);
            $stmt->bindColumn(3, $this->quantity);
            $stmt->bindColumn(4, $this->delivery_method_id);
            $stmt->bindColumn(5, $this->status);
            $stmt->bindColumn(6, $this->total);
            $stmt->bindColumn(7, $this->delivered_date);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
        }
    }

    public function updateQuantity($quantity) {
        global $conn;
        $this->quantity = $quantity;
        $stmt = $conn->prepare("UPDATE `order` SET quantity = ? WHERE id = ?");
        $stmt->bindValue(1, $this->quantity);
        $stmt->bindValue(2, $this->order_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateStatus($status) {
        global $conn;
        $this->status = $status;
        $stmt = $conn->prepare("UPDATE `order` SET status = ? WHERE id = ?");
        $stmt->bindValue(1, $this->status);
        $stmt->bindValue(2, $this->order_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateTotal($total) {
        global $conn;
        $this->total = $total;
        $stmt = $conn->prepare("UPDATE `order` SET total = ? WHERE id = ?");
        $stmt->bindValue(1, $this->total);
        $stmt->bindValue(2, $this->order_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateDeliveredDate($delivered_date) {
        global $conn;
        $this->delivered_date = $delivered_date;
        $stmt = $conn->prepare("UPDATE `order` SET delivered_date = ? WHERE id = ?");
        $stmt->bindValue(1, $this->delivered_date);
        $stmt->bindValue(2, $this->order_id);
        $stmt->execute();
        $stmt = null;
    }

    public function deleteOrder() {
        global $conn;

        // Set foreign key references to null
        $stmt = $conn->prepare("UPDATE notification SET order_id = NULL WHERE order_id = ?");
        $stmt->bindValue(1, $this->order_id);
        $stmt->execute();
        $stmt = null;

        $stmt = $conn->prepare("UPDATE payment SET order_id = NULL WHERE order_id = ?");
        $stmt->bindValue(1, $this->order_id);
        $stmt->execute();
        $stmt = null;

        // Delete order data
        $stmt = $conn->prepare("DELETE FROM `order` WHERE id = ?");
        $stmt->bindValue(1, $this->order_id);
        $stmt->execute();
        $stmt = null;

        // Unset all properties
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    public function getItemName() {
        global $conn;
        $stmt = $conn->prepare("SELECT name FROM item WHERE id = ?");
        $stmt->bindValue(1, $this->item_id);
        $stmt->execute();
        $stmt->bindColumn(1, $name);
        $stmt->fetch(PDO::FETCH_BOUND);
        $stmt = null;
        return $name;
    }

    public function getDeliveryMethodName() {
        global $conn;
        $stmt = $conn->prepare("SELECT name FROM delivery_method WHERE id = ?");
        $stmt->bindValue(1, $this->delivery_method_id);
        $stmt->execute();
        $stmt->bindColumn(1, $name);
        $stmt->fetch(PDO::FETCH_BOUND);
        $stmt = null;
        return $name;
    }

    public function getUserName() {
        global $conn;
        $stmt = $conn->prepare("SELECT CONCAT(first_name, ' ', last_name) AS name FROM user WHERE id = ?");
        $stmt->bindValue(1, $this->user_id);
        $stmt->execute();
        $stmt->bindColumn(1, $name);
        $stmt->fetch(PDO::FETCH_BOUND);
        $stmt = null;
        return $name;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getDeliveredDate() {
        return $this->delivered_date;
    }

    public function getOrderId() {
        return $this->order_id;
    }
}
?>
