
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../CSS/cam.css">
        <link rel="stylesheet" type="text/css" href="../CSS/index.css">
        <title>Imaging</title>
     <style type="text/css">

        #results { padding:20px; border:1px solid; background:#ccc; }

    </style>

</head>
<body>
<ul>
  <li><a href="../Views/fileUpload.php">Home</a></li>
  <li><a href="edit.php">Edit Profile</a></li>
  <li><a href="gallery.php">Gallery</a></li>
  <li style="float:right"><a class="active" href="../Controllers/logout.php">Back To Login</a></li>
</ul>
<?php
     require ("../Config/database.php");
     require ("../Models/model.php");
     $image_array = getAllImages();


    $img_id = null;
    if (isset($_GET['img_id']))
    {
        $img_id = $_GET['img_id'];
    }
?>
<?php foreach($image_array as $image):?>


<img src="<?php 
    echo $image["picture"]; 

?>" alt="<?php echo $image["picture"]; ?>"><br>
<form method="post" action="?id=<?=$_SESSION['username'];?>&img_id=<?php echo $image['id']; ?>">
</form>
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
