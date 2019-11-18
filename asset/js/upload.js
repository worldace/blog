import progress from './progress.js';
import insertText from './insertText.js';


// 使い方：<textarea data-upload="送信先URL">を用意しておく
// 課題：キューはPromiseにしたい。ファイルサイズ制限


const $textarea = document.querySelector('textarea[data-upload]');

$textarea.ondrop = function(event){
    event.preventDefault();

    for(const file of event.dataTransfer.files){
        queue.in(upload.bind(null, file));
    }
};


$textarea.ondragover = function(event){
    event.preventDefault();
};


const queue = [];

queue.in = function(fn){
    queue.push(fn);
    if(queue.length === 1){
        fn();
    }
};

queue.out = function(){
    queue.shift();
    if(queue.length){
        queue[0]();
    }
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
        queue.out();
    };

    xhr.upload.onprogress = function(event){
        progress(event.loaded/event.total*100);
    };

    const formdata = new FormData();
    formdata.append('file', file);
    xhr.send(formdata);
}
