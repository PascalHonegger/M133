function validateRegisterForm() {

    // Variables
    var username = document.getElementById('SelectedUsername');
    var firstPassword = document.getElementById('SelectedPassword');
    var secondPassword = document.getElementById('RepeatPassword');
    var googleAuthenticationCode = document.getElementById('GoogleAuthenticatorCode');
    var regExpPattern = new RegExp('^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@!%*?&_-])[A-Za-z\d$@!%*?&_-]{8,}');
    var everythingWentGood = true;
    var whatWentWrongText = 'Fehler:</br>';

    // Reset Colors
    username.style.border = '';
    firstPassword.style.border = '';
    secondPassword.style.border = '';
    googleAuthenticationCode.style.border = '';

    // Username
    if(username.value.length >= 40)
    {
        username.style.border = '2px solid red';
        whatWentWrongText = whatWentWrongText.concat('Benutzername zu lang</br>');
        everythingWentGood = false;
    }

    // TODO
    // Password
    //if(regExpPattern.test(firstPassword.value))
    //{
    //    firstPassword.style.border = '2px solid red';
    //    whatWentWrongText = whatWentWrongText.concat('Passwort entspricht nicht den Kriteren (Mindestens 8 Zeichen lang, Zahlen, Sonderzeichen, Gross- und Kleinbuchstaben</br>');
    //    everythingWentGood = false;
    //}

    if(firstPassword.value != secondPassword.value)
    {
        secondPassword.style.border = '2px solid red';
        whatWentWrongText = whatWentWrongText.concat('Passwörter stimmen nicht überein</br>');
        everythingWentGood = false;
    }

    // Google Authentication-Code
    if(isNaN(googleAuthenticationCode.value) || googleAuthenticationCode.value.length > 6)
    {
        googleAuthenticationCode.style.border = '2px solid red';
        whatWentWrongText = whatWentWrongText.concat('Der generierte GoogleAuthenticator-Code ist im falschen format (nur Zahlen)</br>');
        everythingWentGood = false;
    }

    if(!everythingWentGood){
        document.getElementById('javscriptErrors').innerHTML = whatWentWrongText;
    }

    return everythingWentGood;
}