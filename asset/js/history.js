
const iframe = document.querySelector('#history > iframe');


document.querySelector('#history-select').onchange = function(event){
    event.stopPropagation();

    fetch(`?action=entry_history&history_id=${event.target.dataset.id}`)
    .then(response => response.text())
    .then(text => iframe.contentDocument.body.innerHTML = text);
};


document.querySelector('#history-select > button').onclick = function(event){
    if(!document.querySelector('#history-select :checked')){
        return;
    }

    document.querySelector('textarea').value = iframe.contentDocument.body.innerHTML;
    document.querySelector('.tab-bar > li').click();
};
