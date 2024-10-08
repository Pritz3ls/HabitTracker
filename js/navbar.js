// Handles burger menu button
// Horizontal Navigation Bar
// Will delete later if design suggests
function burgir(){
    var navBar = document.getElementById("navbar");
    if(navBar.classList.contains("navbar-show")){
        navBar.classList.remove("navbar-show");
    }else{
        navBar.classList.add("navbar-show");
    }
}