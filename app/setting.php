<?php

$blog->password = "1";

$blog->home = "http://127.0.0.1/blog/";

$blog->title = "Blog";

$blog->admin = "管理人";

$blog->index_count = 100;

$blog->upload_yearly_first = 2017;



$blog->asset = "{$blog->home}asset";

$blog->is_admin = password_verify($blog->password, request::cookie('p'));
