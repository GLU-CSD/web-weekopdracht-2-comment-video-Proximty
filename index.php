<?php
include("config.php");
include("reactions.php");

$getReactions = Reactions::getReactions();
//uncomment de volgende regel om te kijken hoe de array van je reactions eruit ziet
// echo "<pre>".var_dump($getReactions)."</pre>";
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
// if(!empty($_POST)){
//  echo "<pre>";
//  print_r($_POST);
//  echo "</pre>";
//     //dit is een voorbeeld array.  Deze waardes moeten erin staan.
//     // $postArray = [
//     //     'name' => $_POST['Name'],
//     //     'email' => $_POST['Email'],
//     //     'message' =>$_POST['Comment']
//     // ];
  

// }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youtube remake</title>
</head>
<body>
<iframe width="560" height="315" src="https://www.youtube.com/embed/Wr1KbcjIW8Q?si=eWw2zT3xv5WStAb4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
 
    
    <form action="" method="POST">
    <div>
        <input type="text"  name="Name" required />
    </div>
    <div>
        <input type="text"  name="Comment" required /><br />
    </div>
    <div>
        <input type="email"  name="Email" required />
    </div>

    <div>
    <input type="submit" name="Submit" value= "Submit "/>
    </div>
 </form>
</body>
</html>
<?php 
if(!empty($_POST)){
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
       //dit is een voorbeeld array.  Deze waardes moeten erin staan.
       // $postArray = [
       //     'name' => $_POST['Name'],
       //     'email' => $_POST['Email'],
       //     'message' =>$_POST['Comment']
       // ];
     
   
   }

if (isset($_POST["Submit"])){
    $sql = 
    "INSERT INTO `reactions` (name, email,message)
      VALUES ('".$_POST['Name']."','".$_POST['Email']."','".$_POST['Comment']."')";
    $con->query($sql); 

    print "<h2>Your comment has been submitted!</h2>";
   
}




?>
<?php
$con->close();
?>