<?php
include 'app/function.php';
include 'app/blog.php';
include 'app/boot.php';
include 'app/setting.php';


switch(request::get('action')){
    case ''                  : $blog->go('app/action/index.php');
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
    case 'login'             : $blog->go('app/action/login.php');
    case 'login_form'        : $blog->go('app/action/login_form.php');
    case 'logout'            : $blog->go('app/action/logout.php');
    case 'feed'              : $blog->go('app/action/feed.php');
    default                  : $blog->go('app/action/index.php');
}
