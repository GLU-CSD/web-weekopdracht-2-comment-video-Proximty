<?php
include("config.php");
include("reactions.php");

$getReactions = Reactions::getReactions();
//uncomment de volgende regel om te kijken hoe de array van je reactions eruit ziet
// echo "<pre>".var_dump($getReactions)."</pre>";

if(!empty($_POST)){

    //dit is een voorbeeld array.  Deze waardes moeten erin staan.
    $postArray = [
        'name' => "Ieniminie",
        'email' => "ieniminie@sesamstraat.nl",
        'message' => "Geweldig dit"
    ];

    $setReaction = Reactions::setReaction($postArray);

    if(isset($setReaction['error']) && $setReaction['error'] != ''){
        prettyDump($setReaction['error']);
    }
    

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
    <form action="" methode="POST"></form>
    <label>Name:
        <input type="text"  name= 'Name' required /></label>
    <label>Comment:
        <textarea name= "Comment" required></textarea></label><br />
    <input type="submit" name="Submit" value= "Submit "/>

    <p>Maak hier je eigen pagina van aan de hand van de opdracht</p>
</body>
</html>
<?php 
if (isset($_POST["Submit"])){
    print" <h2> Your comment has been submitted!</h2>"
    $Name = $_POST["Name"];
    $Comment=$_POST["Comment"];
    //old comments
    $Old= fopen("comments.txt", "r+t");
    $Old_Comments = fread($Old, 1024);
    //new comments 
    $Write = fopen("comments.txt", "w+");
    $string=
    "<div class='comments'<span>".$Name."</span><br/>
    <span>".date('y/n/d')."|".date("h:i A")."</span><br/>
    <span>".$Comment."</span></div>/n". $Old_Comments;
fwrite($Write,$string);
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