<?php

$content = $_GET["content"];
$path = "./content/";

echo "<ul>";
// Open a directory, and read its contents
if (is_dir($path)){
  if ($dh = opendir($path)){
    while (($file = readdir($dh))){
        if( $file !== false && $file != "." && $file != ".." && $file != ".DS_Store") {
            echo "<li><a href=\"?content=".$file."\">".$file. "</a></li>".date ("F d Y H:i:s.", filemtime($path.$file)); 
            
        }
      
    }
      
    closedir($dh);
  }
}
echo "</ul>";

if(isset($content)){
    echo "<h1>".$content."</h1>";
}

?>