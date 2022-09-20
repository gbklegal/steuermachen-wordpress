/**
 * steuermachen WordPress Theme
 * 
 * @author Tobias Roeder
 * @version 1.1.0
 */

// window load
window.addEventListener('load', function() {
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
                button.classList.replace('icon-eye-off', 'icon-eye');
            }
            else if (inputType === 'text') {
                input.type = 'password';
                button.classList.replace('icon-eye', 'icon-eye-off');
            }
        }
    });

    if (document.body.classList.contains('page-id-28564'))
        initDictShortcodes();

    // selfwritten slider
    reallySimpleSlider();

    // this fixes the issue - when the user refreshes the page and not beeing at the top of the page
    headerScroll();

    // fixed header page padding fix
    // setPagePaddingToHeaderHeight(); // now solved with fixed css

    // Steuerlexikon (dict)
    selectLetterInDictFromHash();

    // FAQ Accordion
    // const accs = document.querySelectorAll('.accordion');
    accordionJS();

    // Tabs
    let faqTabs = new Tabs();
    if (faqTabs.isAvailable())
        faqTabs.init();

    // Price Calculator
    let priceCalc = new PriceCalc({
        input: '#priceInput',
        result: '#priceResult'
    });
    priceCalc.run();

    // Price Calculator
    let propertyTaxPriceCalc = new PriceCalc({
        input: '[data-property-tax-price-input]',
        result: '[data-property-tax-price-result]',
        priceType: 'propertyTax'
    });
    propertyTaxPriceCalc.run();

    // Init Mobile Menu
    initMenuMobile();

    // Back To Top Init
    let backToTopElmt = document.querySelector('#back-to-top');
    if (backToTopElmt)
        backToTopElmt.addEventListener('click', backToTop);
});

// window hash change
window.addEventListener('hashchange', function() {
    selectLetterInDictFromHash();
});

// window resize
window.addEventListener('resize', function() {
    setPagePaddingToHeaderHeight();
});

// window scroll
window.addEventListener('scroll', function() {
    headerScroll();
});

// window keydown
window.addEventListener('keydown', function(event) {
    switch (event.key) {
        case 'Escape':
            hideMenuMobile();
    }
});


/**
 * enables keyboard shortcodes
 */
function initDictShortcodes() {
    window.addEventListener('keydown', event => {
        if (isLetter(event.key))
            location.hash = event.key;
    });
}


/**
 * set padding to page from header height
 */
function setPagePaddingToHeaderHeight() {
    const page = document.querySelector('#page');
    const header = document.querySelector('#header');

    if (!page || !header)
        return;

    page.style.paddingTop = header.clientHeight + 'px';
}


/**
 * toggle header scroll class by checking scroll position
 */
function headerScroll() {
    const header = document.querySelector('#header');

    if (!header)
        return;

    if (window.scrollY > 0)
        header.classList.add('header-scroll');
    else
        header.classList.remove('header-scroll');
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
    // only on the dictionary (steuerlexikon) page
    if (!document.body.classList.contains('page-id-28564'))
        return;
    let hashValue = location.hash.slice(1);
    selectLetterInDict(hashValue);
}


/**
 * back to top without changing/setting the location hash
 */
function backToTop(event) {
    event.preventDefault();

    // without animation
    // scrollTo(0, 0);

    // with animation
    jQuery('html, body').animate({ scrollTop: 0 }, 400);

    return false;
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

    if (accs.length <= 0)
        return;

    // TODO fix lazy code
    let hash = window.location.hash;
    let focusedFaqItem = null;
    if (hash)
        focusedFaqItem = document.querySelector(hash);
    if (focusedFaqItem) {
        focusedFaqItem.classList.add('active');
        const panel = focusedFaqItem.nextElementSibling;
        panel.style.maxHeight = panel.scrollHeight + 'px';
    }
}


/**
 * Tabs
 */
class Tabs {
    /**
     * contructor
     * 
     * @param {object} selector 
     * @param {object} content 
     */
    constructor( selector, content ) {
        this.selector = selector || document.querySelector('[data-tabs="selector"]');
        this.content = content || document.querySelector('[data-tabs="content"]');
    }

    /**
     * get selector element
     * 
     * @returns {object}
     */
    getSelector() {
        return this.selector;
    }

    /**
     * get content elements
     * 
     * @returns {object}
     */
    getContent() {
        return this.content;
    }

