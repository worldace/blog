<?php

$contents = $db->query("select * from 'blog' where status = '公開' order by 'id' desc limit 30")->fetchAll();

$entry = '';
foreach($contents as $v){
    $updated = date('c', $v->create_time);
    $title   = html::e($v->title);
    $url     = "$blog->home?action=entry&amp;id=$v->id";

    $entry .= <<<END
    <entry>
      <title>$title</title>
      <link href="$url" />
      <id>$url</id>
      <updated>$updated</updated>
      <content><![CDATA[$v->body]]></content>
    </entry>
    END;
}


$title   = html::e($blog->title);
$author  = html::e($blog->admin);
$updated = date('c', $contents[0]->create_time);

header('Content-Type: application/atom+xml; charset=UTF-8');

print <<<END
<?xml version="1.0"?>
<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="ja">
<title>$title</title>
<author><name>$author</name></author>
<link href="$blog->home" />
<id>$blog->home?action=feed</id>
<updated>$updated</updated>
$entry
</feed>
END;
