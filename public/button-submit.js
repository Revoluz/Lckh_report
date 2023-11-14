document.addEventListener("submit", function (event) {
    const submitButtons = document.querySelectorAll(".button-submit");
    for (const submitButton of submitButtons) {
        submitButton.disabled = true;
        submitButton.innerHTML = "Mengirim...";
    }
});
