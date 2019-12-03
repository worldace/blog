<?php

global $blog;

$url   = rawurlencode("$blog->home?action=entry&id=$blog->this_id");
$title = rawurlencode($blog->this_title);

print <<<END
<aside class="socialbutton">
  <a href="https://www.facebook.com/sharer.php?u=$url" target="_blank"><img src="$blog->asset/img/facebook-like.png" width="69" height="20"></a>
  <a href="https://b.hatena.ne.jp/add?mode=confirm&url=$url&title=$title" target="_blank"><img src="$blog->asset/img/hatena-bookmark.png" width="80" height="20"></a>
  <a href="https://twitter.com/share?url=$url&text=$title" target="_blank"><img src="$blog->asset/img/twitter-tweet.png" width="61" height="20"></a>
</aside>
END;

$head = <<<'END'
<style>
.socialbutton{
    display: flex;
    margin: 2rem 0;
}
.socialbutton a{
    margin-right: 6px;
}
</style>
END;
