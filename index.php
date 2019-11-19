<?php
include 'app/function.php';
include 'app/blog.php';

$blog = new blog('app/setting.php');
$db   = new db('app/data/db.php', 'blog');


switch($blog->action){
    case 'index'             : $blog->go('app/action/index.php');
    case 'entry'             : $blog->go('app/action/entry.php');
    case 'entry_create'      : $blog->go('app/action/entry_create.php');
    case 'entry_create_form' : $blog->go('app/action/entry_create_form.php');
    case 'entry_update'      : $blog->go('app/action/entry_update.php');
    case 'entry_update_form' : $blog->go('app/action/entry_update_form.php');
    case 'entry_delete'      : $blog->go('app/action/entry_delete.php');
    case 'comment'           : $blog->go('app/action/comment.php');
    case 'comment_create'    : $blog->go('app/action/comment_create.php');
    case 'comment_delete'    : $blog->go('app/action/comment_delete.php');
    case 'upload'            : $blog->go('app/action/upload.php');
    case 'upload_yearly'     : $blog->go('app/action/upload_yearly.php');
    case 'upload_daily'      : $blog->go('app/action/upload_daily.php');
    case 'upload_delete'     : $blog->go('app/action/upload_delete.php');
    case 'login'             : $blog->go('app/action/login.php');
    case 'login_form'        : $blog->go('app/action/login_form.php');
    case 'logout'            : $blog->go('app/action/logout.php');
    case 'feed'              : $blog->go('app/action/feed.php');
    default                  : $blog->go('app/action/index.php');
}
