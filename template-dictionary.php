<?php

/**
 * Template Name: Lexikon (Steuerlexikon)
 */


/**
 * utility function get first letter from string
 * @param string $string
 * @return string
 */
function firstLetter( string $string ):string {
    return $string[0];
}

/**
 * utility function to fix umlaut issue
 */
function fixUmlaut( string $string ) {
    return strtr($string, 'ÄÖÜ', 'AOU');
}


/**
 * get title and link from all lexicon articles as array
 * @return array
 */
function getLexiconArticles():array {
    // $apiUrl = get_site_url() . '/wp-json/wp/v2/pages/?parent=28564&orderby=title&order=asc&per_page=350&page=1&_fields=title,link&per_page_total';
    $wpQuery = new WP_Query([
        's' => '',
        'post_parent' => 28564,
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'title',
    ]);
    $posts = [];

    if ($wpQuery->have_posts())
        foreach ($wpQuery->get_posts() as $post) {
            $wpQuery->the_post();
            $posts[] = [
                'title' => get_the_title(),
                'link' => get_the_permalink()
            ];
        }

    return $posts;
}


/**
 * get all lexicon articles as 2d array sorted by there first letter (A, B, ...)
 */
function getLexiconArticlesSorted():array {
    $lexiconArticles = getLexiconArticles();
    $sortedLexiconArticles = [];

    foreach($lexiconArticles as $lexiconArticle) {
        $articleTitle = $lexiconArticle['title'];
        $sortedLexiconArticles[fixUmlaut(firstLetter($articleTitle))][] = $lexiconArticle;
    }

    return $sortedLexiconArticles;
}

get_header();

?>
<main class="main-content steuerlexikon">
    <div id="hero" class="hero-wrapper">
        <div class="hero-text">
            <h1>Steuerlexikon</h1>
            <p>Alles, was Sie über Steuern wissen müssen, findest Du in unserem Steuerlexikon.</p>
        </div>
        <div class="hero-image">
            <img src="<?php echo STM_THEME_URL; ?>/img/dictionary.png" alt="" srcset="<?php echo STM_THEME_URL; ?>/img/dictionary@2x.png 2x">
        </div>
    </div>
    <div class="content-wrapper">
        <?php # the_content(); ?>
        <?php if (true): ?>
        <ul class="alphabet">
            <?php for ($i = 65; $i <= 90; $i++): // 65 = A, 90 = Z
                $letter = chr($i);
                $letterLowerCase = strtolower($letter);
            ?>
                <li><a class="letter letter-<?=$letterLowerCase?>" href="#<?=$letterLowerCase?>"><?=$letter?></a></li>
            <?php endfor; ?>
        </ul>
        <?php endif; ?>
        <?php foreach(getLexiconArticlesSorted() as $letter => $lexiconArticles): ?>
            <section>
                <span id="<?=strtolower($letter)?>" class="anchors"></span>
                <div class="section-inner">
                    <div class="master-letter">
                        <h2 id="<?=strtolower($letter)?>"><?=$letter?></h2>
                    </div>
                    <ul>
                    <?php foreach($lexiconArticles as $lexiconArticle): ?>
                        <li>
                            <a href="<?=$lexiconArticle['link']?>"><?=$lexiconArticle['title']?></a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </section>
        <?php endforeach; ?>
    </div>
</main>
<?php

get_footer();