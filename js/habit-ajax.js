// Load Habits
function Confirm_ArchiveBoard(id){
    Swal.fire({
        title: "Do you want to delete this board?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Confirm",
        confirmButtonColor: "#3085d6",
        reverseButtons: true
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            Swal.fire({
                title: "Deleted Board!",
                icon: "success",
            }).then(function(){
                location.reload();
            });
            ArchiveBoard(id);
        }
    });
}
function ArchiveBoard(id){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        console.log(this.responseText);
    }
    xhttp.open("POST", "php/habit-core-ajax.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("delete_board=true&board_id="+id);
}