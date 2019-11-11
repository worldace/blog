<?php

global $blog;


$table = <<<END
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
    $table .= <<<END
    <tr>
      <td><a href="$blog->home?action=entry&id=$v->id">$v->title</a></td>
      <td>$v->category</td>
      <td>$v->create_time</td>
      <td>$v->pageview</td>
      <td>$v->comment_count</td>
      <td>$v->comment_time</td>
    </tr>
    END;
}


$DOC->head->appendChild($DOC('<style>', <<<END
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
.index tr td:nth-child(6):empty::after{
    content: '-';
}
END));



return new doc($table.'</table>');
