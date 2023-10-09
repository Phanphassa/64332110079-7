<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เว็บบอร์ด</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link rel="stylesheet" href="posts1.css">

</head>
<body>
    
    <div class="menubar">
    <div class="container">

    <div class="logo">
        <h1>WEBBORD</h1>
    </div>
        <ul class = "menu">
            <li> <a href="login.php"><li>LOGIN / REGISTER</a>
            <li><a href="web1.html">HOME</a></li>
            <li><a href="profile.php">PROFIEL</a></li>
            <li><a href="logout.php" id="logoutBtn">LOGOUT</a></li>
        </ul>
    </div>
    </div>
   
    
    <main>     
        <?php
        include('server.php');
 
        $sql = "SELECT * FROM posts ORDER BY created_at DESC";
        $result = $conn->query($sql);
        $totalPosts = $result->num_rows;

        echo "<div class='post-1'>";
        echo "<p>All posts: " . $totalPosts . " Posts</p>";
        $commentSql = "SELECT * FROM replies ORDER BY reply_content DESC";
        $commentResult = $conn->query($commentSql);

        $totalComments = $commentResult->num_rows;

        echo "<p>All reply: " . $totalComments . " comment</p>";
        echo "</div>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='post'>";
                echo "<h2>หัวข้อ:" . $row['title'] . "</h2>";
                echo "<p>กระทู้:" . $row['content'] . "</p>";
                echo "<p>id: " . $row['user_id'] . "</p>";
                echo "<button><a href='reply.php?post_id=" . $row['id'] . "'>REPLY</a></button>"; 
                echo "<button><a href='delete_post.php?post_id=" . $row['id'] . "'>DELETE</a></button>"; 
                echo "</div>";
            }
        } else {
            echo "ไม่พบกระทู้";
        }

        $conn->close();
        ?>
    </main>

    <footer>
        <a href="create_post.php">NEWPOST</a>
    </footer>
</body>
</html>