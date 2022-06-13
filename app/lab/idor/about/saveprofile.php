<?php


try {
    $db = new PDO('sqlite:database.db');
} catch (PDOException $e) {
    echo $e->getMessage();
}
if (isset($_POST['puserid'])) {
    $userid = $_POST['puserid'];
    $name = $_POST['pname'];
    $job = $_POST['pjob'];
    $about = $_POST['pabout'];
    $email = $_POST['pemail'];
    $phone = $_POST['pphone'];
    $location = $_POST['plocation'];

    try {
        $query = $db->prepare("UPDATE profiles SET namesurname=?, job=?, about=?, email=?, phone=?, location=? WHERE id=?");
        $query->execute([$name, $job, $about, $email, $phone, $location, $userid]);
        header("Location: ./");
        die();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
