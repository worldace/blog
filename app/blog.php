<?php

class blog{
    use immutable;

    function __construct(string $setting){
        $blog = $this;
        include $setting;

        $blog->app      = __DIR__;
        $blog->time     = request::time();
        $blog->action   = request::get('action') ?? 'index';
        $blog->asset    = $blog->home . 'asset';
        $blog->is_admin = password_verify($blog->password, request::cookie('p'));

        template::$dir = "$blog->app/parts";

        if(!file_exists($blog->dbfile)){
            include "$blog->app/install.php";
        }
    }

    function login_check(){
        if($this->is_admin){
            response::cookie('p', password_hash($this->password, PASSWORD_DEFAULT));
        }
        else{
            response::redirect('?action=login');
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
