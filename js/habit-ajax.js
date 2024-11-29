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
            ArchiveBoard(id);
        }
    });
}
function ArchiveBoard(id){
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "php/habit-core-ajax.php",true);
    xhttp.onload = function(){
        // Clear the form inputs before reloading
        document.querySelectorAll('form').forEach(form => form.reset());
        // Then reload the page
        window.location.href = window.location.href;
        console.log(this.responseText);
    }
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("delete_board=true&board_id="+id);
}