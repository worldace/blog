<?php

class blog{
    use immutable;

    function __construct(string $setting){
        $blog = $this;
        include $setting;

        $this->app      = __DIR__;
        $this->time     = request::time();
        $this->action   = request::get('action') ?? 'index';
        $this->asset    = "{$blog->home}asset";
        $this->is_admin = password_verify($blog->password, request::cookie('p'));

        template::$dir = "$this->app/parts";
        php::autoload($this->app);

        if(!file_exists("$this->app/data/db.php")){
            include "$this->app/install.php";
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
