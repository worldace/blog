<?php

$dir = 'upload/' . date('Y/md');

if(!is_dir($dir)){
    dir::create($dir);
}

$upload = request::upload('file', $dir);

if(!$upload['file']){
    $blog->error();
}

response::text(sprintf('<img src ="%s%s/%s" %s>', $blog->home, $dir, basename($upload['file']), @getimagesize($upload['file'])[3]));
