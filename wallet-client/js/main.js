document.addEventListener("DOMContentLoaded", function () {
  const registerForm = document.getElementById("register-form");

  if (registerForm) {
    registerForm.addEventListener("submit", function (event) {
      event.preventDefault();

      const formData = new FormData(registerForm);

      