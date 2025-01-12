document.addEventListener('DOMContentLoaded', function () {
    // Select all eye icons
    var eyeIcons = document.querySelectorAll('.eye-icon');

    if (eyeIcons.length > 0) {
        // Add event listeners to all eye icons
        eyeIcons.forEach(function (eyeIcon) {
            eyeIcon.addEventListener('click', function () {
                var targetId = eyeIcon.getAttribute('data-target'); // Get the target field ID
                var fieldToToggle = document.getElementById(targetId); // Find the corresponding field

                if (fieldToToggle) {
                    togglePasswordVisibility(fieldToToggle, eyeIcon);
                } else {
                    console.error(`Field with ID "${targetId}" not found!`);
                }
            });
        });
    } else {
        console.error('No eye icons found. Check your HTML structure.');
    }

    // Function to toggle password visibility
    function togglePasswordVisibility(passwordField, eyeIcon) {
        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove('bi-eye-slash');
            eyeIcon.classList.add('bi-eye');
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove('bi-eye');
            eyeIcon.classList.add('bi-eye-slash');
        }
    }
});