    /**
     * initilize the tabs
     */
    init() {
        let selector = this.selector;
        let items = selector.querySelectorAll('.item');
        let content = this.content;
        let targets = content.querySelectorAll('.content');

        items.forEach((item, index) => {
            item.onclick = function() {
                let selectedItem = selector.querySelector('.item-selected');
                selectedItem.classList.remove('item-selected');
                let selectedTarget = content.querySelector('.content-selected');
                selectedTarget.classList.remove('content-selected');

                item.classList.add('item-selected');
                targets[index].classList.add('content-selected');
            }
        })
    }

    /**
     * check if tabs is available
     * 
     * @param {boolean} showConsoleInfo false
     */
    isAvailable( showConsoleInfo = false ) {
        if (showConsoleInfo) {
            if (!this.selector)
                console.info('Missing selector element, could not being found.');

            if (!this.content)
                console.info('Missing content elements, could not being found.');
        }

        if (!this.selector || !this.content)
            return false;

        return true;
    }
}


/**
 * Quick Search
 */
class QuickSearch {
    /**
     * @param {string|object} searchElmt - search element
     * @param {string|object} itemSelector - quick search item selector 
     */
    constructor(searchElmt, itemSelector) {
        if (typeof searchElmt === 'string')
            searchElmt = document.querySelector(searchElmt);

        if (typeof itemSelector === 'string')
            itemSelector = document.querySelectorAll(itemSelector);

        this.elmt = searchElmt || document.querySelector('[data-qs-elmt]');
        this.selector = itemSelector || document.querySelectorAll('[data-qs-item]');

        // evtl. onkeydown
        this.elmt.onkeyup = (event) => {
            let val = event.target.value;
            this.search(val);
        };
    }

    /**
     * @param {string} query - search query
     */
    search(query) {
        query = query.toLowerCase();

        this.selector.forEach(item => {
            let text = item.innerText.toLowerCase();

            if (!text.includes(query))
                this.hide(item);
            else
                this.show(item);
        });
    }

    /**
     * @param {object} item
     */
    hide(item) {
        if (item)
            item.hidden = true;
    }

    /**
     * @param {object} item
     */
    show(item) {
        if (item)
            item.hidden = false;
    }
}


/**
 * Price Calculator
 * calculate the price on the base of Bruttojahreneinkommen
 */
