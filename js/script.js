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

    // Steuerlexikon (dict)
    selectLetterInDictFromHash();

    // FAQ Accordion
    // const accs = document.querySelectorAll('.accordion');
    accordionJS();
}

window.onhashchange = function() {
    selectLetterInDictFromHash();
}


/**
 * @param {string} hashValue 
 */
function selectLetterInDict( hashValue ) {
    // Steuerlexikon (dict)
    if (hashValue.match(/[a-z]{1}/)) {
        let dictLetterSelected = document.querySelector('.alphabet a.letter.selected');
        if (dictLetterSelected)
            dictLetterSelected.classList.remove('selected');

        let dictLetterFromHash = document.querySelector('.alphabet a.letter-' + hashValue);
        if (dictLetterFromHash)
            dictLetterFromHash.classList.add('selected');
    }
}

/**
 * utility function for selectLetterInDict
 */
function selectLetterInDictFromHash() {
    let hashValue = location.hash.slice(1);
    selectLetterInDict(hashValue);
}


/**
 * scroll to top without changing/setting the location hash
 */
function scrollToTop(event) {
    if (event)
        event.preventDefault();
    scrollTo(0, 0);
}


/**
 * Collapsibles/Accordion
 * @see https://www.w3schools.com/howto/howto_js_accordion.asp
 */
function accordionJS(accs) {
    accs = accs || document.querySelectorAll('.accordion');

    accs.forEach(acc => {
        acc.onclick = () => {
            acc.classList.toggle('active');

            const panel = acc.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + 'px';
            }
        }
    });

    // TODO fix lazy code
    let hash = window.location.hash;
    let focusedFaqItem = document.querySelector(hash);
    if (focusedFaqItem) {
        focusedFaqItem.classList.add('active');
        const panel = focusedFaqItem.nextElementSibling;
        panel.style.maxHeight = panel.scrollHeight + 'px';
    }
}