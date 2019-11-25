<?php


print new template(<<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>検索</title>
  <link rel="stylesheet" href="$blog->asset/css/base-blog.css">
  <link rel="stylesheet" href="$blog->asset/css/search_form.css">
  <link rel="icon" href="$blog->asset/img/favicon.png" type="image/png">
</head>
<body>

{{header.php}}

{{menu.php}}

<form action="./" method="GET">
  <input type="hidden" name="action" value="search">
  <input type="input" name="word" required autofocus>
  <input type="submit" value="検索する">
</form>


</body>
</html>
END);
