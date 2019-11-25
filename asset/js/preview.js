const preview  = document.querySelector('iframe').contentDocument;

document.querySelector(".tab > ul > li:nth-of-type(2)").onclick = function (event){
    preview.body.innerHTML = document.querySelector('textarea').value;
};
