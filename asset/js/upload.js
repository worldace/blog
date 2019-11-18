import Queue from './Queue.js';
import progress from './progress.js';
import insertText from './insertText.js';

// 使い方：<textarea data-upload="送信先URL">タグを用意しておく
// 課題：ファイルサイズ制限


const queue = new Queue;

const $textarea = document.querySelector('textarea[data-upload]');

$textarea.ondrop = function(event){
    event.preventDefault();

    for(const file of event.dataTransfer.files){
        queue.add(upload.bind(null, file));
    }
};

$textarea.ondragover = function(event){
    event.preventDefault();
};



function upload(file){
    const xhr = new XMLHttpRequest();
    xhr.open('POST', $textarea.dataset.upload);
    xhr.timeout = 120 * 1000;

    xhr.onloadend = function(event){
        if(xhr.status === 200){
            insertText($textarea, xhr.responseText);
        }
        progress.hide();
        queue.next();
    };

    xhr.upload.onprogress = function(event){
        progress(event.loaded/event.total*100);
    };

    const formdata = new FormData();
    formdata.append('file', file);
    xhr.send(formdata);
}
