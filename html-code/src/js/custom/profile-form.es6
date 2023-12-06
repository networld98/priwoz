function togglePasswordVisibility(passwordInput, eyeIcon) {
    if (passwordInput.attr("type") === "password") {
        passwordInput.attr("type", "text");
        eyeIcon.removeClass("icon-eye").addClass("icon-eye-off");
    } else {
        passwordInput.attr("type", "password");
        eyeIcon.removeClass("icon-eye-off").addClass("icon-eye");
    }
}

// Event handlers for each password field
$(".toggle-password-button").on("click", function () {
    const passwordInput = $(this).siblings("input");
    const eyeIcon = $(this).parent().find(".icon");
    togglePasswordVisibility(passwordInput, eyeIcon);
});