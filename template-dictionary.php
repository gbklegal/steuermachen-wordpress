<?php

/**
 * Template Name: Lexikon (Steuerlexikon)
 */


/**
 * utility function get first letter from string
 * 
 * @param string $string
 * 
 * @return string
 */
function first_letter( string $string ):string {
    return $string[0];
}

/**
 * utility function to fix umlaut issue
 * 
 * @param string $string
 * 
 * @return string
 */
function fix_umlaut( string $string ) {
    return strtr($string, array(
        'Ä' => 'A',
        'Ü' => 'U',
        'Ö' => 'O'
    ));
}


/**
 * get title and link from all lexicon articles as array
 * 
 * @return array
 */
function get_lexicon_articles():array {
    // $apiUrl = get_site_url() . '/wp-json/wp/v2/pages/?parent=28564&orderby=title&order=asc&per_page=350&page=1&_fields=title,link&per_page_total';
    $wp_query = new WP_Query([
        's' => '',
        'post_parent' => 28564,
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'title',
    ]);
    $posts = [];

    if ($wp_query->have_posts())
        foreach ($wp_query->get_posts() as $post) {
            $wp_query->the_post();
            $posts[] = [
                'title' => get_the_title(),
                'link' => get_the_permalink()
            ];
        }

    return $posts;
}


/**
 * get all lexicon articles as 2d array sorted by there first letter (A, B, ...)
 * 
 * @return array
 */
function get_lexicon_articles_sorted():array {
    $lexicon_articles = get_lexicon_articles();
    $sorted_lexicon_articles = [];

    foreach($lexicon_articles as $lexicon_article) {
        $article_title = $lexicon_article['title'];
        $sorted_lexicon_articles[first_letter(fix_umlaut($article_title))][] = $lexicon_article;
    }

    return $sorted_lexicon_articles;
}

get_header();

?>
<main class="main-content steuerlexikon">
    <div id="hero" class="hero-wrapper">
        <div class="hero-text">
            <h1>Steuerlexikon</h1>
            <div class="secondary-title">Alles, was Du über Steuern wissen müssen, findest Du in unserem Steuerlexikon.</div>
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
                $letter_lower_case = strtolower($letter);
            ?>
                <li><a class="letter letter-<?=$letter_lower_case?>" href="#<?=$letter_lower_case?>"><?=$letter?></a></li>
            <?php endfor; ?>
        </ul>
        <?php endif; ?>
        <?php foreach(get_lexicon_articles_sorted() as $letter => $lexicon_articles): ?>
            <section>
                <span id="<?=strtolower($letter)?>" class="anchors"></span>
                <div class="section-inner">
                    <div class="master-letter">
                        <h2 id="<?=strtolower($letter)?>"><?=$letter?></h2>
                    </div>
                    <ul>
                    <?php foreach($lexicon_articles as $lexicon_article): ?>
                        <li>
                            <a href="<?=$lexicon_article['link']?>"><?=$lexicon_article['title']?></a>
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