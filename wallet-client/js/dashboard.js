document.addEventListener("DOMContentLoaded", () => {
  let subMenu = document.getElementById("subMenu");
  let menuIcon = document.getElementById("menu-icon");
  let navLinks = document.querySelector(".nav-links");
  let balanceElement = document.querySelector(".balance-amount p");
  let userNameElement = document.querySelector(".sub-menu .user-info h3");

  // add money part
  const addMoneyBtn = document.querySelector(".add-money-btn");
  const addMoneyModal = document.getElementById("addMoneyModal");
  const closeModalButtons = addMoneyModal.querySelectorAll(".close-modal");
  const addMoneyForm = document.getElementById("add-money-form");

  addMoneyBtn.addEventListener("click", () => {
    addMoneyModal.classList.add("show");
  });

  closeModalButtons.forEach(button => {
    button.addEventListener("click", () => {
      addMoneyModal.classList.remove("show");
    });
  });

  addMoneyModal.addEventListener("click", (e) => {
    if (e.target === addMoneyModal) {
      addMoneyModal.classList.remove("show");
    }
  });

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

  function fetchUserBalance() {
    const userId = localStorage.getItem('userId');

    if (!userId) {
        
        window.location.href = '../index.html';
        return;
}

const formData = new FormData();
    formData.append('userId', userId);

    axios.post('../../wallet-server/user/v1/getBalance.php', formData)
      .then(response => {
        if (response.data.success) {
          
          const formattedBalance = `$${parseFloat(response.data.balance).toFixed(2)}`;
          balanceElement.textContent = formattedBalance;
        } else {
          console.error('Failed to fetch balance:', response.data.message);
          console.log(response.data)
          balanceElement.textContent = '$0.00';
        }
      })

      .catch(error => {
        console.error('Error fetching balance:', error);
        balanceElement.textContent = '$0.00';
      });
    }


    function logout() {
        
        localStorage.removeItem('userId');
        localStorage.removeItem('userName');
        
        window.location.href = '../index.html';
      }

      const logoutLink = document.querySelector('.sub-menu-link[data-action="logout"]');
  if (logoutLink) {
    logoutLink.addEventListener('click', logout);
  }

  fetchUserBalance()

  

  
});
