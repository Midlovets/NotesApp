const registerButton = document.getElementById("register");
const loginButton = document.getElementById("login");
const container = document.getElementById("container");

registerButton.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});

loginButton.addEventListener("click", () => {
  container.classList.remove("right-panel-active");
});

const form = document.querySelector('form');
const email = document.getElementById('email');
const emailError = document.querySelector("#email-error");

function showError(input, message) {
    const formControl = input.parentElement;
    formControl.className = 'form-control error';
    const small = formControl.querySelector('small');
    small.innerText = message;
}

function showSuccess(input) {
    const formControl = input.parentElement;
    formControl.className = 'form-control success';
    const small = formControl.querySelector('small');
    small.innerText = '';
}

function checkEmail(email) {
    const emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
    return emailRegex.test(email);
}

email.addEventListener("input", function() {
    if (!checkEmail(email.value)) {
        emailError.textContent = "*Email is not valid";
    } else {
        emailError.textContent = "";
    }
});

function checkRequired(inputArr) {
    let isRequired = false;
    inputArr.forEach(function(input) {
        if (input.value.trim() === '') {
            showError(input, `*${getFieldName(input)} is required`);
            isRequired = true;
        } else {
            showSuccess(input);
        }
    });

    return isRequired;
}

function getFieldName(input) {
    return input.id.charAt(0).toUpperCase() + input.id.slice(1);
}

form.addEventListener('submit', function(e) {
    e.preventDefault();

    if (!checkRequired([email])) {

    } 
});

let lgForm = document.querySelector('.form-lg');
let lgEmail = document.querySelector('.email-2');
let lgEmailError = document.querySelector(".email-error-2");

lgEmail.addEventListener("input", function() {
    if (!checkEmail(lgEmail.value)) {
        lgEmailError.textContent = "*Email is not valid";
    } else {
        lgEmailError.textContent = "";
    }
});

function checkRequiredLg(inputArr2) {
    let isRequiredLg = false;
    inputArr2.forEach(function(input) {
        if (input.value.trim() === '') {
            showError2(input, `*${getFieldNameLg(input)} Please enter your information in this field`);
            isRequiredLg = true;
        } else {
            showSuccess2(input);
        }
    });

    return isRequiredLg;
}
n
lgForm.addEventListener('submit', function(e) {
    e.preventDefault();

    if (!checkRequiredLg([lgEmail])) {
        checkEmail(lgEmail.value); 
    }
});

