<?php
include('server.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); 
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    

    $sql = "UPDATE posts SET title = '$title', content = '$content' WHERE id = $post_id AND user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        header('Location: profile.php'); 
        exit;
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }

    $conn->close();
} else {
    if (isset($_GET['id'])) {
        $post_id = $_GET['id'];
        $user_id = $_SESSION['user_id'];

        $conn = new mysqli('localhost', 'root', '', 'miniproject');
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        $sql = "SELECT * FROM posts WHERE id = $post_id AND user_id = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $title = $row['title'];
            $content = $row['content'];
        } else {
            echo 'ไม่พบกระทู้ที่ต้องการแก้ไข';
            exit;
        }

        $conn->close();
    } else {
        echo 'ไม่ระบุ ID ของกระทู้ที่ต้องการแก้ไข';
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขกระทู้</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link rel="stylesheet" href="edit1.css">
</head>
<body>

<div class="menubar">
  <div class="container">
   <div class="logo">
       <h1 >Edit Post</h1>
    </div>
        <ul class="menu">
            <li><a href="home.php">HOMEPAGE</a></li>
            <li><a href="profile.php">PROFIEL</a></li>
            <li><a href="logout.php" id="logoutBtn">LOGOUT</a></li>
        </ul>
    </div>
</div>
    
    <main>
        <form action="edit_post.php" method="POST">
            <input type="hidden" name="post_id" value="<?= $post_id ?>">
            <div class="form-group">
                <label for="title">หัวข้อ:</label>
                <input type="text" id="title" name="title" value="<?= $title ?>" required>
            </div>
            <div class="form-group">
                <label for="content">เนื้อหา:</label>
                <textarea type="text" id="content" name="content" required><?= $content ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit">บันทึก</button>
            </div>
        </form>
    </main>
   <!-- Main End -->

    <!-- Footer start -->
    <footer>
        <p>Made by Pang and Pook </p>
    </footer>
    <!-- Footer end -->

</body>
</html>