
document.querySelector(".tab > ul > li:nth-of-type(2)").onclick = function (event){
    const preview  = document.querySelector('iframe').contentDocument.body;
    preview.innerHTML = document.querySelector('textarea').value;
};
