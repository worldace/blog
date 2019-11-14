function progress(percent){
    progress.create();
    if(percent >= 100){
        percent = 100;
    }
    progress.el.style.width = percent + '%';
}

progress.create = function (){
    if(progress.el){
        return;
    }
    progress.el = document.createElement('div');
    progress.el.style.position = 'absolute';
    progress.el.style.top = 0;
    progress.el.style.left = 0;
    progress.el.style.width = 0;
    progress.el.style.height = '2px';
    progress.el.style.zIndex = 1031;
    progress.el.style.backgroundColor = '#db0000';
    progress.el.style.boxShadow = '0 0 2px #db0000';
    document.body.appendChild(progress.el);
};

progress.remove = function (){
    if(!progress.el){
        return;
    }
    progress.el.parentNode.removeChild(progress.el);
};
