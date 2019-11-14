
// キューはPromiseにしたい

const textarea = document.querySelector('textarea');

const progress = document.createElement('div');
progress.style.position = 'absolute';
progress.style.top = 0;
progress.style.left = 0;
progress.style.width = 0;
progress.style.height = '2px';
progress.style.zIndex = 1031;
progress.style.backgroundColor = '#db0000';
progress.style.boxShadow = '0 0 2px #db0000';
progress.style.opacity = 0;
document.body.appendChild(progress);


textarea.addEventListener('drop', function(event){
    event.preventDefault();

    if(!event.dataTransfer.files.length){
        return;
    }
    if(upload.addQueue(event.dataTransfer.files) === 0){
        upload();
    }
});


textarea.addEventListener('dragover', function(event){
    event.preventDefault();
});


function upload(){
    const xhr = new XMLHttpRequest();
    xhr.open('POST', './?action=upload');
    xhr.timeout = 120 * 1000;

    xhr.onloadend = function(event){
        if(xhr.status === 200){
            insertText(textarea, xhr.responseText);
        }
        upload.progress.hide();
        upload.queue.shift();
        if(upload.queue.length){
            upload();
        }
    };

    xhr.upload.onprogress = function(event){
        upload.progress(event.loaded/event.total*100);
    };

    const formData = new FormData();
    formData.append('file', upload.queue[0]);
    xhr.send(formData);
}


upload.queue = [];


upload.addQueue = function(files){
    const length = upload.queue.length;
    upload.queue = upload.queue.concat(Array.from(files));
    return length;
};


upload.progress = function(percent){
    if(percent >= 100){
        percent = 100;
    }
    progress.style.opacity = 1;
    progress.style.width = percent + '%';
};


upload.progress.hide = function(){
    progress.style.opacity = 0;
};


function insertText(textarea, text){
    const pos    = textarea.selectionStart;
    const before = textarea.value.substr(0, pos);
    const after  = textarea.value.substr(pos, textarea.value.length);

    textarea.value = before + text + after;
}


