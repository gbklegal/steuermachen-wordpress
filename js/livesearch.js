function liveSearch() {
    const searchInput = search_form.s;

    if (!searchInput) return;

    let currentTimeout = null;

    searchInput.addEventListener('input', function(event) {
        // add an delay
        // this prevents that the timeout gets triggered multiple times
        // instead it gets reseted
        if (currentTimeout)
            clearTimeout(currentTimeout);

        currentTimeout = setTimeout(function() {
            let searchTerm = event.target.value;
            let searchApiUrl = '/wp-json/wp/v2/search?per_page=15&search=' + encodeURIComponent(searchTerm);
            let searchResults = document.querySelector('.search-results');
            let searchResultsCounts = document.querySelector('.search-results-counts');

            fetch(searchApiUrl).then(response => {
                return {
                    resultsTotal: response.headers.get('X-WP-Total'),
                    results: response.json()
                };
            }).then(obj => {
                // clear search results
                searchResults.innerHTML = '';

                obj.results.then(results => {
                    results.forEach(result => {
                        // console.log(result);
                        searchResults.innerHTML += `
                        <div class="search-result">
                            <a href="${result.url}">
                                <h3>${result.title}</h3>
                            </a>
                        </div>`;
                    });

                    let resultText = 'Ergebnis';
                    let resultsTotal = obj.resultsTotal;
                    if (resultsTotal < 1 || resultsTotal > 1)
                        resultText += 'sen'

                    searchResultsCounts.innerHTML = `${results.length} / ${obj.resultsTotal} ${resultText}`;
                });
            })
        }, 500);
    });
}

window.addEventListener('load', liveSearch);