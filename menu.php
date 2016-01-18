<div id="menu">
    <h1><a href="http://localhost:8888/Gits/notes/">Martin Campillo</a></h1>
    <p>Carnet de notes, travaux en cours et reflexions diverses.</p>
    
    
<?php

require_once("./php/functions.php");
$root = "./content/";
displayArray(sortArray(createArray($root),"date"));

?>  
    <div id="footer">
        <div class="colorSwitch night">  
          <input type="checkbox" id="colorSwitch" checked />
          <label for="colorSwitch"></label>
        </div>
        <h6>Version 0.0.1
        <br>
        <a href="https://github.com/fclmprod/notes/">github.com/fclmprod/notes/</a></h6>
    </div>
    <script src="./js/main.js"></script>
    
</div>