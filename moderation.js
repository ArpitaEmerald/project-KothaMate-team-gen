function deleteMessage(button) {
    const row = button.closest("tr");
    if (confirm("Are you sure you want to remove this message?")) {
        row.remove();
        alert("Message removed successfully.");
    }
}
