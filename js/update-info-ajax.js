function ConfirmChanges(){
    Swal.fire({
        title: "Do you want to save these changes?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Confirm",
        confirmButtonColor: "#3085d6",
        reverseButtons: true
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            Swal.fire("Saved!", "", "success");
            UpdateInfo();
        }
    });
}
function UpdateInfo(){
    const name = document.getElementById("username").value;
    const pass = document.getElementById("pass").value;

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        console.log(this.responseText);
    }
    xhttp.open("POST", "php/update-account-ajax.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    let msg = "update_info=yes&username="+name+"&pass="+pass;
    xhttp.send(msg);
}