class PriceCalc {
    /**
     * prices
     * @private
     */
    #prices = [
        89,
        99,
        129,
        169,
        189,
        229,
        299,
        319,
        369,
        429
    ];

    /**
     * propertyTaxPrices
     * @private
     */
    #propertyTaxPrices = [
        89,
        119,
        169,
        189,
        229,
        249,
        309
    ];

    /**
     * priceTypes
     * @private
     */
    #priceTypes = [
        'bje',
        'propertyTax'
    ];

    /**
     * @param {string|object} input
     * @param {string|object} result
     * @param {string} priceType - optional
     */
    constructor({ input, result, priceType = 'bje' }) {
        if (typeof input === 'string')
            this.input = document.querySelector(input);
        else
            this.input = input;

        if (typeof result === 'string')
            this.result = document.querySelector(result);
        else
            this.result = result;

        if (this.#priceTypes.includes(priceType))
            this.priceType = priceType;
        else
            console.error(`${priceType} is wrong - allowed price types: ${this.#priceTypes}`);
    }

    /**
     * this method does everything automatically
     * it only need the input and result element
     * from the constructor
     * 
     * @returns {undefined}
     */
    run() {
        // we need both elements for the task
        if (this.isAvailable() === false)
            return;

        let input = this.input;
        let result = this.result;

        // watch for changes
        input.oninput = () => {
            // get price from input value
            let price = null;

            if (this.priceType === 'bje')
                price = this.getPrice(input);
            else if (this.priceType === 'propertyTax')
                price = this.getPropertyTaxPrice(input);

            // only show price if its a number
            if (typeof price === 'number') {
                // format price (add currency)
                let priceFormatted = this.formatCurrency(price);

                // write the formatted price into the result element
                result.innerHTML = priceFormatted;
            }
            // as fallback just write a whitespace
            else {
                result.innerHTML = '&nbsp;';
            }
        }
    }

    /**
     * format a number into a currency string
     * 
     * @param {number} number 
     * 
     * @returns {string}
     */
    formatCurrency( number ) {
        return String(number)
            // .toFixed(2)
            .replace('.', ',')
            .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' Euro';
    }

    /**
     * reduce a string to its core numbers
     * 
     * @param {string} string 
     * 
     * @returns {number}
     */
    reduceToNumber( string ) {
        return Number(
            parseInt(
                string.replace(/[^\d,]/g, '')
            ).toFixed(0)
        );
    }

    /**
     * get price
     * 
     * @param {object} elmt - optional
     * 
     * @returns {number|boolean}
     */
    getPrice( elmt = null ) {
        if (!elmt) elmt = this.input;
        const bje = this.reduceToNumber(elmt.value);
        let price = 0;

        if (bje !== NaN) {
            let priceIndex = 0;

            if (bje <= 8000) {
                priceIndex = 0;
            }
            else if (bje >= 8001 && bje <= 16000) {
                priceIndex = 1;
            }
            else if (bje >= 16001 && bje <= 25000) {
                priceIndex = 2;
            }
            else if (bje >= 25001 && bje <= 37000) {
                priceIndex = 3;
            }
            else if (bje >= 37001 && bje <= 50000) {
                priceIndex = 4;
            }
            else if (bje >= 50001 && bje <= 80000) {
                priceIndex = 5;
            }
            else if (bje >= 80001 && bje <= 110000) {
                priceIndex = 6;
            }
            else if (bje >= 110001 && bje <= 150000) {
                priceIndex = 7;
            }
            else if (bje >= 150001 && bje <= 200000) {
                priceIndex = 8;
            }
            else if (bje >= 200001 && bje <= 250000) {
                priceIndex = 9;
            }
            else {
                price = 0;
                return false;
            }

            price = this.#prices[priceIndex];

            return price;
        }
    }

    /**
     * get property tax price
     * 
     * @param {object} elmt - optional
     * 
     * @returns {number|boolean}
     */
    getPropertyTaxPrice( elmt = null ) {
        if (!elmt) elmt = this.input;
        const propertyTax = this.reduceToNumber(elmt.value);
        let price = 0;

        if (propertyTax !== NaN) {
            let priceIndex = 0;

            if (propertyTax <= 65000) priceIndex = 0;
            else if (propertyTax <= 125000) priceIndex = 1;
            else if (propertyTax <= 200000) priceIndex = 2;
            else if (propertyTax <= 350000) priceIndex = 3;
            else if (propertyTax <= 500000) priceIndex = 4;
            else if (propertyTax <= 1000000) priceIndex = 5;
            else if (propertyTax <= 5000000) priceIndex = 6;
            else {
                price = 0;
                return false;
            }

            price = this.#propertyTaxPrices[priceIndex];

            return price;
        }
    }

    /**
     * checks if all necessary elements exists
     * 
     * @param {boolean} showInfo - optional (Default: false)
     * 
     * @returns {boolean}
     */
    isAvailable( showInfo = false ) {
        // check if both elements exists
        if (this.input && this.result)
            return true;

        // only show info in console if requested
        if (showInfo)
            console.warn('Input or Result is missing');

        return false;
    }
}


/**
 * Mobile menu functions
 * 
 * @function initMenuMobile
 * @function showMenuMobile
 * @function hideMenuMobile
 */

/**
 * Init menu mobile only if it exists
 */
function initMenuMobile() {
    const menuMobile = document.querySelector('#menu-mobile');

    // abort if not exists
    if (!menuMobile)
        return;

    const showMenu = document.querySelector('[data-show-menu]');
    const hideMenu = document.querySelector('[data-hide-menu]');

    showMenu.addEventListener('click', showMenuMobile);
    hideMenu.addEventListener('click', hideMenuMobile);
}

/**
 * Show menu mobile
 */
function showMenuMobile() {
    const menuMobile = document.querySelector('#menu-mobile');

    jQuery(menuMobile).fadeIn(200, disablePageScroll);
}

/**
 * Hide menu mobile
 */
function hideMenuMobile() {
    const menuMobile = document.querySelector('#menu-mobile');

    enablePageScroll();
    jQuery(menuMobile).fadeOut(200);
}


/**
 * Influence the scrolling of the body
 * 
 * @function disableScroll
 * @function enableScroll
 * @function toggleScroll
 */

/**
 * prevent page from beeing scrollable
 */
function disablePageScroll() {
    jQuery(document.body).addClass('disable-scroll');
}

