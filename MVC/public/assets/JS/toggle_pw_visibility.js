function show_password() {
    console.log(document.getElementById("pass").type);
    var x = document.getElementById("pass");
    if (x.type === "password") {
        x.type = "text";
        document.getElementById("eye").style.backgroundImage = "url(<?= ROOT ?>assets/svg_icons/eye_close.svg)";
    } else {
        x.type = "password";
        document.getElementById("eye").style.backgroundImage = "url(<?= ROOT ?>assets/svg_icons/eye_open.svg)";

    }
}
