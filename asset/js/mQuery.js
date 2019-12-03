export default mQuery;

function mQuery(selector, text = '', attr = {}){
    if(selector.includes('<')){
        if(selector.match(/^<[\w\-]+>$/)){
            const tagName = selector.slice(1, -1);
            const el = document.createElement(tagName);
            el.textContent = text;
            for(let k in attr){
                el.setAttribute(k, attr[k]);
            }
            return el;
        }
        else{
            const template = document.createElement('template');
            template.innerHTML = selector;
            return template.content;
        }
    }
    else if(selector.startsWith('*')){
        if(selector.length > 1){
            selector = selector.slice(1);
        }
        return Array.from(document.querySelectorAll(selector));
    }
    return document.querySelector(selector);
}
