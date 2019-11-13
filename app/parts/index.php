<?php

global $blog;

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


foreach($blog->this_data as $v){
    $title        = html::e($v->title);
    $category     = html::e($v->category);
    $category     = str::shift($category, "\n");
    $create_time  = date('Y/m/d', $v->create_time);
    $comment_time = $v->comment_time ? date('Y/m/d H:i', $v->comment_time) : '-';

    print <<<END
    <tr>
      <td><a href="$blog->home?action=entry&id=$v->id">$title</a></td>
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
.index tr th:nth-child(1){
    width: 50%;
}
.index tr th:nth-child(2){
    width: 15%;
}
.index tr th:nth-child(3){
    width: 11%;
}
.index tr th:nth-child(4){
    width: 7%;
}
.index tr th:nth-child(5){
    width: 5%;
}
.index tr th:nth-child(6){
    width: 11%;
}
.index tr th:nth-child(6){
    width: 11%;
}
.index tr td:first-child{
    text-align: left;
}
.index tr td:first-child a{
    display: block;
}
.index tr td:nth-child(2):empty::after{
    content: '-';
}
</style>
END;
