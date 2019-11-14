
// キューはPromiseにしたい

const textarea = document.querySelector('textarea');


textarea.addEventListener('drop', function(event){
    const files = Array.from(event.dataTransfer.files);

    if(!files.length){
        return;
    }

    event.preventDefault();
    if(upload.queue.length){
        upload.queue = upload.queue.concat(files);
    }
    else{
        upload.queue = upload.queue.concat(files);
        upload();
    }
});


textarea.addEventListener('dragover', function(event){
    event.preventDefault();
});


function upload(){
    if(!upload.queue.length){
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', './?action=upload');
    xhr.timeout = 120 * 1000;

    xhr.onloadend = function(event){
        if(xhr.status === 200){
            insertText(textarea, xhr.responseText);
        }
        upload.progress.remove();
        upload.queue.shift();
        upload();
    };

    xhr.upload.onprogress = function(event){
        upload.progress(event.loaded/event.total*100);
    };

    const formData = new FormData();
    formData.append('file', upload.queue[0]);
    xhr.send(formData);
}


upload.queue = [];


upload.progress = function(percent){
    upload.progress.create();
    if(percent >= 100){
        percent = 100;
    }
    upload.progress.el.style.width = percent + '%';
};


upload.progress.create = function(){
    if(upload.progress.el){
        return;
    }
    const el = document.createElement('div');
    el.style.position = 'absolute';
    el.style.top = 0;
    el.style.left = 0;
    el.style.width = 0;
    el.style.height = '2px';
    el.style.zIndex = 1031;
    el.style.backgroundColor = '#db0000';
    el.style.boxShadow = '0 0 2px #db0000';
    upload.progress.el = document.body.appendChild(el);
};


upload.progress.remove = function(){
    if(!upload.progress.el){
        return;
    }
    upload.progress.el.remove();
};


function insertText(textarea, text){
    const pos    = textarea.selectionStart;
    const before = textarea.value.substr(0, pos);
    const after  = textarea.value.substr(pos, textarea.value.length);

    textarea.value = before + text + after;
}


