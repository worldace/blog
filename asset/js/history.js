const table   = document.querySelector('#history-table');
const preview = document.querySelector('#history-preview').contentDocument;


table.onclick = async function(event){
    if(event.target.tagName !== 'TD'){
        return;
    }

    for(const tr of table.rows){
        tr.className = '';
    }
    const tr = event.target.closest('tr');
    tr.className = 'history-selected';

    const response = await fetch(`?action=entry_history&history_id=${tr.dataset.id}`);
    const text     = await response.text();
    preview.body.innerHTML = text;
    /*
    fetch(`?action=entry_history&history_id=${tr.dataset.id}`)
    .then(response => response.text())
    .then(text => preview.body.innerHTML = text);
    */
};


document.querySelector('#history-restore').onclick = function(event){
    if(!document.querySelector('.history-selected')){
        return;
    }
    document.querySelector('textarea').value = preview.body.innerHTML;
    document.querySelector('.tab > ul > li').click();
};
