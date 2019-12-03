<?php

if(request::post('password') === $blog->password){
    response::cookie('p', password_hash($blog->password, PASSWORD_DEFAULT));
    response::redirect($blog->home);
}
else{
    $blog->error('パスワードが違います');
}