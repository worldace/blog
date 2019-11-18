<?php

global $blog, $db;

print '<aside class="comment" id="comment">';


foreach($db('comment')->query("select * from comment where entry_id = $blog->id") as $i => $v){
    $i++;
    $v->name = html::e($v->name);
    $v->body = html::e($v->body);
    $v->body = nl2br($v->body, false);
    $v->time = date('Y/m/d H:i', $v->time);

    print <<<END
      <article id="comment-$v->id" data-id="$v->id">
        <header>
          <a class="comment-no" href="$blog->home?action=entry&id=$blog->id#comment-$v->id">$i</a>
          <span class="comment-name">$v->name</span>
          <time class="comment-time">$v->time</time>
          <span class="comment-delete"></span>
        </header>
        <p>$v->body</p>
      </article>
    END;
}


print <<<END
  <form action="?action=comment_create" method="POST">
    <div><label>名前</label><input type="text" name="name" value=""></div>
    <textarea name="body"></textarea>
    <input type="submit" value="コメントする">
    <input type="hidden" name="id" value="$blog->id">
  </form>
</aside>
END;




$head = <<<'END'
<style>
.comment > article {
    width: 40rem;
    margin-bottom: 20px;
}
.comment > article > header{
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
.comment > article:target > header{
    background-color: #eeffee;
}
.comment > article > p {
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
.comment-no:link,
.comment-no:visited,
.comment-no:hover{
    font-size: 16px;
    color: #777;
    font-family: Arial, Meiryo, sans-serif;
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



/* フォーム */
.comment > form{
    display: flex;
    flex-direction: column;
}
.comment > form > div{
    display: flex;
    margin: 0 0 5px 0;
    padding: 0;
    height: 36px;
}
.comment > form label{
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
.comment > form input[type="text"]{
    border-radius: 5px;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    box-shadow: 5px 5px 5px rgba(200,200,200,0.2)inset;
    border: 1px solid #888888;
    padding: 6px 6px 3px 12px;
    font-size: 0.9rem;
    width: 14rem;
}
.comment > form input[type="submit"]{
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

.comment > form textarea{
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
</style>
END;