
document.querySelector('form').addEventListener('submit', function(event){
    const body = document.querySelector('textarea').value;
    const img  = (new DOMParser).parseFromString(body, 'text/html').querySelector('img');

    document.querySelector('[name="eyecatch"]').value = img ? img.src : '';
});
