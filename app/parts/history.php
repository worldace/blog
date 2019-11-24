<?php

global $blog;


print "<table id='history'>\n";

$i = count($blog->this_history);

foreach($blog->this_history as $v){
    $v->time = date('Y/m/d H:i', $v->time);
    print "<tr data-id='$v->id'><td>$v->time</td><td>第{$i}版</td></tr>\n";
    $i--;
}

print "</table>\n";


$head = <<<'END'
<style>
#history {
    border-collapse: collapse;
    font-size: 14px;
    cursor: pointer;
}
#history td {
    padding: 6px 10px;
    border: 1px solid #111;
    text-align: center;
    font-family: Meiryo, sans-serif;
    letter-spacing: 0;
    vertical-align: middle;
}
#history .history-selected{
    background-color: #eeffee;
}
</style>
END;


$body = <<<'END'
<script type="module">
const trAll   = document.querySelectorAll('#history tr');
const preview = document.querySelector('#history_preview').contentWindow.document;

document.querySelector('#history').addEventListener('click', async function(event){
    for(const tr of trAll){
        if(tr.contains(event.target)){
            tr.className = 'history-selected';
            const response = await fetch(`?action=entry_history&history_id=${tr.dataset.id}`);
            const text     = await response.text();
            preview.body.innerHTML = text;
        }
        else{
            tr.className = '';
        }
    }
});

document.querySelector('#history-restore').addEventListener('click', function(event){
    event.preventDefault();

    if(!document.querySelector('.history-selected')){
        return;
    }
    if(window.confirm('この内容を復元しますか？') === false){
        return;
    }
    document.querySelector('textarea').value = preview.body.innerHTML;
    document.querySelector('.tab > ul > li').click();
});
</script>
END;
