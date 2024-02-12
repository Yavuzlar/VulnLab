<?php
header('Content-Type: application/json');

$usersData = file_get_contents('users.json');
$users = json_decode($usersData, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = json_decode(file_get_contents("php://input"), true);

    if ($requestData['action'] === 'forgot_password') {
        $username = $requestData['username'];

        $foundUser = null;
        foreach ($users as $user) {
            if ($user['username'] === $username) {
                $foundUser = $user;
                break;
            }
        }

        if ($foundUser) {
            $email = $foundUser['email'];
            $response = [
                "result" => $email,
                "type" => "email"
            ];
            http_response_code(200);
            echo json_encode($response);
            exit;
        } else {
            $response = [
                "error" => "User not found",
                "message" => "User with the provided username does not exist."
            ];
            http_response_code(404);
            echo json_encode($response);
            exit;
        }
    } else {
        $response = [
            "error" => "Invalid action",
            "message" => "Invalid action specified in the request."
        ];
        http_response_code(400);
        echo json_encode($response);
        exit;
    }
} else {
    $response = [
        "error" => "Invalid request method",
        "message" => "Invalid request method. Only POST requests are allowed."
    ];
    http_response_code(405);
    echo json_encode($response);
    exit;
}
?>
