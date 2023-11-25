<?php
include('db_config.php');

// Read all clients
function getAllClients() {
    global $conn;
    $result = $conn->query("SELECT * FROM client");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Create a new client
function createClient($data) {
    global $conn;
    // Implement validation and sanitation as needed
    $conn->query("INSERT INTO client (client_id, dba, register_date, phone, email, password, update_date, flag) VALUES (
        '{$data['client_id']}', '{$data['dba']}', '{$data['register_date']}', '{$data['phone']}', '{$data['email']}',
        '{$data['password']}', '{$data['update_date']}', '{$data['flag']}'
    )");
    return $conn->insert_id;
}

// Update a client
function updateClient($client_id, $data) {
    global $conn;
    // Implement validation and sanitation as needed
    $conn->query("UPDATE client SET
        dba = '{$data['dba']}', register_date = '{$data['register_date']}', phone = '{$data['phone']}',
        email = '{$data['email']}', password = '{$data['password']}', update_date = '{$data['update_date']}',
        flag = '{$data['flag']}'
        WHERE client_id = '{$client_id}'");
    return $conn->affected_rows;
}

// Delete a client
function deleteClient($client_id) {
    global $conn;
    $conn->query("DELETE FROM client WHERE client_id = '{$client_id}'");
    return $conn->affected_rows;
}
?>