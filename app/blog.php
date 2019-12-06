<?php

class blog{
    use immutable;

    function __construct(string $setting){
        $blog = $this;
        include $setting;

        $blog->app      = __DIR__;
        $blog->time     = request::time();
        $blog->action   = request::get('action', 'index');
        $blog->asset    = $blog->home . 'asset';
        $blog->is_admin = password_verify($blog->password, request::cookie('p'));

        template::$dir = "$blog->app/gadget";

        if(!file_exists($blog->dbfile)){
            include "$blog->app/install.php";
        }
    }

    function login_check(){
        if($this->is_admin){
            if(request::is_post() && !str::match_start($this->home, url::home(request::referer()))){
                $this->error('リファラが異なります');
            }
            response::cookie('p', password_hash($this->password, PASSWORD_DEFAULT));
        }
        else{
            response::redirect('?action=login');
        }
    }

    function encode_category(?string $str) :string{
        if(is::empty($str)){
            return '';
        }
        foreach(preg_split("/[\s\t　]+/u", $str) as $v){
            if($v === ''){
                continue;
            }
            if(str::match_extra($v)){
                $this->error('カテゴリ名に半角記号は使えません');
            }
            $category[] = $v;
        }
        return json_encode($category, JSON_UNESCAPED_UNICODE);
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
