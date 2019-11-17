<?php

global $blog;

print <<<END
<header id="header">
  <h1><a href="$blog->home">$blog->title</a></h1>
</header>
END;


$head = <<<'END'
<style>
#header > h1{
    color: #e87830;
    font-size: 2.3rem;
    font-family: Georgia, 'Times New Roman', Times, sans-serif;
    font-weight: normal;
    letter-spacing: -1px;
    margin: 0;
}
#header a{
    text-decoration: none;
}
#header a:link{
    color: #e87830;
}
#header a:visited{
    color: #e87830;
}
#header a:hover{
    color: #cc0000;
}

</style>
END;