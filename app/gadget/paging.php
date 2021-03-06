<?php

global $blog;

print '<nav class="paging">';

if($self->page > 1){
    printf('<a href="%s%s" class="paging-prev">前のページへ</a>', $self->href, $self->page - 1);
}
if($self->next){
    printf('<a href="%s%s" class="paging-next">次のページへ</a>', $self->href, $self->page + 1);
}

print '</nav>';


$head = <<<END
<style>
.paging{
    text-align: center;
    font-size: 14px;
    letter-spacing: -1px;
    color: #333;
    vertical-align: middle;
    margin-top: 50px;
}
.paging-prev{
    padding-left: 18px;
    margin-right: 10px;
    background: no-repeat left url('$blog->asset/img/left.png');
}
.paging-next{
    padding-right: 18px;
    margin-left: 10px;
    background: no-repeat right url('$blog->asset/img/right.png');
}
</style>
END;
