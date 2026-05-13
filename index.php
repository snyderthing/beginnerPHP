<?php

function dd($value) {
echo "<pre>";
var_dump($value);
echo "</pre>";
die();
}



$heading = "Home";

require "views/index.view.php";