<?php
/*
<nav class="menu">
<button class="menu-button">メニュー</button>
<ul>
  <li><a href="a.html">コンテンツ</a></li>
  <li class="menu-separate"></li>
  <li><a href="b.html">コンテンツ</a></li>
  <li class="menu-sub"><a>サブメニュー</a>
    <ul>
      <li><a>(なし)</a></li>
    </ul>
  </li>
</ul>
</nav>
*/

$head = <<<'END'
<style>
.menu{
    text-align: right;
    position: relative;
    user-select: none;
}
.menu-button{
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
.menu-button::after{
    display: inline-block;
    width: 0;
    height: 0;
    vertical-align: top;
    border-top: 4px solid #000000;
    border-right: 4px solid transparent;
    border-left: 4px solid transparent;
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
.menu > ul.menu-show{
    display: block;
}
.menu li{
    font-family: 'MS PGothic',sans-serif;
    font-size: 16px;
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
    text-decoration: none;
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
    content: "";
}
.menu-sub > ul{
    top: 0;
    left: -100%;
    margin-top: -6px;
    margin-left: -1px;
    border-radius: 6px;
}
.menu-sub:hover > ul{
    display: block;
}

.menu-separate{
    height: 1px;
    margin: 9px 1px;
    background-color: #e5e5e5;
}
</style>
END;


$body = <<<'END'
<script>
const menu = document.querySelector('.menu > ul');
document.addEventListener('click', function(event){
    if(event.target.className === 'menu-button'){
        menu.classList.toggle('menu-show');
    }
    else if(!menu.contains(event.target)){
        menu.classList.remove('menu-show');
    }
});
</script>
END;