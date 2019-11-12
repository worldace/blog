<?php

class blog{
    use immutable;

    function __construct(){
        $this->app = __DIR__;
        $this->time = request::time();
        $this->action = request::get('action') ?? 'index';

        template::$dir = "$this->app/parts";
        php::autoload($this->app);

        if(!file_exists("$this->app/data/blog.db")){
            include "$this->app/install.php";
        }
    }

    function is_login(){
        if(password_verify($this->password, request::cookie('p'))){
            response::cookie('p', password_hash($this->password, PASSWORD_DEFAULT));
        }
        else{
            response::redirect("$this->home?action=login");
        }
    }

    function go(string $file){
        global $blog, $db;
        include $file;
        exit;
    }

    function error(string $str = 'エラーが発生しました', int $code = 500){
        http_response_code($code);
        print new template(file_get_contents('asset/error.html'), ['text'=> $str, 'home'=>$this->home]);
        exit;
    }
}


$blog = new blog;
$db   = new db("$blog->app/data/blog.db", 'blog');
