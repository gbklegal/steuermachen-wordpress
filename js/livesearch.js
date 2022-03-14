function liveSearch() {
    const searchInput = search_form.s;

    if (!searchInput) return;

    searchInput.addEventListener('input', function(event) {
        let searchTerm = event.target.value;
        let searchApiUrl = '/wp-json/wp/v2/search?per_page=5&search=' + encodeURIComponent(searchTerm);
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

                searchResultsCounts.innerHTML = `${results.length} / ${obj.resultsTotal} Ergebnissen`;
            });
        })
    });
}

window.addEventListener('load', liveSearch);