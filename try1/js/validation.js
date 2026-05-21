document.addEventListener('DOMContentLoaded',function(){


const regForm = document.getElementById('regForm');
const logForm = document.getElementById('logForm');
const appForm = document.getElementById('appForm');

if (regForm){
    regForm.addEventListener('submit', function(e){

        if(!regCorrect()){
            e.preventDefault();
        }

    })
}

if (logForm) {
    logForm.addEventListener('submit', function(e){
        if(!loginCorrect()){
            e.preventDefault();
        }
    })
}

function regCorrect() {
    const login = document.getElementById('login').value.trim;
    const password = document.getElementById('password').value;
    const full_name = document.getElementById('full_name').value.trim;
    const phone = document.getElementById('phone').value.trim;
    const email = document.getElementById('email').value.trim;

    loginPattern = /^[a-zA-Z0-9]{6,}$/;
    if (!loginPattern.test(login)){
        alert("Логин не менее 6 символов, латиница");
        return false;
    }

    if (password.length < 8){
        alert('Пароль должен содержать больше 8 символов');
        return false;
    }

    fullNamePattern = /^[а-яА-я ёЁ]{2,}$/u ;
    if (!fullNamePattern.test(full_name)){
        alert('ФИО может содержать только буквы кирилицы и пробелы');
        return false;
    }


    function phoneIsvalid(){
        const digit = phone.replace(/\D/g,'');
        return digit.length === 11 && (digit[0] === '7' || digit[0] === "8")
    }
    // phonePattern = /^8\([0-9]{3}\)[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/;
    // if (!phonePattern) {
    //     alert('Телефон в формате 8(ХХХ)ХХХ-ХХ-ХХ');
    //     return false
    // }

    emailPattern = /^[^\s@]+@[^\s@]+.[a-zA-Z]{2,}$/;

if(!emailPattern.test(email)){
    alert('Неверный формат email');
    return false;
}





}




})