<?php

global $blog;


print '<article class="comment" id="comment">';

foreach($self->comment as $i => $comment){
    $i++;
    if($comment->status === 'delete'){
        continue;
    }

    $comment->name = is::empty($comment->name) ? $blog->comment_name : $comment->name;
    $comment->name = html::e($comment->name);
    $comment->body = html::e($comment->body);
    $comment->body = preg_replace('/&gt;&gt;(\d+)/', '<span class="comment-anker" onmouseenter="comment_anker_onmouseenter()" onmouseleave="comment_anker_onmouseleave()">&gt;&gt;$1</span>', $comment->body);
    $comment->body = nl2br($comment->body, false);
    $comment->time = date('Y/m/d H:i', $comment->time);

    print <<<END
      <section id="comment_$comment->id" class="comment-section">
        <header class="comment-header">
          <a class="comment-no" href="?action=entry&id=$self->id#comment_$comment->id">$i</a>
          <span class="comment-name">$comment->name</span>
          <time class="comment-time">$comment->time</time>
        </header>
        <p id="comment_no_$i" class="comment-body">$comment->body</p>
      </section>

    END;
}

$cookie_name = request::cookie('name');
$cookie_name = html::e($cookie_name);

print <<<END
  <form class="comment-form" action="?action=comment_create" method="POST">
    <div><label>名前</label><input type="text" name="name" value="$cookie_name"></div>
    <textarea name="body" required></textarea>
    <input type="submit" value="コメントする">
    <input type="hidden" name="id" data-id="$self->id">
  </form>
</article>

END;



$head = <<<'END'
<style>
.comment-section{
    width: 40rem;
    margin-bottom: 20px;
}
.comment-header{
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    background-color: #f7f7f7;
    border: solid 1px #d0d0d0;
    border-bottom: #e5e5e5 1px solid;
    width: 100%;
    margin-bottom: 0;
    padding: 5px 18px;
    font-size: 16px;
}
.comment-no:link,
.comment-no:visited,
.comment-no:hover{
    font-size: 16px;
    color: #777;
    font-family: Arial, Meiryo, sans-serif;
}
.comment-no:hover{
    font-weight: bold;
}
.comment-name{
    margin-left: 8px;
    margin-right: 8px;
}
.comment-time{
    font-size: 14px;
    color: #777;
    font-family: Arial, Meiryo, sans-serif;
}
.comment-body{
    width: 100%;
    margin-top: 0;
    padding: 18px;
    font-size: 16px;
    border-left: solid 1px #d0d0d0;
    border-right: solid 1px #d0d0d0;
    border-bottom: solid 1px #d0d0d0;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
}



/* フォーム */
.comment-form{
    display: flex;
    flex-direction: column;
}
.comment-form > div{
    display: flex;
    margin: 0 0 5px 0;
    padding: 0;
    height: 36px;
}
.comment-form label{
    width: 100px;
    text-decoration: none;
    text-align: center;
    font-size: 14px;
    color: #fff;
    border: 1px solid #0077b3;
    background-color: #0081c2;
    background-image: linear-gradient(to bottom, #0088cc, #0077b3);
    font-family: Meiryo, sans-serif;
    border-radius: 5px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    user-select: none;
    display: flex;
    align-items: center;
    justify-content: center;
}
.comment-form input[type="text"]{
    border-radius: 5px;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    box-shadow: 5px 5px 5px rgba(200,200,200,0.2)inset;
    border: 1px solid #888888;
    padding: 6px 6px 3px 12px;
    font-size: 0.9rem;
    width: 14rem;
}
.comment-form input[type="submit"]{
    text-decoration: none;
    text-align: center;
    padding: 9px 15px 8px 15px;
    font-size: 0.9rem;
    color: #fff;
    background-color: #5ba825;
    background: linear-gradient(to bottom, #84be5c 0%, #84be5c 66%, #5ba825 66%, #5ba825 100%);
    border: 1px solid #377d00;
    border-radius: 5px;
    line-height: 1;
    vertical-align: middle;
    font-family: Meiryo, sans-serif;
    cursor: pointer;
    width: 9rem;
}
.comment-form textarea{
    border-radius: 5px;
    box-shadow: 5px 5px 5px rgba(200,200,200,0.2) inset;
    border: 1px solid #888888;
    padding: 14px 10px 5px 14px;
    font-size: 15px;
    font-family: 'MS Gothic', Meiryo, sans-serif;
    width: 40rem;
    height: 10rem;
    margin: 0 0 3px 0;
}



/* ポップアップ */
.comment-anker{
    position: relative;
    cursor: default;
    color: red;
}
.comment-popup{
    color: #fff;
    background-color: #000;
    position: absolute;
    bottom: 2rem;
    left: 0.5rem;
    z-index: 10;
    padding: 0.4rem 0.7rem;
    border-radius: 0.5rem;
    white-space: nowrap;
    cursor: default;
}
.comment-popup::after{
    width: 100%;
    content: "";
    display: block;
    position: absolute;
    left: 0.5rem;
    bottom: -8px;
    border-bottom: 8px solid transparent;
    border-left: 8px solid #000;
}
</style>

END;


// コメントポップアップ
// 使い方： <span class="comment-anker" onmouseenter="comment_anker_onmouseenter()" onmouseleave="comment_anker_onmouseleave()">&gt;&gt;45</span>
$body = <<<'END'
<script>
function comment_anker_onmouseenter(){
    const num = event.target.textContent.replace(/>/g, '');
    const res = document.querySelector(`#comment_no_${num}`);

    if(res){
        event.target.insertAdjacentHTML('beforeend', `<div class="comment-popup">${res.innerHTML}</div>`);
    }
}

function comment_anker_onmouseleave(){
    for(const el of event.target.children){
        el.remove();
    }
}
</script>

END;



// スパム対策
$body .= <<<'END'
<script type="module">
document.querySelector('.comment-form').addEventListener('submit', function(event){
    const el = event.target.querySelector('[name="id"]');
    el.value = el.dataset.id;
});
</script>

END;



// コメント削除 (管理用)
$body .= $blog->is_admin ? <<<'END'
<script type="module">
document.querySelector('.comment').addEventListener('click', function (event){
    if(event.target.className !== 'comment-no'){
        return;
    }
    if(confirm('このコメントを削除しますか？') === false){
        return;
    }
    event.preventDefault();

    const comment_id = event.target.href.match(/\d+$/)[0];
    fetch('?action=comment_delete', {method:'POST', body:new URLSearchParams({comment_id})});
    event.target.closest('.comment-section').remove();
});
</script>

END : '';
