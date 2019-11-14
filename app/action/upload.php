<?php

$uplod = request::upload('file', './');

response::text("<img src=$blog->home>");