/**
 * enable scrolling on page
 */
function enablePageScroll() {
    jQuery(document.body).removeClass('disable-scroll');
}

/**
 * toggle scrolling on page
 */
function togglePageScroll() {
    jQuery(document.body).toggleClass('disable-scroll');
}


/**
 * Really Simple Slider
 * 
 * @author Tobias Röder
 * @version 0.1.0
 */
function reallySimpleSlider() {
    const scrollDistance = 400;

    const isOverflownX = elmt => {
        return elmt.scrollWidth > elmt.clientWidth;
    }

    const rssElmt = document.querySelector('[data-rss]');

    if (!rssElmt || !isOverflownX(rssElmt))
        return;

    const rssElmtInner = rssElmt.querySelector('[data-rss-inner]');
    const rssLeft = rssElmt.querySelector('[data-rss-left]');
    const rssRight = rssElmt.querySelector('[data-rss-right]');

    const hideRssLeft = () => rssLeft.hidden = true;
    const showRssLeft = () => rssLeft.hidden = false;

    const hideRssRight = () => rssRight.hidden = true;
    const showRssRight = () => rssRight.hidden = false;

    const checkRssControlVisibility = () => {
        if (rssElmtInner.scrollLeft <= 0) {
            hideRssLeft();
        } else {
            showRssLeft();
        }

        if (rssElmtInner.scrollLeft >= (rssElmtInner.scrollWidth - rssElmtInner.clientWidth)) {
            hideRssRight();
        } else {
            showRssRight();
        }
    }

    checkRssControlVisibility();

    rssElmtInner.addEventListener('scroll', checkRssControlVisibility);

    rssLeft.addEventListener('click', () => {
        rssElmtInner.scrollLeft -= scrollDistance;
    });

    rssRight.addEventListener('click', () => {
        rssElmtInner.scrollLeft += scrollDistance;
    });


    // fix position absolute height loss
    rssElmt.style.height = rssElmtInner.clientHeight + 'px';
}

const _g = {}; // TODO remove in prod.

/**
 * Modal with a focus an iframe
 * TODO change ModalFrame to Modal back and add the parameter frame, also look if show gets a string or an event
 * ! TODO: fix go back issue
 * TODO close modal with 'ESC' - @DONE
 */
class ModalFrame {
    #isVisible = false;
    #id;

    /**
     * @param {HTMLElement} modalElmt
     * @param {HTMLElement} closeElmt
     * @param {HTMLElement} frameElmt
     */
    constructor({ modalElmt, closeElmt, frameElmt }) {
        if (!modalElmt || !closeElmt || !frameElmt) {
            throw new Error('Modal initialisation failed. One or more elements are missing.');
        }

        this.modal = modalElmt;
        this.close = closeElmt;
        this.frame = frameElmt;

        this.close.addEventListener('click', () => this.hide());

        _g.f = this.frame; // TODO remove in prod.

        window.addEventListener('keydown', event => {
            if (event.key === 'Escape') this.hide();
        });

        window.addEventListener('popstate', () => {
            if (this.isVisible) this.hide();
        });
    }

    #loadContent() {
        // first of all make a cleanup
        this.frame.innerHTML = '';

        // show loading indicator
        this.modal.classList.add('modalframe-loading');

        const xhr = new XMLHttpRequest();
        const url = `${location.origin}/wp-json/wp/v2/pages/${this.id}`;

        xhr.open('GET', url, true);
        xhr.onreadystatechange = () => {
            if (xhr.readyState !== 4) return;
            if (xhr.status !== 200) {
                modal.open({
                    icon: 'error',
                    title: 'Fehler',
                    message: 'Wir bitten um Entschuldigung. Es gab einen Fehler beim Laden der Seite.',
                    callback: () => this.hide(),
                });
                return;
            }

            const data = JSON.parse(xhr.responseText);

            // hide loading indicator when done
            this.modal.classList.remove('modalframe-loading');

            let title = data.title.rendered;
            let content = data.content.rendered;

            // this.content = data.content.rendered;
            // this.frame.innerHTML += `<h1>${title}</h1>`;
            this.frame.innerHTML += `<main class="main-content">${content}</main>`;
        };
        xhr.send();
    }

    /**
     * show modal
     * 
     * @param {string} url 
     */
    show(url) {
        disablePageScroll();
        jQuery(this.modal).fadeIn(400, () => {
            this.frame.src = url;
        });
    }

    /**
     * hide modal
     */
    hide() {
        enablePageScroll();
        jQuery(this.modal).fadeOut(200, () => {
            this.frame.src = '';
        });
    }
}



