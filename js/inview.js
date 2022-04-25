/**
 * in View
 * 
 * @param {HTMLElement} elmt
 * 
 * @returns {Promise} - resolve contains a boolean. If the element is in view it returns true if not you'll get false.
 */
function inView( elmt ) {
    return new Promise((resolve, reject) => {
        if (!elmt) {
            reject('Element is missing or does not exists.');
            return;
        }

        const windowHeight = window.innerHeight;
        const windowPosition = window.scrollY;
        const elmtHeight = elmt.clientHeight;
        const elmtPosition = elmt.offsetTop;
        const elmtPositionTop = elmtPosition - windowHeight;
        const elmtPositionBottom = elmtPosition + elmtHeight;

        if (windowPosition > elmtPositionTop && windowPosition < elmtPositionBottom)
            resolve(true);
        else if (windowPosition < elmtPositionTop || windowPosition > elmtPositionBottom)
            resolve(false);
    });
}