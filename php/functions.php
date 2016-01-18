<?php
/* Functions :
 *
 * - Put directories / files in array with date
 * - Sort the array by date;
 */

function createArray($path){
    $array = [];
    $num = 0;
    
    if (is_dir($path)){
      if ($dh = opendir($path)){
        while (($file = readdir($dh))){
            if($file != "." && $file != ".." && $file != ".DS_Store") {
                $array[$num++] = [
                    "basename" => pathinfo($path.$file, PATHINFO_BASENAME),
                    "name" => pathinfo($path.$file, PATHINFO_FILENAME),
                    "extension" => pathinfo($path.$file, PATHINFO_EXTENSION),
                    "date" => filemtime($path.$file)
                ];
            }
        }
        closedir($dh);
      }
    }
    return $array;
}

function sortArray($array) {
    function cmp($a, $b){
      return ($a['date'] > $b['date']) ? -1 : 1;
    }
    usort($array, 'cmp');
    return $array;
}
    
function displayArray($array) {
    echo "<ul>";
    foreach ($array as $value) {
       echo "<li><a href=\"?content=".$value["name"]."\">".$value["name"]. "</a> <span>".date("d/m/y",$value["date"])."</span></li>";
    }
    echo "</ul>";
}
    
?>  