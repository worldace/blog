<?php

$table = '';
foreach($DOC->index_data as $v){
    $table .= "<tr><td><a href=\"{$entry['記事URL']}\">{$entry['記事タイトル']}</a></td><td>{$entry['記事カテゴリリンク']}</td><td><time>{$entry['記事投稿時間']}</time></td><td>{$entry['記事ページビュー数']}</td><td>{$entry['記事コメント数']}</td><td><time>{$entry['記事コメント最終時間']}</time></td></tr>\n";

}


return new doc($html);