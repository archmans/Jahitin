var usernameInput = document.getElementById('username');
var emailInput = document.getElementById("email");
var passwordInput = document.getElementById("password");
var errorUsername = document.getElementById('errorUsername');
var errorEmail = document.getElementById('errorEmail');
var errorPassword = document.getElementById('errorPassword');
var isUsernameInputValid = false;
var isEmailInputValid = false;
var isPasswordInputValid = false;
var submitBtn = document.getElementById('submit');
var debounceTimer;


usernameInput.addEventListener("input", function() {
    var username = usernameInput.value;
    if (username.length > 0) {
        if (/^(?=.{1,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/.test(username)) {
            debounceAvailabilityUsername(username);
            usernameInput.style.border = "1px solid green";
            errorUsername.style.display = "none";
            isUsernameInputValid = true;
        } else {
            usernameInput.style.border = "1px solid red";
            errorUsername.style.display = "block";
            errorUsername.style.color = "red";
            errorUsername.fontSize = "10px";
            errorUsername.innerHTML = "1-20 char, only contain letters, numbers, underscores and periods.";
            isUsernameInputValid = false;
        }
    } else {
        usernameInput.style.border = "1px solid red";
        errorUsername.style.display = "block";
        errorUsername.style.color = "red";
        errorUsername.fontSize = "10px";
        errorUsername.innerHTML = "Username is required";
        isUsernameInputValid = false;
    }
    updateSubmitButton();
});

function debounceAvailabilityUsername(username) {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(function() {
        console.log("Debounce");
        checkAvailabilityUsername(username);
    }, 500);
}

function checkAvailabilityUsername(username) {    
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            if (data.isAvailable) {
                usernameInput.style.border = "1px solid green";
                errorUsername.style.display = "none";
                isUsernameInputValid = true;
            } else {
                usernameInput.style.border = "1px solid red";
                errorUsername.style.fontSize = "10px";
                errorUsername.style.display = "block";
                errorUsername.style.color = "red";
                errorUsername.innerHTML = "Username already exists";
                isUsernameInputValid = false;
            }
        }
    };
    xhr.open("GET", "ajax/registerAjax.php?data=" + username, true);
    xhr.send();
}

emailInput.addEventListener("input", function() {
    var email = emailInput.value;
    if (email.length > 0) {
        if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
            emailInput.style.border = "1px solid green";
            errorEmail.style.display = "none";
            isEmailInputValid = true;
        } else {
            emailInput.style.border = "1px solid red";
            errorEmail.style.display = "block";
            errorEmail.style.color = "red";
            errorEmail.style.fontSize = "10px";
            errorEmail.innerHTML = "Email is invalid";
            isEmailInputValid = false;
        }
    } else {
        emailInput.style.border = "1px solid red";
        errorEmail.style.display = "block";
        errorEmail.style.color = "red";
        errorEmail.style.fontSize = "10px";
        errorEmail.innerHTML = "Email is required";
        isEmailInputValid = false;
    }
    updateSubmitButton();
});

passwordInput.addEventListener("input", function() {
    var password = passwordInput.value;
    if (password.length > 0) {
        if (/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(password)) {
            passwordInput.style.border = "1px solid green";
            errorPassword.style.display = "none";
            isPasswordInputValid = true;
        } else {
            passwordInput.style.border = "1px solid red";
            errorPassword.style.display = "block";
            errorPassword.style.color = "red";
            errorPassword.style.fontSize = "10px";
            errorPassword.innerHTML = "At least 8 characters, contain one letter and one number";
            isPasswordInputValid = false;
        }
    } else {
        passwordInput.style.border = "1px solid red";
        errorPassword.style.display = "block";
        errorPassword.style.color = "red";
        errorPassword.style.fontSize = "10px";
        errorPassword.innerHTML = "Password is required";
        isPasswordInputValid = false;
    }
    updateSubmitButton();
});

function updateSubmitButton() {
    var submitBtn = document.getElementById('submit');
    console.log("isUsernameInputValid: " + isUsernameInputValid);
    console.log("isEmailInputValid: " + isEmailInputValid);
    console.log("isPasswordInputValid: " + isPasswordInputValid);
    if (isUsernameInputValid && isEmailInputValid && isPasswordInputValid) {
        console.log("All inputs are valid");
        submitBtn.disabled = false;
    } else {
        console.log("Not all inputs are valid");
        submitBtn.disabled = true;
    }
}