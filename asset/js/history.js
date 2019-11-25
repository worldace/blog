
const preview = document.querySelector('#tab-content-history > iframe').contentDocument;


document.querySelector('#history-select').onchange = function(event){
    event.stopPropagation();

    fetch(`?action=entry_history&history_id=${event.target.dataset.id}`)
    .then(response => response.text())
    .then(text => preview.body.innerHTML = text);
};


document.querySelector('#history-select > button').onclick = function(event){
    if(!document.querySelector('#history-select :checked')){
        return;
    }
    document.querySelector('textarea').value = preview.body.innerHTML;
    document.querySelector('.tab > ul > li').click();
};
