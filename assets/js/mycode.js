function showHidePassword() {
    var password = document.getElementById('password1');
    var show_eye_icon = document.getElementById('show_eye');
    var hide_eye_icon = document.getElementById('hide_eye');
    hide_eye.classList.remove("d-none");

    hide_eye_icon.style.display = "none";
    show_eye_icon.style.display = "block";
    if (password.type == "password") {
        // password.innerHTMl="text";
        password.type = "text";
        hide_eye_icon.style.display = "block";
        show_eye_icon.style.display = "none";
    } else {
        password.type = "password";
        hide_eye_icon.style.display = "none";
        show_eye_icon.style.display = "block";
    }
}
