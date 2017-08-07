var elementSignInUsername = document.getElementById('signin-username');
var elementSignInPassword = document.getElementById('signin-password');

function onSignInSubmit() {
    var password = encryptPassword(elementSignInUsername.value, elementSignInPassword.value);
    elementSignInPassword.value = password;
    return true;
}