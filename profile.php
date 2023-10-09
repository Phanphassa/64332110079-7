<?php
include('server.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); 
    exit;
}


$user_id = $_SESSION['user_id'];


$sql = "SELECT * FROM users WHERE id = $user_id";
$userResult = $conn->query($sql);

if ($userResult->num_rows > 0) {
    $userRow = $userResult->fetch_assoc();
    $username = $userRow['username'];
}

$sql = "SELECT * FROM posts WHERE user_id = $user_id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรไฟล์ผู้ใช้</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link rel="stylesheet" href="profile1.css">
</head>
<body>
<div class="menubar">
<div class="container">
    <h1 class="logo">PROFIEL</h1>
</div>
        <ul class="menu">
            <li><a href="posts.php">WEBBORD</a></li>
            <li><a href="web1.html">HOME</a></li>
            <li><a href="profile.php">PROFIEL</a></li>
            <li><a href="logout.php" id="logoutBtn">LOGOUT</a></li>
        </ul>
    </div>
    </div>
    

    <div class="main-content">
        <header>
            <p>Username: <?= isset($username) ? $username : 'N/A' ?></p>
            <p>User ID: <?= $user_id ?></p>
        </header>
        
        <main>
            <div class="profile">
                <h2>รายการกระทู้ของคุณ</h2>
           
                <?php while ($row = $result->fetch_assoc()): ?>
                    
                    <p><?= $row['content'] ?></p>
                    <a href="edit_post.php?id=<?= $row['id'] ?>" class="edit-link">EDIT</a>
                    <a href="delete_post.php?post_id=<?= $row['id'] ?>" class="edit-link">DELETE</a> <!-- เพิ่มปุ่มลบ -->
                <?php endwhile; ?>
            </div>
            <a href="create_post.php" class="add-post-link">ADDNEW</a>
        </main>
    </div>
     <!-- Main End -->

    <!-- Footer start -->
    <footer>
        <p>Made by Pang and Pook </p>
    </footer>
    <!-- Footer end -->

</body>
</html>
