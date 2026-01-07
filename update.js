// Assets_01/validation.js

document.addEventListener("DOMContentLoaded", function() {
    // Select the form inside the card
    const form = document.querySelector("form");

    form.addEventListener("submit", function(event) {
        // Find or create the error display box
        let errorContainer = document.getElementById("js-errors");
        if (!errorContainer) {
            errorContainer = document.createElement("div");
            errorContainer.id = "js-errors";
            errorContainer.className = "error";
            form.prepend(errorContainer);
        }

        // Reset errors for new submission
        errorContainer.innerHTML = "";
        let errorMessages = [];

        // Get Input Values by name
        const name = form.querySelector('input[name="name"]').value.trim();
        const email = form.querySelector('input[name="email"]').value.trim();
        const phone = form.querySelector('input[name="phone"]').value.trim();

        // 1. Name Validation
        if (name === "") {
            errorMessages.push("Name cannot be empty.");
        }

        // 2. Email Validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            errorMessages.push("Invalid email address format.");
        }

        // 3. Mobile Number Validation (Exactly 11 digits)
        const phonePattern = /^[0-9]{11}$/;
        if (!phonePattern.test(phone)) {
            errorMessages.push("Mobile number must be exactly 11 digits (0-9).");
        }

        // If errors exist, stop the form from reaching Controllers/update.php
        if (errorMessages.length > 0) {
            event.preventDefault(); // Stop form submission
            
            errorMessages.forEach(function(msg) {
                const p = document.createElement("p");
                p.textContent = "• " + msg;
                errorContainer.appendChild(p);
            });
        }
    });
});