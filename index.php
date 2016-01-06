<!DOCTYPE HTML>

<html>
    
<head>
    <title>Martin Campillo - Carnet de notes</title>
    <link rel="icon" href="/images/fav.ico" type="image/x-icon">
    <style type="text/css">
        @import url("./css/main.css");    
    </style>
</head>

<body>
    
<?php
require_once("libs/Parsedown.php");

$parsedown = new Parsedown();
    
$readme = file_get_contents("README.md");
    
//echo $parsedown ->text($readme);
    

include("menu.php");
?>
    
<div id="content">
<?php

$content = $_GET["content"];
$getFile = $_GET["file"];    

if(isset($content)){
    echo "<h2>".$content."</h2>";
    
    $path = "./content/".$content."/";

    echo "<ul>";
    // Open a directory, and read its contents
    if (is_dir($path)){
      if ($dh = opendir($path)){
        while (($file = readdir($dh))){
            if( $file !== false && $file != "." && $file != ".." && $file != ".DS_Store") {
                echo "<li><a href=\"?content=".$content."&file=".$file."\">".$file."</a> <span>".date ("d/m/y", filemtime($path.$file))."</span></li>"; 

            }

        }

        closedir($dh);
      }
    }
    echo "</ul>";
    
}
    
else {
    echo $parsedown ->text($readme);
}
?>
<div id="file">
    <?php
    if(isset($getFile)){
        echo "<h3>".$getFile."</h3>";
        $fileContent = file_get_contents($path."/".$getFile);
        echo $parsedown ->text($fileContent);
        
    }
    ?>
    </div>
</div>    
</body>
</html>