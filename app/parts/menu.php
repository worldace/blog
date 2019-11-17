<?php

global $blog;


$user = <<<'END'
<nav class="menu">
<button>メニュー</button>
<ul>
  <li><a href="./">ホーム</a></li>
  <li><a href="?action=category_list">カテゴリ一覧</a></li>
  <li><a href="?action=search_form">記事検索</a></li>
  <li class="menu-sub"><a>最近見た記事</a>
    <ul>
      <li><a>(なし)</a></li>
    </ul>
  </li>
  <li></li>
  <li><a href="?action=login_form">ログイン</a></li>
</ul>
</nav>
END;


$admin = <<<'END'
<nav class="menu">
<button>メニュー</button>
<ul>
  <li><a href="./">ホーム</a></li>
  <li><a href="?action=category_list">カテゴリ一覧</a></li>
  <li><a href="?action=search_form">記事検索</a></li>
  <li class="menu-sub"><a>最近見た記事</a>
    <ul>
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
END;


print $blog->is_admin() ? $admin : $user;


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


$head = "<link rel='stylesheet' href='$blog->asset/css/menu.css'>";
