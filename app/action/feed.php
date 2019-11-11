<?php

$data  = $db->query("select * from 'blog' where status = '公開' order by 'id' desc limit 30")->fetchAll();
$entry = '';


foreach($data as $v){
    $title   = html::e($v->title);
    $updated = date('c', $v->create_time);

    $entry .= <<<END
    <entry>
      <title>$title</title>
      <link href="$blog->home?action=entry&amp;id=$v->id" />
      <id>$v->id</id>
      <updated>$updated</updated>
      <content><![CDATA[$v->body]]></content>
    </entry>
    END;
}


$title   = html::e($blog->title);
$author  = html::e($blog->admin);
$updated = date('c', $data[0]->create_time);


header('Content-Type: application/atom+xml; charset=UTF-8');
print <<<END
<?xml version="1.0"?>
<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="ja">
<title>$title</title>
<author>
  <name>$author</name>
</author>
<link href="$blog->home" />
<id>action=feed</id>
<updated>$updated</updated>
$entry
</feed>
END;