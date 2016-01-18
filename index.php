<!DOCTYPE HTML>

<html>
    
<head>
    <title>Martin Campillo - Carnet de notes</title>
    <link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAAAAAAAA////AAAAowBAQEAATExNADAwMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFBQMDAwMDAwMCAwUAAAAABQEBAgEBAQEBAgEBAAAAAAUFAwMDAwMDAwIDAwAAAAAFAwMDAwMDAwMCAwUAAAAABQUDAwMDAwMDAgMDAAAAAAUDAwMDAwMDAwIDBQAAAAAFBQMDAwMDAwMCAwMAAAAABQMDAwMDAwMDAgMFAAAAAAUFAwMDAwMDAwIDAwAAAAAFAwMDAwMDAwMCAwUAAAAABQUDAwMDAwMDAgMDAAAAAAUDAwMDAwMDAwIDBQAAAAAFBQMDAwMDAwMCAwMAAAAABQMDAwMDAwMDAgMFAAAAAAUFAwMDAwMDAwIDAwAAAAAFBAQEBAQEBAQCBAUAAMADAADAAwAAwAMAAMADAADAAwAAwAMAAMADAADAAwAAwAMAAMADAADAAwAAwAMAAMADAADAAwAAwAMAAMADAAA=" rel="icon" type="image/x-icon" />
    <style type="text/css">
        @import url("./css/main.css");    
    </style>
    <script src="./js/jquery-2.1.4.min.js"></script>
    
    <link rel="stylesheet" href="./libs/highlight/styles/dark.css">
    <script src="./libs/highlight/highlight.pack.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>

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
usort($files,function($a,$b){
    return ($a['date'] < $b['date']) ? -1 : 1;
});
echo "<div id=\"texts\">";
    
if(!isset($content)) {
    echo $Parsedown -> text($readme);
}
?>
    
        <?php
        echo "<h1>".$content."</h1>";
        if(!empty($files) || isset($content)){
            foreach($files as $item){
                
                //echo "<h3>".$item["name"]."</h3>";
                // Markdown
                if($item["extension"]=="md"){
                    echo "<div id=\"".$item["name"]."\">";
                    echo $Parsedown -> text(file_get_contents($path.$item["basename"]));
                    echo "</div>";
                }
                // Audio (mp3 or wav)
                
                
                if($item["extension"]=="pde" || $item["extension"]=="js"){
                    echo "<pre>";
                    echo "<code class=\"".$item["extension"]."\">";
                    echo file_get_contents($path.$item["basename"]);
                    echo "</code>";
                    echo "</pre>";
                }
                
                
            }
        }
        ?>
    </div>
    <div id="images">
        <?php
        if(!empty($files) || isset($content)){
            foreach($files as $item){
                // Images
                if($item["extension"]=="jpg" || $item["extension"]=="jpeg" || $item["extension"]=="gif" || $item["extension"]=="png"){
                    echo "<div id=\"".$item["name"]."\">";
                    echo "<img src=\"".$path.$item["basename"]."\">";
                    echo "</div>";
                }
                if($item["extension"]=="mp3" || $item["extension"]=="wav"){
                    echo "<div id=\"".$item["name"]."\">";
                    echo "<audio src=\"".$path.$item["basename"]."\" controls>";
                    echo "</div>";
                }
                if($item["extension"]=="webloc"){
                    echo "<iframe src=\"https://player.vimeo.com/video/".$item["name"]."?color=ffffff&byline=0&portrait=0\" width=\"500\" height=\"281\" frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
                }
            }
        }
        ?>
    </div>
</div>

<script src="./js/main.js"></script>
</body>
</html>