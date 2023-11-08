function login() {
    var user = document.getElementById("username").value;
    var pass = document.getElementById("pass").value

    if (user.length == 0 || pass.length == 0) {
        document.querySelectorAll("input").forEach(i => {
            i.classList.add("border-danger");
        })
        return alert("Mezőket töltsd ki more");
    }

    $.ajax({
        type: "POST",
        url: "http://127.0.0.1/cloudShare/api/login.php",
        data: {
            username: user, password: pass
        },
        success: function (response) {
            if (response != "false") {
                setCookie("userAuth", user, 1);
                checkLogin();
            } else if (JSON.parse(response)) {
                alert("sikertelen login");
            }

        },
    });
}
window.addEventListener("keydown", (e) => {
    if (e.key == "Enter") {
        login();
    }
});
function accessDeny() {
    if (!window.location.pathname.includes("login")) {
        window.location.href = "auth/login";
    }
}
function checkLogin() {
    if (getCookie("userAuth").length != 0) {
        if (window.location.pathname.includes("login")) {
            window.location = "../../";
        }
    } else {
        accessDeny();
    }
}
checkLogin();