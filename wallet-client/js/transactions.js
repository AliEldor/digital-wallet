document.addEventListener("DOMContentLoaded", () => {
    function fetchTransactions() {
        const userId = localStorage.getItem("userId");
        if (!userId) return;

        const formData = new FormData();
        formData.append("userId", userId);

        axios.post("../../wallet-server/user/v1/getTransactions.php", formData)
            .then((response) => {
                if (response.data.success) {
                    updateTransactionHistory(response.data.transactions);
                } else {
                    console.error("Failed to fetch transactions:", response.data.message);
                }
            })
            .catch((error) => {
                console.error("Error fetching transactions:", error);
            });
    }

    
});