document.addEventListener("DOMContentLoaded", function () {

    const buttons = document.querySelectorAll(".btn");

    buttons.forEach(button => {
        button.addEventListener("click", function () {

            const userCard = this.closest(".user-card");
            const userName = userCard.querySelector(".user-name").innerText;

            if (this.classList.contains("btn-view")) {
                alert("Viewing details of " + userName);
            }

            if (this.classList.contains("btn-approve")) {
                if (confirm("Approve " + userName + "?")) {
                    alert(userName + " approved!");
                }
            }

            if (this.classList.contains("btn-block")) {
                if (confirm("Block " + userName + "?")) {
                    alert(userName + " blocked!");
                }
            }

            if (this.classList.contains("btn-remove")) {
                if (confirm("Remove " + userName + " permanently?")) {
                    userCard.remove();
                    alert(userName + " removed!");
                }
            }

        });
    });

});
