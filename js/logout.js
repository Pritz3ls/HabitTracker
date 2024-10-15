// Logout
function logout(){
    var confirmation = confirm("Do you really want to logout?");
    if(confirmation){
        window.location.href = 'php/user-logout.php'
    }
}