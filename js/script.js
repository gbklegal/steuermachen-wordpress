/**
 * steuermachen WordPress Theme
 * @author Tobias Roeder
 * @version 0.0.1
 */

window.onload = function() {
    'use strict';

    // const fieldWrappers = document.querySelectorAll('.field-wrapper input[data-error], .field-wrapper input[data-warning]').forEach(elmt => elmt.parentNode);
    // document.querySelectorAll('.field-wrapper input[data-error], .field-wrapper input[data-warning]').forEach(elmt => {
    //     console.dir(elmt.parentElement);
    // });


    // toggle password
    const togglePasswordButtons = document.querySelectorAll('.toggle-password');
    togglePasswordButtons.forEach(button => {
        let input = button.previousElementSibling;
        button.onclick = function() {
            // if (input.disabled === true) return;

            let inputType = input.type;

            if (inputType === 'password') {
                input.type = 'text';
                button.classList.remove('icon-eye-off');
                button.classList.add('icon-eye');
            }
            else if (inputType === 'text') {
                input.type = 'password';
                button.classList.remove('icon-eye');
                button.classList.add('icon-eye-off');
            }
        }
    });
}