
document.querySelector("#entry_delete_form").onsubmit = function(event){
    if(confirm('この記事を削除しますか？') === false){
        event.preventDefault();
    }
};
