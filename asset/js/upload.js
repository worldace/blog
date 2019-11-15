import progress from './progress.js';
import insertText from './insertText.js';


// 使い方：<textarea data-upload="送信先URL">を用意しておく
// 課題：キューはPromiseにしたい。ファイルサイズ制限


const textarea = document.querySelector('textarea[data-upload]');

textarea.ondrop = function(event){
    event.preventDefault();

    if(!event.dataTransfer.files.length){
        return;
    }
    if(queue.add(event.dataTransfer.files) === 0){
        upload();
    }
};


textarea.ondragover = function(event){
    event.preventDefault();
};


const queue = [];

queue.add = function(files){
    const length = queue.length;
    queue.push(...Array.from(files));
    return length;
};


function upload(){
    const xhr = new XMLHttpRequest();
    xhr.open('POST', textarea.dataset.upload);
    xhr.timeout = 120 * 1000;

    xhr.onloadend = function(event){
        if(xhr.status === 200){
            insertText(textarea, xhr.responseText);
        }
        progress.hide();
        queue.shift();
        if(queue.length){
            upload();
        }
    };

    xhr.upload.onprogress = function(event){
        progress(event.loaded/event.total*100);
    };

    const formdata = new FormData();
    formdata.append('file', queue[0]);
    xhr.send(formdata);
}
