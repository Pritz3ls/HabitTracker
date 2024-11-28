function ConfirmDeactivation(id){
    Swal.fire({
        title: "Do you want to deactivate this user?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Confirm",
        confirmButtonColor: "#e90b0b",
        reverseButtons: true
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            Swal.fire({
                title: "Deactivated User!",
                icon: "success",
            }).then(function(){
                location.reload();
            });
            DeactivateUser(id);
        }
    });
}
function DeactivateUser(id){
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "php.mis/mis-ajax-deactivate-user.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + id);
}