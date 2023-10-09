<?php
include('server.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); 
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

   

 
    $sql = "INSERT INTO posts (title, content, user_id) VALUES ('$title', '$content', $user_id)";

    if ($conn->query($sql) === TRUE) {
        header('Location: webboard.html'); 
        exit;
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }

    $db->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applyformembership</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link rel="stylesheet" href="creat1.css">
</head>
<body>
<div class="menubar">
<div class="container">
<div class="logo">
    <h1 >CREAT POST</h1>
</div>
    <ul class="menu">
        <li><a href="login.php">LOGIN</a></li>
        <li><a href="web1.html">HOME</a></li>
        <li><a href="posts.php">WEBBORD</a></li>
    </ul>
</div>
</div>
    <main>
        <form action="create_post_process.php" method="POST">
            <div class="form-group">
                <label for="title">topic:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Subject:</label>
                <input type="text" id="content" name="content" required>
            </div>
            <div class="form-group">
                <button  n type="submit">Submit</button>
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