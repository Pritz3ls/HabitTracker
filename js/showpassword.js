document.querySelector(".toggle-password").addEventListener("click", function () {
    this.classList.toggle("fa-eye-slash");
    const passwordField = document.getElementById("password-field");
    passwordField.type = passwordField.type === "password" ? "text" : "password";
  });