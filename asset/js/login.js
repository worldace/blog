const $form     = document.querySelector('form');
const $password = document.querySelector('[name="password"]');

$password.focus();

$form.addEventListener('submit', function(event){
    if($password.value === ''){
        event.preventDefault();
        alert('パスワードを入力してください');
        $password.focus();
    }
});
