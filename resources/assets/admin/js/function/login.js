// $("#formLogin").on("submit", (e) => {
//     e.preventDefault();

//     let dataForm = {
//         username: $("input[name='username']").value,
//         password: $("input[name='password']").value
//     };

//     $.ajax({
//         url: $(this).attr('action'),
//         type: "POST",
//         data: JSON.stringify(dataForm),
//         success: function (data) {
//             alert('success')
//             Swal.fire({
//                 icon: data.icon,
//                 title: data.title,
//                 text: data.text
//             }).then(() => {
//                 window.location.href = data.redirect;
//             });
//         }
//     });
// });