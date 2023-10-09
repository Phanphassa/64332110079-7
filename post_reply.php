<?php
include('server.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); 
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'];
    $reply_content = $_POST['reply_content'];
    $user_id = $_SESSION['user_id'];


    $reply_content = $conn->real_escape_string($reply_content);

    $sql = "INSERT INTO replies (post_id, user_id, reply_content) VALUES ('$post_id', '$user_id', '$reply_content')";

    if ($conn->query($sql) === TRUE) {
        header("Location: reply.php?post_id=$post_id");
        exit;
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }

    $conn->close();
}