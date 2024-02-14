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

//GET
if ($method === 'GET') {
    $users = readData();
    if ($users) {
        echo json_encode($users);
    } else {
        echo "Kullanıcı bulunamadı.";
    }
}

// PATCH
if ($method === 'POST') {
    parse_str(file_get_contents("php://input"), $data);
    $username = $data['username'];
    $newPassword = $data['newpassword'];
    $users = readData();
    foreach ($users as &$user) {
        if ($user['username'] === $username) {
            $user['password'] = $newPassword;
            break;
        }
    }
    writeData($users);
    echo "Şifre başarıyla güncellendi.";
}

// DELETE
if ($method === 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $username = $data['username'];
    $users = readData();
    foreach ($users as $key => $user) {
        if ($user['username'] === $username) {
            unset($users[$key]);
            break;
        }
    }
    writeData($users);
    echo "Kullanıcı başarıyla silindi.";
}
?>
