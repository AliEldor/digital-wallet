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
    
    