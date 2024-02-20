<?php
function readData() {
    $data = file_get_contents('main.json');
    return json_decode($data, true);
}

function writeData($data) {
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('main.json', $jsonData);
}

$method = $_SERVER['REQUEST_METHOD'];

// GET
if ($method === 'GET') {
    $users = readData();
    if ($users) {
        echo json_encode($users);
    } else {
        echo "Kullanıcı bulunamadı.";
    }
}



// POST
if ($method === 'POST') {
    parse_str(file_get_contents("php://input"), $data);
    $username = $data['username'];
    $newPassword = $data['newpassword'];
    $users = readData();
    $userFound = false;
    foreach ($users as &$user) {
        if ($user['username'] === $username) {
            $user['password'] = $newPassword;
            $userFound = true;
            break;
        }
    }
    if ($userFound) {
        writeData($users);
        header("Location: userFound.php");
    } else {
        echo "Kullanıcı bulunamadı. Kullanıcı adı: $username";
    }
}

// DELETE
if ($method === 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $username = $data['username'];
    $users = readData();
    $userFound = false;
    foreach ($users as $key => $user) {
        if ($user['username'] === $username) {
            unset($users[$key]);
            $userFound = true;
            break;
        }
    }
    if ($userFound) {
        writeData($users);
        echo "Kullanıcı başarıyla silindi.";
    } else {
        echo "Kullanıcı bulunamadı. Kullanıcı adı: $username";
    }
}
