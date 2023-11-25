<?php
header('Content-Type: application/json');
include('client_api.php');
include('order_api.php');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Handle GET requests
        $table = $_GET['table'];
        if ($table === 'client') {
            echo json_encode(getAllClients());
        } elseif ($table === 'order') {
            echo json_encode(getAllOrders());
        }
        break;

    case 'POST':
        // Handle POST requests
        $table = $_POST['table'];
        $data = json_decode(file_get_contents('php://input'), true);

        if ($table === 'client') {
            echo json_encode(['id' => createClient($data)]);
        } elseif ($table === 'order') {
            echo json_encode(['id' => createOrder($data)]);
        }
        break;

    case 'PUT':
        // Handle PUT requests
        parse_str(file_get_contents('php://input'), $_PUT);
        $table = $_PUT['table'];
        $id = $_PUT['id'];
        $data = json_decode(file_get_contents('php://input'), true);

        if ($table === 'client') {
            echo json_encode(['rows_affected' => updateClient($id, $data)]);
        } elseif ($table === 'order') {
            echo json_encode(['rows_affected' => updateOrder($id, $data)]);
        }
        break;

    case 'DELETE':
        // Handle DELETE requests
        parse_str(file_get_contents('php://input'), $_DELETE);
        $table = $_DELETE['table'];
        $id = $_DELETE['id'];

        if ($table === 'client') {
            echo json_encode(['rows_affected' => deleteClient($id)]);
        } elseif ($table === 'order') {
            echo json_encode(['rows_affected' => deleteOrder($id)]);
        }
        break;
}
?>
