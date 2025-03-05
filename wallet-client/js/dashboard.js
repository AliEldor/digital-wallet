document.addEventListener("DOMContentLoaded", () => {
  let subMenu = document.getElementById("subMenu");
  let menuIcon = document.getElementById("menu-icon");
  let navLinks = document.querySelector(".nav-links");
  let balanceElement = document.querySelector(".balance-amount p");
  let userNameElement = document.querySelector(".sub-menu .user-info h3");

  document.querySelector(".profile-pic").addEventListener("click", (event) => {
    event.stopPropagation();
    subMenu.classList.toggle("open-menu");
  });

  menuIcon.addEventListener("click", () => {
    navLinks.classList.toggle("open");
  });




  document.addEventListener("click", (event) => {
    if (
      !subMenu.contains(event.target) &&
      !event.target.matches(".profile-pic")
    ) {
      subMenu.classList.remove("open-menu");
    }
  });

  document.addEventListener("click", (event) => {
    if (
      !navLinks.contains(event.target) &&
      !event.target.matches(".menu-icon")&&
      !menuIcon.contains(event.target)
    ) {
      navLinks.classList.remove("open");
    }
  });

  const userName = localStorage.getItem('userName');
  if (userName) {
    userNameElement.textContent = userName;
  }

  
  
});
