<?php
include('server.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: profile.php');
    exit;
}

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $user_id = $_SESSION['user_id'];

 

    $check_sql = "SELECT * FROM posts WHERE id = $post_id AND user_id = $user_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows == 1) {
        $delete_sql = "DELETE FROM posts WHERE id = $post_id";
        if ($conn->query($delete_sql) === TRUE) {
            header('Location: profile.php'); 
            exit;
        } else {
            echo 'Error deleting post: ' . $conn->error;
        }
    } else {
        echo 'คุณไม่มีสิทธิ์ในการลบกระทู้นี้';
    }

    $conn->close();
} else {
    echo 'ไม่ระบุ ID ของกระทู้ที่ต้องการลบ';
}
?>