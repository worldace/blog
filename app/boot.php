<?php

$dir = __DIR__;


php::autoload($dir);

$blog = new blog;

if(!file_exists("$dir/blog.db")){
    require "$dir/install.php";
}