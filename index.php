<?php
include 'app/function.php';
include 'app/blog.php';
include 'app/boot.php';
include 'app/setting.php';


switch(request::get('action')){
    case ''                  : $blog->go('app/action/index.php');
    case 'entry'             : $blog->go('app/action/entry.php');
    case 'entry_create'      : $blog->go('app/action/entry_create.php');
    case 'entry_create_post' : $blog->go('app/action/entry_create_post.php');
    case 'entry_update'      : $blog->go('app/action/entry_update.php');
    case 'entry_update_post' : $blog->go('app/action/entry_update_post.php');
    case 'entry_delete'      : $blog->go('app/action/entry_delete.php');
    case 'login'             : $blog->go('app/action/login.php');
    case 'login_post'        : $blog->go('app/action/login_post.php');
    case 'logout'            : $blog->go('app/action/logout.php');
    default                  : $blog->go('app/action/index.php');
}
