<?php

$y    = request::post('y');
$m    = request::post('m');
$d    = request::post('d');
$file = request::post('file');
$dir  = "upload/$y/$m$d";

if(!checkdate($m, $d, $y)){
    $blog->error();
}
if(str::match($file, '/')){
    $blog->error();
}


unlink("$dir/$file");


if(dir::is_empty($dir)){
    dir::delete($dir);
    response::redirect("?action=upload_yearly&y=$y");
}
else{
    response::redirect("?action=upload_daily&y=$y&m=$m&d=$d");
}