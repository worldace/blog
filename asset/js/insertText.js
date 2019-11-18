
function insertText(textarea, text){
    const cursor = textarea.selectionStart;
    const before = textarea.value.substr(0, cursor);
    const after  = textarea.value.substr(cursor, textarea.value.length);

    textarea.value = before + text + after;
}

export default insertText;