<?php

$blog->login_check();

$id = (int)request::post('id');

$db->delete($id);

response::redirect($blog->home);