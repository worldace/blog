
const $tab     = document.querySelector('.tab');
const $li      = Array.from($tab.querySelectorAll('.tab > ul > li'));
const $section = Array.from($tab.querySelectorAll('.tab > section'));


$tab.addEventListener('click', function(event){
    if(!$li.includes(event.target) || event.target.classList.contains('tab-selected')){
        return;
    }

    for(const el of $tab.querySelectorAll('.tab-selected')){
        el.classList.remove('tab-selected');
    }

    const index = $li.indexOf(event.target);
    $li[index].classList.add('tab-selected');
    $section[index].classList.add('tab-selected');
});
