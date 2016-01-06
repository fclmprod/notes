<div id="menu">
    <h1>Martin Campillo</h1>
    <h4>Carnet de notes, travaux en cours et reflexions diverses.</h4>
    
<?php
    
$path = "./content/";

echo "<ul>";
// Open a directory, and read its contents
if (is_dir($path)){
  if ($dh = opendir($path)){
    while (($file = readdir($dh))){
        if( $file !== false && $file != "." && $file != ".." && $file != ".DS_Store") {
            echo "<li><a href=\"?content=".$file."\">".$file. "</a> <span>".date ("d/m/y", filemtime($path.$file))."</span></li>"; 
            
        }
      
    }
      
    closedir($dh);
  }
}
echo "</ul>";
?>
    
</div>