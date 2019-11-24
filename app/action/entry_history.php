<?php

$blog->login_check();

$history_id = (int)request::get('history_id');

$entry = $db('history')->select($history_id);

response::text($entry->body);
