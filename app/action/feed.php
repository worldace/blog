<?php

header('Content-Type: application/atom+xml; charset=UTF-8');

$data = $db->select(0, 30);

$title   = html::e($blog->title);
$author  = html::e($blog->admin);
$updated = date('c', $data[0]->create_time);


print '<?xml version="1.0" ?>';
print <<<END
<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="ja">
<title>$title</title>
<author>
  <name>$author</name>
</author>
<link href="$blog->home" />
<id>action=feed</id>
<updated>$updated</updated>
END;


foreach($data as $v){
    if($v->status !== 'open'){
        continue;
    }

    $title   = html::e($v->title);
    $updated = date('c', $v->create_time);

    print <<<END
    <entry>
      <title>$title</title>
      <link href="$blog->home?action=entry&amp;id=$v->id" />
      <id>$v->id</id>
      <updated>$updated</updated>
      <content><![CDATA[$v->body]]></content>
    </entry>
    END;
}

print '</feed>';