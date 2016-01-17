<div id="menu">
    <h1><a href="http://localhost:8888/Gits/notes/">Martin Campillo</a></h1>
    <p>Carnet de notes, travaux en cours et reflexions diverses.</p>
    
    
<?php

require_once("./php/functions.php");
$path = "./content/";
displayArray(sortArray(createArray($path),"date"));

?>  
    <div class="colorSwitch night">  
      <input type="checkbox" id="colorSwitch" />
      <label for="colorSwitch"></label>
    </div>
    
    <h6>Version 0.0.1</h6>
    
    <script src="./js/main.js"></script>
    
</div>