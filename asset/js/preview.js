
const iframe = document.querySelector('iframe');

document.querySelector(".tab > ul > li:nth-of-type(2)").onclick = function (event){
    iframe.contentDocument.body.innerHTML = document.querySelector('textarea').value;
};
