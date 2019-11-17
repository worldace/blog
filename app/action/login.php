<?php

if($blog->password === request::post('password')){
    response::cookie('p', password_hash($blog->password, PASSWORD_DEFAULT));
    response::redirect($blog->home);
}
else{
    $blog->error('パスワードが違います');
}