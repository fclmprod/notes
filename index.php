<!DOCTYPE HTML>

<html>
    
<head>
    <title>Martin Campillo - Carnet de notes</title>
    <link rel="icon" href="/images/fav.ico" type="image/x-icon">
    <style type="text/css">
        @import url("./css/main.css");    
    </style>
    <script src="./js/jquery-2.1.4.min.js"></script>
</head>

<body class="day">
    
<?php
require_once("./libs/Parsedown.php");
require_once("./php/functions.php");

$Parsedown = new Parsedown();
    
$readme = file_get_contents("README.md");

include("menu.php");
?>
    

<div id="content">
<?php
$content = $_GET["content"];
$getFile = $_GET["file"];
    
$path = "./content/".$content."/";
$files = createArray($path);

    
if(isset($content)){
    echo "<h2>".$content."</h2>";
    if(empty($files)){
       echo "Vide";
    }

    else {
        echo "<ul>";
        foreach($files as $item){
            echo "<li><a href=\"#".$item["name"]."\">".$item["name"]."</a> <span>".date("d/m/y",$item["date"])."</span></li>";
        }
        echo "<ul>";
    }
}
else {
    echo $Parsedown -> text($readme);
}
?>
    <div id="files">

        <?php
        if(empty($files)){
           echo "Vide";
        }
        
        else {
            foreach($files as $item){
                echo "<div id=\"".$item["name"]."\">";
                echo "<h3>".$item["name"]."</h3>";
                if($item["extension"]=="md"){
                    echo $Parsedown -> text(file_get_contents($path.$item["name"]));
                }
                if($item["extension"]=="mp3"){
                    echo "<audio src=\"".$path.$item["name"]."\" controls>";
                }
                
                echo "</div>";
            }
        }
        ?>
        
    </div>
</div>

<script src="./js/main.js"></script>
</body>
</html>