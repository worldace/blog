const trAll   = document.querySelectorAll('#history tr');
const preview = document.querySelector('#history_preview').contentWindow.document;


document.querySelector('#history').addEventListener('click', async function(event){
    for(const tr of trAll){
        if(tr.contains(event.target)){
            tr.id = 'history-selected';
            const response = await fetch(`?action=entry_history&history_id=${tr.dataset.id}`);
            const text     = await response.text();
            preview.body.innerHTML = text;
        }
        else{
            tr.id = '';
        }
    }
});


document.querySelector('#history-restore').addEventListener('click', function(event){
    event.preventDefault();

    if(!document.querySelector('#history-selected')){
        return;
    }
    if(confirm('この内容を復元しますか？') === false){
        return;
    }
    document.querySelector('textarea').value = preview.body.innerHTML;
    document.querySelector('.tab > ul > li').click();
});
