<?php

$db   = new db($blog->dbfile);

$db('blog')->table_create([
    'id'             => 'integer primary key autoincrement',
    'title'          => 'text not null',
    'category'       => 'json default ""',
    'body'           => 'text not null',
    'create_time'    => 'integer not null',
    'update_time'    => 'integer',
    'status'         => 'text not null default "open"',
    'comment_count'  => 'integer default 0',
    'comment_time'   => 'integer',
    'comment_enable' => 'integer default 1 check(comment_enable == 0 or comment_enable == 1)',
    'pageview'       => 'integer default 0',
    'eyecatch'       => 'text',
    'evaluate'       => 'text',
    'memo'           => 'text',
]);

$db('history')->table_create([
    'id'             => 'integer primary key autoincrement',
    'entry_id'       => 'integer not null',
    'time'           => 'integer not null',
    'body'           => 'text not null',
]);

$db('comment')->table_create([
    'id'             => 'integer primary key autoincrement',
    'entry_id'       => 'integer not null',
    'name'           => 'text not null',
    'body'           => 'text not null',
    'ip'             => 'text',
    'time'           => 'integer not null',
    'status'         => 'text not null default "open"',
    'evaluate'       => 'text',
    'memo'           => 'text',
]);


$db->query('create index comment_index on comment (entry_id)');
$db->query('create index history_index on history (entry_id)');
