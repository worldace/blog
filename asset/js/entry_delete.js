
document.querySelector("#delete_form").onsubmit = function(event){
    if(confirm('この記事を削除しますか？') === false){
        event.preventDefault();
    }
};
