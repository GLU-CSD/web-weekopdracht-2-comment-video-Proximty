<?php
include("config.php");
include("reactions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postArray = [
        'id' => $_POST['id'] ?? '',
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'message' => $_POST['message'] ?? ''
    ];
    $setReaction = Reactions::setReaction($postArray);
}



if (isset($setReaction['error']) && !empty($setReaction['error'])) {
    foreach ($setReaction['error'] as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
}
if (isset($setReaction['succes'])) {
    echo "<p style='color: green;'>{$setReaction['succes']}</p>";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit(); 
}    
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="./assets/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youtube remake</title>
</head>
<body>
<iframe width="1060" height="815" src="https://www.youtube.com/embed/Wr1KbcjIW8Q?si=eWw2zT3xv5WStAb4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    <form action="" method="POST">
    
    <div>
            Naam: <input type="text" name="name" value="" placeholder="Hier je Naam">
        </div>
        <div>
            Email: <input type="text" name="email" value="" placeholder="Hier je Email">
        </div>
        <div>
            <textarea name="message" cols="30" rows="10" placeholder="Schrijf hier je reactie..."></textarea>
        </div>
    <div>
    <input type="submit" name="Submit" value= "Submit "/>
    </div>
 </form>
 <h2>Reactions</h2>
 
    <div id="reactions-container">
        
        <?php
        $reactions = Reactions::getReactions();
        if (!empty($reactions)) {
            foreach ($reactions as $reaction) {
                echo "<div style='border: 1px solid #ddd; margin-bottom: 10px;'>";
                echo "<strong>Naam:</strong> " .htmlspecialchars($reaction['name']) . "<br>";
                echo "<strong>Email:</strong> " .htmlspecialchars($reaction['email']) . "<br>";
                echo "<strong>Bericht:</strong> " .htmlspecialchars($reaction['message']);
                echo "</div>";
            }
        }
         else {
            echo "<p>Er zijn nog geen reacties.</p>";
        }
        ?>
    </div>

</body>
</html>
<?php  
if (isset($_POST["Submit"])){
    $sql = 
    "INSERT INTO `reactions` (name, email,message)
      VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['message']."')";
    $con->query($sql); 

    print "<h2>Your comment has been submitted!</h2>";
   
}




?>
<?php
$con->close();
?>