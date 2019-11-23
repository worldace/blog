<?php

$blog->login_check();


$comment_id = (int)request::post('comment_id');

$db('comment')->update($comment_id, ['status'=>'delete']);

