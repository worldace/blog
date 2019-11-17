<?php

print new template(<<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <meta name="robots" content="noindex,nofollow">
  <title>ログイン</title>
  <link href="$blog->asset/css/login_form.css" rel="stylesheet">
  <script src="$blog->asset/js/login_form.js" type="module"></script>
</head>
<body>

{{header.php}}

<form action="action=login" method="POST">
<input type="password" name="password"><input type="submit" value="ログイン">
</form>


</body>
</html>
END);
