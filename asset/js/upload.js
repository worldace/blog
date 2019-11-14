import progress from './progress.js';
import insertText from './insertText.js';

// キューはPromiseにしたい

const textarea = document.querySelector('textarea');



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
        progress.hide();
        upload.queue.shift();
        if(upload.queue.length){
            upload();
        }
    };

    xhr.upload.onprogress = function(event){
        progress(event.loaded/event.total*100);
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
