
document.querySelector('#history-select').onchange = function(event){
    event.stopPropagation();

    const preview = document.querySelector('#tab-content-history > iframe').contentDocument.body;

    fetch(`?action=entry_history&history_id=${event.target.dataset.id}`)
    .then(response => response.text())
    .then(text => preview.innerHTML = text);
};


document.querySelector('#history-select > button').onclick = function(event){
    if(!document.querySelector('#history-select :checked')){
        return;
    }
    const preview = document.querySelector('#tab-content-history > iframe').contentDocument.body;

    document.querySelector('textarea').value = preview.innerHTML;
    document.querySelector('.tab > ul > li').click();
};
