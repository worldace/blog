<?php

class blog{
    use immutable;

    function __construct(){
        global $db;

        $this->app = __DIR__;
        $this->action = request::get('action') ?? 'index';

        doc::$dir = "$this->app/doc/";
        php::autoload($this->app);

        if(!file_exists("$this->app/data/blog.db")){
            include "$this->app/install.php";
        }
    }

    function is_login(){
        if(password_verify($this->password, request::cookie('p'))){
            $hash   = password_hash($this->password, PASSWORD_DEFAULT);
            $expire = $this->cookie_expire * 24 * 60 * 60 + $_SERVER['REQUEST_TIME'];
            setcookie('p', $hash, $expire, '', '', false, true);
        }
        else{
            response::redirect("$this->home?action=login");
        }
    }

    function page(){
        $page = request::get('page');
        return is::int($page, 1) ? $page : 1;
    }

    function go(string $file){
        global $blog, $db;
        include $file;
        exit;
    }

    function error(string $text = 'エラーが発生しました'){
        print str::template(file_get_contents('asset/error.html'), ['text'=> html::e($text), 'home'=>$this->home]);
        exit;
    }
}


$blog = new blog;
$db   = new db("$blog->app/data/blog.db", 'blog');
