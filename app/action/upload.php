<?php

$uplod = request::upload('file', './');

//@getimagesize();
response::text("<img src=$blog->home>");
