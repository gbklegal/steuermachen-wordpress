/**
 * steuermachen WordPress Theme
 * 
 * @author Tobias Roeder
 * @version 0.0.1
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

    // fixed header page padding fix
    setPagePaddingToHeaderHeight();

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

    // Init Mobile Menu
    initMenuMobile();

    // Scroll To Top Init
    let scrollToTopElmt = document.querySelector('#scroll-to-top');
    if (scrollToTopElmt)
        scrollToTopElmt.addEventListener('click', scrollToTop);
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
 * set padding to page from header height
 */
function setPagePaddingToHeaderHeight() {
    const page = document.querySelector('#page');
    const header = document.querySelector('#header');

    page.style.paddingTop = header.clientHeight + 'px';
}


/**
 * toggle header scroll class by checking scroll position
 */
function headerScroll() {
    const header = document.querySelector('#header');

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
    let hashValue = location.hash.slice(1);
    selectLetterInDict(hashValue);
}


/**
 * scroll to top without changing/setting the location hash
 */
function scrollToTop(event) {
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
     * @param {string|object} input
     * @param {string|object} result
     */
    constructor({ input, result }) {
        if (typeof input === 'string')
            this.input = document.querySelector(input);
        else
            this.input = input;

        if (typeof result === 'string')
            this.result = document.querySelector(result);
        else
            this.result = result;
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
            let price = this.getPrice(input);

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