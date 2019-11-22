
//フォームに自動セット
//使い方：form[data-json]タグを用意する。formのname,value === jsonのname,value


const form = document.querySelector('form[data-json]');
const json = JSON.parse(form.dataset.json);

for(const el of form.querySelectorAll('[name]')){
    if(el.tagName === 'SELECT'){
        for(const option of el.children){
            if(option.value === json[el.name]){
                option.setAttribute('selected', 'selected');
                break;
            }
        }
    }
    else{
        el.value = json[el.name];
    }
}
