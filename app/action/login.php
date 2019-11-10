<?php

print <<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="robots" content="noindex,nofollow">
  <title>ログイン</title>
  <link href="$blog->asset/css/login.css" rel="stylesheet">
  <script src="$blog->asset/js/login.js" type="module"></script>
</head>
<body>

<form action="$blog->home?action=login_post" method="POST">
<input type="password" name="password"><input type="submit" value="ログイン">
</form>


</body>
</html>
END;
