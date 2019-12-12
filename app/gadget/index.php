<?php

global $blog;


if(!$self->data){
    return;
}


print <<<'END'
<table class="index">
<tr>
  <th>タイトル</th>
  <th>カテゴリ</th>
  <th>投稿日</th>
  <th>PV</th>
  <th>レス</th>
  <th>最終レス</th>
</tr>
END;


foreach($self->data as $v){
    if($v->status !== 'open' and !$blog->is_admin){
        continue;
    }

    $title        = html::e($v->title);
    $category     = json_decode($v->category, true)[0];
    $category     = $category ? str::f('<a href="?action=category&category=%u">%h</a>', $category, $category) : '';
    $create_time  = date('Y/m/d', $v->create_time);
    $comment_time = $v->comment_time ? date('Y/m/d H:i', $v->comment_time) : '';

    print <<<END
    <tr>
      <td><a href="?action=entry&id=$v->id" data-status="$v->status">$title</a></td>
      <td>$category</td>
      <td>$create_time</td>
      <td>$v->pageview</td>
      <td>$v->comment_count</td>
      <td>$comment_time</td>
    </tr>
    END;
}

print '</table>';


$head = <<<'END'
<style>
.index{
    width: 100%;
    table-layout: fixed;
    margin: 50px auto;
    border-collapse: collapse
}
.index th{
    font-size: 16px;
    padding-bottom: 10px;
}
.index td{
    border-bottom: solid 1px #eee;
    font-size: 14px;
    padding: 3px 5px;
    text-align: center;
    overflow: hidden;
    text-overflow: '';
    white-space: nowrap;
}
.index th:nth-of-type(1){
    width: 50%;
}
.index th:nth-of-type(2){
    width: 15%;
}
.index th:nth-of-type(3){
    width: 11%;
}
.index th:nth-of-type(4){
    width: 7%;
}
.index th:nth-of-type(5){
    width: 5%;
}
.index th:nth-of-type(6){
    width: 11%;
}
.index th:nth-of-type(6){
    width: 11%;
}
.index td:first-of-type{
    text-align: left;
}
.index a{
    display: block;
}
.index td:nth-of-type(2):empty::after{
    content: '-';
}
.index td:nth-of-type(6):empty::after{
    content: '-';
}
.index [data-status="close"]::before{
    content: '[非公開]';
    margin-right: 0.5rem;
}
</style>
END;
