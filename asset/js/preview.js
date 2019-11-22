const iframe   = document.querySelector('iframe').contentWindow.document;
const textarea = document.querySelector('textarea');

document.querySelector(".tab > ul > li:nth-of-type(2)").addEventListener('click', function (event){
    iframe.body.innerHTML = textarea.value;
});
