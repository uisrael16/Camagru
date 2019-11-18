<?php
// ini_set('display_errors', 1);
//     ini_set('display_startup_errors', 1);
//     error_reporting(E_ALL);
session_start();

if (isset($_SESSION['login']))
{
    $login_id = $_SESSION['login']['id'];
    $login_username = $_SESSION['login']['username'];
}

?>
<html>
    <head>
        <title>Imaging</title>
        <link rel="stylesheet" type="text/css" href="../CSS/cam.css">
        <link rel="stylesheet" type="text/css" href="../CSS/index.css">
     <style type="text/css">

        #results { padding:20px; border:1px solid; background:#ccc; }

    </style>

</head>
<body>
<ul>
  <li><a href="../Views/fileUpload.php">Home</a></li>
  <li><a href="edit.php">Edit Profile</a></li>
  <li><a href="gallery.php">Gallery</a></li>
  <li style="float:right"><a class="active" href="../Controllers/logout.php">Logout</a></li>
</ul>
<?php
    require ("../Models/model.php");
    $image_array = getAllImages();


    $img_id = null;
    if (isset($_GET['img_id']))
    {
        $img_id = $_GET['img_id'];
    }
    if (isset($_POST['submit_comment']))
    {
        $comment = strip_tags($_POST['comment']);
        if (empty($comment))
        {
            echo "<p>blank comment</p>";
        }
        else
        {
            require("../Config/database.php");
            $sql = "INSERT INTO comments (username, image_id, comment) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $login_username);
            $stmt->bindParam(2, $img_id);
            $stmt->bindParam(3, $comment);
            $stmt->execute();

            $username = $_GET['id'];

            require ("../Config/database.php");
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $username);
            $stmt->execute();
            
            $result = $stmt->fetch();

            //die($result['email']);

        }
        
    }

    if (isset($_POST['like']))
    {
        if ($login_username)
        {
            $username = $_GET['id'];

            require ("../Config/database.php");
            $sql = "SELECT * FROM likes WHERE username = ? AND image_id = ?";
            $stmt = $conn->prepare($sql);
            // $stmt->bindParam(1, $username);
            $stmt->execute([$username, $img_id]);
            $res = $stmt->fetch();
            
            if ($stmt->rowCount() < 1){
            require("../Config/database.php");
            $sql = "INSERT INTO likes (username, image_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $login_username);
            $stmt->bindParam(2, $img_id);
            $stmt->execute();
            }
        }
    }

    function display_comment($comment_id)
    {
        require ("../Config/database.php");
        $sql = "SELECT * FROM comments WHERE image_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $comment_id);
        $stmt->execute();
        $comments = $stmt->fetchAll();
        if ($stmt->rowCount() > 0)
        {
            foreach($comments as $comment)
            {
                echo "<h5>".$comment['username']."</h5>";
                echo "<p>".$comment['comment']."</p>";
            }
        }
    }

    function count_likes($like_id)
    {

        require ("../Config/database.php");
        $sql = "SELECT * FROM likes WHERE image_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $like_id);
        $stmt->execute();
        echo $stmt->rowCount()." like";
    }

?>
<?php foreach($image_array as $image):?>


<img src="<?php 
    echo $image["picture"]; 

?>" alt="<?php echo $image["picture"]; ?>"><br>
<form method="post" action="?id=<?=$_SESSION['username'];?>&img_id=<?php echo $image['id']; ?>">
    <input type="text" name="comment" placeholder="type comment here ..."><br>
    <button name="submit_comment" type="submit">submit comment</button><br>
    <?php count_likes($image['id']); ?>
    <button type="submit" name="like">like</button><br>
   
</form>
<?php display_comment($image['id']) ?>
<?php endforeach; ?>
 <div class="footer" style="    background:  royalblue;
    position: fixed;
    bottom: 0;
    left: 0;
    //hieght :200%;
    overflow: hidden;
    width: 100%;">
    <center><p style="display:inline; color:white"> &copy uisrael </p></center>
     <div>
       
     </div>
</div>
</body>
</html>
