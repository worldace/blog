export default progress;


function progress(percent){
    el.style.opacity = 1;
    el.style.width = Math.min(percent, 100) + '%';
}


progress.hide = function(){
    el.style.opacity = 0;
};


const el = document.createElement('div');
el.style.position = 'absolute';
el.style.top = 0;
el.style.left = 0;
el.style.width = 0;
el.style.height = '2px';
el.style.zIndex = 1031;
el.style.backgroundColor = '#db0000';
el.style.boxShadow = '0 0 2px #db0000';
el.style.opacity = 0;
document.body.appendChild(el);
