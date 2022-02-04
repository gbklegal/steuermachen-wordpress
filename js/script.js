/**
 * steuermachen WordPress Theme
 * 
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

    // Tabs
    let faqTabs = new Tabs();
    if (faqTabs.isAvailable())
        faqTabs.init();
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

        if (!this.selector || this.content)
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