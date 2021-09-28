document.getElementById("form1").addEventListener("submit", (e) => {
    e.preventDefault();

    let dataForm = {
        username: document.querySelector("input[name='username']").value,
        password: document.querySelector("input[name='password']").value
    };

    $.ajax({
        url: "controller/login/",
        type: "POST",
        data: JSON.stringify(dataForm),
        success: function (data) {
            Swal.fire({
                icon: data.icon,
                title: data.title,
                text: data.text
            }).then(() => {
                window.location.href = data.redirect;
            });
    }
    });
});