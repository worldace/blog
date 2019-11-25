const table   = document.querySelector('#history-table');
const preview = document.querySelector('#history-preview').contentDocument;


table.onclick = function(event){
    for(const tr of table.rows){
        tr.className = '';
        if(tr.contains(event.target)){
            tr.className = 'history-selected';

            fetch(`?action=entry_history&history_id=${tr.dataset.id}`)
            .then(response => response.text())
            .then(text => preview.body.innerHTML = text);
        }
    }
};


document.querySelector('#history-restore').onclick = function(event){
    event.preventDefault();

    if(!document.querySelector('.history-selected')){
        return;
    }
    document.querySelector('textarea').value = preview.body.innerHTML;
    document.querySelector('.tab > ul > li').click();
};
