/**
 * liveSearch
 * 
 * some of the code is inspired by JavaScript Tutorial
 * @see https://www.javascripttutorial.net/javascript-dom/javascript-infinite-scroll/
 * 
 * @returns {undefined}
 */
function liveSearch() {
    const searchInput = search_form.s;
    if (!searchInput) return;

    const searchResultsElmt = document.querySelector('.search-results');
    const searchResultsStatus = document.querySelector('.search-results-status');
    const searchResultsLoadMore = document.querySelector('.search-form-wrapper .search-results-load-more');
    const loaderElmt = document.querySelector('.search-form-wrapper .search-results-loader');
    const updateSearchResults = throttle(() => {
        clearResults(() => {
            resultsCount = 0;
            searchTerm = searchInput.value;
            loadResults(pageCurrent);
        });
    });

    let searchTerm = '';
    let pageCurrent = 1;
    let pageTotal = 1;
    let resultsTotal = 0;
    let resultsCount = 0;
    let perPage = 15;
    // let currentTimeout = null;
    let currentLoading = false;

    searchInput.addEventListener('input', updateSearchResults);

    // get the results from API
    async function getResults(searchTerm, page) {
        // disallow empty search term
        if (searchTerm == '') {
            clearStatus();
            return;
        }

        const API_URL = `/wp-json/wp/v2/search?per_page=${perPage}&search=${encodeURIComponent(searchTerm)}&page=${page}&_embed`; // &_fields=id,title,url,excerpt,_embedded
        const response = await fetch(API_URL);
        // handle 404
        if (!response.ok)
            throw new Error(`An error occured: ${response.status}`);

        resultsTotal = response.headers.get('X-WP-Total');
        pageTotal = response.headers.get('X-WP-TotalPages');
        
        return await response.json();
    }

    // show the results
    function showResults(results) {
        if (!results)
            return;

        searchResultsElmt.innerHTML = results.reduce((content, result, index) => {
            content += `
                <div class="search-result">
                    <a href="${result.url}">
                        <h3>${result.title}</h3>
                    </a>
                    <p>${result['_embedded'].self[0].excerpt.rendered}</p>
                </div>`;

            resultsCount++;

            if (results.length === index + 1)
                activateLoadMore();

            return content;
        }, searchResultsElmt.innerHTML);

        // and update status
        setStatus( resultsCount, resultsTotal );
    }

    // remove the results
    function clearResults(callback) {
        searchResultsElmt.innerHTML = '';
        if (callback)
            callback();
    }

    function setStatus( count, total ) {
        let resultText = 'Ergebnis';
        if (total < 1 || total > 1)
            resultText += 'sen'

        searchResultsStatus.innerHTML = `${count} / ${total} ${resultText}`;
    }

    function clearStatus() {
        searchResultsStatus.innerHTML = '';
    }

    function activateLoadMore() {
        searchResultsLoadMore.dataset.active = 'true';
    }

    function deactivateLoadMore(callback) {
        searchResultsLoadMore.dataset.active = 'false';
        if (callback)
            callback();
    }

    function loadMoreIsActive() {
        if (searchResultsLoadMore.dataset.active == 'true')
            return true;

        return false;
    }

    function hideLoader() {
        loaderElmt.classList.add('hidden');
    }

    function showLoader() {
        loaderElmt.classList.remove('hidden');
    }

    function hasMoreResults() {
        const startIndex = (pageCurrent - 1) * perPage + 1;
        return resultsCount === 0 || startIndex < resultsTotal;
    }

    // load results
    async function loadResults(page) {
        if (currentLoading === false)
            currentLoading = true;
        else
            return;


        // show the loader
        showLoader();

        try {
            // if having more quotes to fetch
            if (hasMoreResults()) {
                // call the API to get the results
                const response = await getResults(searchTerm, page);
                // show results
                showResults(response);
            }
        }
        catch (error) {
            console.error(error.message);
        }
        finally {
            hideLoader();
            currentLoading = false;
        }
    }

    window.addEventListener('scroll', () => {
        // const {
        //     scrollTop,
        //     scrollHeight,
        //     clientHeight
        // } = document.documentElement;

        // if (scrollTop + clientHeight > scrollHeight - 5 && hasMoreResults(pageCurrent, perPage, resultsTotal)) {
        //     pageCurrent++;
        //     loadResults( pageCurrent );
        //     console.log('trigger loadResults');
        // }
        // return;
        if (loadMoreIsActive() && searchResultsLoadMore)
            inView(searchResultsLoadMore).then(isInView => {
                if (isInView) { // && hasMoreResults()
                    deactivateLoadMore(() => {
                        pageCurrent++;
                        // add cool down
                        loadResults(pageCurrent);
                    });
                }
            });
    }, {
        passive: true
    });
}

window.addEventListener('load', liveSearch);