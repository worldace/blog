<?php

print new template(<<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <meta name="robots" content="noindex,nofollow">
  <title>ログイン</title>
  <link rel="stylesheet" href="$blog->asset/css/base-blog.css">
  <link rel="stylesheet" href="$blog->asset/css/login_form.css">
  <link rel="icon" href="$blog->asset/img/favicon.png" type="image/png">
</head>
<body>

{{header.php}}

{{menu.php}}

<form action="?action=login" method="POST">
  <input type="password" name="password" required autofocus>
  <input type="submit" value="ログイン">
</form>


</body>
</html>
END);
