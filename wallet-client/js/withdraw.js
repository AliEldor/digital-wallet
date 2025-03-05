document.addEventListener("DOMContentLoaded", () => {
    
    const withdrawBtn = document.getElementById("withdraw-btn");
    const withdrawSection = document.getElementById("withdrawSection");
    const requestBtn = document.getElementById("request-btn");
    
    //show hide
    if (requestBtn) {
        requestBtn.addEventListener("click", function() {
            
            if (withdrawSection.style.display === "none") {
                withdrawSection.style.display = "block";
            } else {
                withdrawSection.style.display = "none";
            }
        });
    }
    
    if (withdrawBtn) {
        withdrawBtn.addEventListener("click", function() {
            
            const withdrawAmount = document.getElementById("withdraw-amount").value;
            
            
            if (!withdrawAmount || parseFloat(withdrawAmount) <= 0) {
                alert("Please enter a valid amount to withdraw");
                return;
            }
            
            
            const userId = localStorage.getItem("userId");
            if (!userId) {
                alert("You are not logged in. Please log in first.");
                return;
            }
            
            
});