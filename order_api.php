<?php
include('db_config.php');

// Read all orders
function getAllOrders() {
    global $conn;
    $result = $conn->query("SELECT * FROM order_table");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Create a new order
function createOrder($data) {
    global $conn;
    // Implement validation and sanitation as needed
    $conn->query("INSERT INTO order_table (order_id, client_id, register_date, delivery_date, bread_quantity, total, flag) VALUES (
        '{$data['order_id']}', '{$data['client_id']}', '{$data['register_date']}', '{$data['delivery_date']}',
        '{$data['bread_quantity']}', '{$data['total']}', '{$data['flag']}'
    )");
    return $conn->insert_id;
}

// Update an order
function updateOrder($order_id, $data) {
    global $conn;
    // Implement validation and sanitation as needed
    $conn->query("UPDATE order_table SET
        client_id = '{$data['client_id']}', register_date = '{$data['register_date']}', delivery_date = '{$data['delivery_date']}',
        bread_quantity = '{$data['bread_quantity']}', total = '{$data['total']}', flag = '{$data['flag']}'
        WHERE order_id = '{$order_id}'");
    return $conn->affected_rows;
}

// Delete an order
function deleteOrder($order_id) {
    global $conn;
    $conn->query("DELETE FROM order_table WHERE order_id = '{$order_id}'");
    return $conn->affected_rows;
}
?>
