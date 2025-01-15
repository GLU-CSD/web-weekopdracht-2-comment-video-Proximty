<?php
include("config.php");
include("reactions.php");

$getReactions = Reactions::getReactions();
//uncomment de volgende regel om te kijken hoe de array van je reactions eruit ziet
// echo "<pre>".var_dump($getReactions)."</pre>";

if(!empty($_POST)){

    // //dit is een voorbeeld array.  Deze waardes moeten erin staan.
    // $postArray = [
    //     'name' => "Ieniminie",
    //     'email' => "ieniminie@sesamstraat.nl",
    //     'message' => "Geweldig dit"
    // ];

    // $setReaction = Reactions::setReaction($postArray);

    // if(isset($setReaction['error']) && $setReaction['error'] != ''){
    //     prettyDump($setReaction['error']);
    // }
    

}


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
 
    <h2>Hieronder komen reacties</h2>
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

    <p>Maak hier je eigen pagina van aan de hand van de opdracht</p>
 </form>
</body>
</html>
<?php 

if (isset($_POST["Submit"])){
    $sql = 
    "INSERT INTO `reactions` (name, email,message)
      VALUES ('".$_POST['Name']."','".$_POST['Email']."','".$_POST['Comment']."')";
    $con->query($sql); 

    print "<h2>Your comment has been submitted!</h2>";
    $Name = $_POST["Name"];
    $Email = $_POST["Email"];
    $Comment = $_POST["Comment"];


    //old comments
    $Old = fopen("comments.txt", "r+t");
    $Old_Comments = fread($Old, 1024);


    //new comments 
    $Write = fopen("comments.txt", "w+");


    $String=
    "<div class='comment'><span>".$Name."</span><br />"."
    <span>".date('y/n/d')." | ".date("h:i A")."</span><br />
    <p>".$Comment."</span></div>\n".$Old_Comments;
fwrite($Write, $String);
fclose($Write);
fclose($Old);
}
$Read= fopen("comments.txt","r+t");
echo"<h1>Comments:</h1><chr>".fread($Read,1024);
fclose($Read);


?>
<?php
$con->close();
?>