/**
 * ! currently not working
 * utiltiy function to create a random id
 * 
 * @param {number} length - optional
 * 
 * @returns {string}
 */
function randomId( length = 8 ) {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const random = Math.round(Math.random() * 61);
    let randomId = '';

    let i = 1;
    while(i <= length) {
        randomId += chars[random];
        i++;
    }

    return randomId;
}


/**
 * executs the callback each delay
 * this prevents for example an eventlistener
 * to get executed more often than it has to
 * 
 * orignal code from Web Dev Simplified
 * @see https://github.com/WebDevSimplified/debounce-throttle-js/blob/main/script.js#L24
 * 
 * @param {function} callback
 * @param {number} delay - optional
 * 
 * @returns {undefined}
 */
function throttle(callback, delay = 1000) {
    let shouldWait = false;
    let waitingArgs;
    const timeoutFunc = () => {
        if (waitingArgs == null) {
            shouldWait = false;
        } else {
            callback(...waitingArgs)
            waitingArgs = null;
            setTimeout(timeoutFunc, delay);
        }
    }

    return (...args) => {
        if (shouldWait) {
            waitingArgs = args;
            return;
        }

        callback(...args);
        shouldWait = true;

        setTimeout(timeoutFunc, delay);
    }
}


/**
 * utility function to simply check if it's a letter
 * 
 * @param {string}
 * 
 * @returns {boolean}
 */
function isLetter(str) {
    return !!(str.length === 1 && str.match(/[a-z]/i));
}



/**
 * modal (alert alternate)
 */
// class Modal {
//     constructor() {

//     }

//     crawler() {
//         let modals = document.querySelectors('[data-modal]');
//         return modals;
//     }
// }
// function initModal() {
//     const modals = document.querySelectorAll('[data-modal]');
//     const modalOpener = document.querySelectorAll('[data-open-modal]');

//     if (modals.length <= 0)
//         return;
    
//     modals.forEach(modal => {
//         const closeBtn = modal.querySelector('[data-modal-close]');
//         closeBtn.addEventListener('click', () => modal.close());
//     });

//     modalOpener.forEach(modalOpener => {
//         console.log(modalOpener);
//     });

//     if (modalOpener.length <= 0)
//         return;
// }


// function openModal( modalId ) {
//     const modal = document.querySelector(`[data-modal="${modalId}"]`);
//     if (!modal)
//         return;

//     modal.showModal();
// }



const modal = {
    modal: null,

    icons: {
        'success': 'icon-check-circle',
        'warning': 'icon-alert-circle',
        'error': 'icon-x-circle'
    },

    /**
     * open the modal
     * 
     * @param {string} icon - optional (success, warning, error)
     * @param {string} title - optional
     * @param {string} message - optional
     * 
     * @returns {undefined}
     */
    open({ icon = null, title = null, message = null } = {}) {
        let modalElmt = modal.modal;

        if (modalElmt && modalElmt.open)
            modal.close();

        if (!modal.modal) {
            modalElmt = document.createElement('dialog');
            modalElmt.className = 'modal';
            modalElmt.dataset.modal = '';
        }

        modalElmt.innerHTML = '';

        if (icon in modal.icons) {
            modalElmt.innerHTML += `
                <div class="modal-icon ${modal.icons[icon]} modal-theme-${icon}"></div>`;
        }
        if (title)
            modalElmt.innerHTML += `
                <div class="modal-title">${title}</div>`;
        if (message)
            modalElmt.innerHTML += `
                <div class="modal-main">${message}</div>`;

        modalElmt.innerHTML += `
            <div class="modal-footer">
                <button class="btn btn-primary btn-full" data-modal-close>OK</button>
            </div>
        `;

        const modalCloseBtn = modalElmt.querySelector('[data-modal-close]');
        modalCloseBtn.addEventListener('click', () => modalElmt.close());

        modal.modal = modalElmt;
        document.body.appendChild(modalElmt);
        modalElmt.showModal();
    },

    close() {
        if (!modal.modal)
            return;
        modal.modal.close();
    }
}




function adjustIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.clientHeight + 'px';
}