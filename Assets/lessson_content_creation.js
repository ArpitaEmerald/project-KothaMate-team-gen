(function() {
  const form = document.getElementById("lessonForm") || document.querySelector("form");

  // Regex for URL validation
  const urlPattern = /^(https?:\/\/)([\w-]+\.)+[\w-]+(\/[\w\-.,@?^=%&:/~+#]*)?$/i;

  function showError(input, message) {
    // Check if an error span already exists
    let errorSpan = input.nextElementSibling;
    if (!errorSpan || !errorSpan.classList.contains("error")) {
      errorSpan = document.createElement("span");
      errorSpan.className = "error";
      input.insertAdjacentElement("afterend", errorSpan);
    }
    errorSpan.textContent = message;
  }

  function clearError(input) {
    let errorSpan = input.nextElementSibling;
    if (errorSpan && errorSpan.classList.contains("error")) {
      errorSpan.textContent = "";
    }
  }

  function isEmpty(value) {
    return value == null || String(value).trim() === "";
  }

  function validateInput(input) {
    const value = input.value.trim();

    // Empty check
    if (isEmpty(value)) {
      showError(input, "This field is required.");
      return false;
    }

    // URL check
    if (input.type === "url") {
      if (!urlPattern.test(value)) {
        showError(input, "Please enter a valid URL (e.g., https://example.com).");
        return false;
      }
    }

    // Dropdown check
    if (input.tagName.toLowerCase() === "select") {
      if (value === "") {
        showError(input, "Please select an option.");
        return false;
      }
    }

    clearError(input);
    return true;
  }

  function validateForm(form) {
    let valid = true;
    const inputs = form.querySelectorAll("#lessonTitle, #lessonDescription, #moduleName, #contentType, #contentLink");
    inputs.forEach(input => {
      const ok = validateInput(input);
      if (!ok) valid = false;
    });
    return valid;
  }

  // Real-time validation
  form.addEventListener("input", function(e) {
    const target = e.target;
    if (["lessonTitle", "lessonDescription", "moduleName", "contentType", "contentLink"].includes(target.id)) {
      validateInput(target);
    }
  });

  // Submit handler
  form.addEventListener("submit", function(e) {
    const ok = validateForm(form);
    if (!ok) {
      e.preventDefault();
      // Focus first invalid field
      const firstError = form.querySelector(".error:not(:empty)");
      if (firstError) {
        firstError.previousElementSibling.focus();
      }
    }
  });
})();
