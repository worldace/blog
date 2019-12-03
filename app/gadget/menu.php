<?php

global $blog;


print $blog->is_admin ? <<<'END'
<nav class="menu">
<button>メニュー</button>
<ul>
  <li><a href="./">ホーム</a></li>
  <li><a href="?action=search_form">検索</a></li>
  <li><a href="?action=category_list">カテゴリリスト</a></li>
  <li class="menu-sub"><a>最近見た記事</a>
    <ul class="menu-recent">
      <li><a>(なし)</a></li>
    </ul>
  </li>
  <li></li>
  <li><a href="?action=entry_create_form">新規投稿</a></li>
  <li><a href="?action=upload_yearly">アップロードリスト</a></li>
  <li><a href="?action=login_form">ログイン</a></li>
  <li><a href="?action=logout">ログアウト</a></li>
</ul>
</nav>
END : <<<'END'
<nav class="menu">
<button>メニュー</button>
<ul>
  <li><a href="./">ホーム</a></li>
  <li><a href="?action=search_form">検索</a></li>
  <li><a href="?action=category_list">カテゴリリスト</a></li>
  <li class="menu-sub"><a>最近見た記事</a>
    <ul class="menu-recent">
      <li><a>(なし)</a></li>
    </ul>
  </li>
  <li></li>
  <li><a href="?action=login_form">ログイン</a></li>
</ul>
</nav>
END;



$head = <<<'END'
<style>
.menu{
    text-align: right;
    position: relative;
    user-select: none;
}
.menu > button{
    cursor: pointer;
    padding: 4px 12px;
    margin-bottom: 0;
    font-size: 14px;
    line-height: 20px;
    color: #333333;
    text-align: center;
    text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
    vertical-align: middle;
    background-color: #f5f5f5;
    background: linear-gradient(to bottom, #fff 0%, #fff 66%, #f5f5f5 66%, #f5f5f5 100%);
    border: 1px solid #cccccc;
    border-radius: 3px;
}
.menu > button::after{
    display: inline-block;
    width: 0;
    height: 0;
    vertical-align: top;
    border: solid 4px transparent;
    border-top: solid 4px #000;
    margin-left: 5px;
    margin-top: 8px;
    content: '';
}

.menu ul{
    position: absolute;
    z-index: 3;
    min-width: 160px;
    margin: 0;
    padding: 5px 0;
    list-style: none;
    background-color: #fff;
    border: 1px solid #999;
    border-radius: 3px;
    box-shadow: 2px 2px 1px rgba(50, 50, 50, 0.1);
    display: none;
}
.menu > ul{
    left: auto;
    right: 0;
}
.menu li{
    font-family: 'MS PGothic',sans-serif;
    font-size: 16px;
}
.menu li:empty{
    height: 1px;
    margin: 9px 1px;
    background-color: #e5e5e5;
}

.menu a{
    display: block;
    padding: 3px 20px;
    line-height: 20px;
    color: #333;
    white-space: nowrap;
    text-align: left;
    text-decoration: none;
}
.menu a:hover,
.menu-sub:hover > a{
    color: #fff;
    background-color: #0081c2;
    background-image: linear-gradient(to bottom, #0088cc, #0077b3);
}

.menu-sub{
    position: relative;
}
.menu-sub > a::after{
    position: absolute;
    right: 5px;
    width: 0;
    height: 0;
    margin-top: 5px;
    border: solid 5px transparent;
    border-right: solid 5px #333;
    content: '';
}
.menu-sub > ul{
    top: 0;
    right: 100%;
    margin-top: -6px;
    margin-left: -1px;
    border-radius: 3px;
}
.menu-sub:hover > ul{
    display: block;
}
</style>
END;



//メニューを開閉する
$body = <<<'END'
<script type="module">
const menu = document.querySelector('.menu > ul');
document.addEventListener('click', function(event){
    if(event.target === menu.previousElementSibling){
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    }
    else if(!menu.contains(event.target)){
        menu.style.display = 'none';
    }
    else if(event.target.hasAttribute('href')){
        menu.style.display = 'none';
    }
});
</script>
END;



//最近見た記事を記録する
$body .= ($blog->action === 'entry') ? <<<'END'
<script type="module">
const url    = document.querySelector('[rel="canonical"]').getAttribute('href');
const title  = document.title;
const recent = [{url, title}];

for(const v of JSON.parse(window.localStorage.blog_recent || '[]')){
    if(v.url !== url){
        recent.push(v);
    }
}

recent.splice(10);
window.localStorage.blog_recent = JSON.stringify(recent);
</script>
END : '';



//最近見た記事のタグを作る
$body .= <<<'END'
<script type="module">
const menu = document.querySelector('.menu-recent');

if(window.localStorage.blog_recent){
    menu.textContent = '';
}

for(const v of JSON.parse(window.localStorage.blog_recent || '[]')){
    v.title = v.title.replace(/</g, '&lt;').replace(/>/g, '&gt;');
    menu.insertAdjacentHTML('beforeend', `<li><a href="${v.url}">${v.title}</a></li>`);
}
</script>
END;
