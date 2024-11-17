function showPassword(idName){
  const passwordField = document.getElementById(idName);
  passwordField.type = passwordField.type === "password" ? "text" : "password";
}