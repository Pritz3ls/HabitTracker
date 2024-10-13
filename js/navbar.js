// Handles burger menu button
// Horizontal Navigation Bar
// Will delete later if design suggests
const navbar = document.getElementById("navbar");
function burgir(){
    navbar.classList.toggle("show");
}

window.onclick = (event) =>{
    if(!event.target.matches('.burgir')){
        if(navbar.classList.contains("show")){
            // alert(navbar.classList.contains("show") ? "Contain" : "None");
            navbar.classList.remove("show");
        }
    }
}

navbar.addEventListener('click', event => event.stopPropagation());