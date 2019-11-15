export default insertText;

function insertText(textarea, text){
    const pos    = textarea.selectionStart;
    const before = textarea.value.substr(0, pos);
    const after  = textarea.value.substr(pos, textarea.value.length);

    textarea.value = before + text + after;
}