document.addEventListener("DOMContentLoaded", function () {
  const registerForm = document.getElementById("register-form");

  if (registerForm) {
    registerForm.addEventListener("submit", function (event) {
      event.preventDefault();

      const formData = new FormData(registerForm);

      axios
        .post("../../wallet-server/models/register.php", formData)
        .then(function (response) {
          if (response.data.success) {
            alert("Registration successful!");
            window.location.href = "../index.html";
          } else {
            if (response.data.errors && response.data.errors.length > 0) {
              const errorMessage = response.data.errors.join("\n");
              alert(errorMessage);
            } else {
              alert(response.data.message || "Registration failed");
            }
          }
        })
        .catch(function (error) {
          alert("Connection error. Please try again later.");
          console.log(error);
        });
    });
  }
});
