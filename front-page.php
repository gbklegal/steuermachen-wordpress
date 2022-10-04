<?php

add_filter('body_class', function ($body_class) {
    $body_class[] = 'no-gradient';

    return $body_class;
});

$_banner_hide = get_theme_mod('hide_banner');
$_banner_link = get_theme_mod('banner_link');
$_banner_content = get_theme_mod('banner_content');

get_header();
?>

<?php if (false === $_banner_hide): ?>
    <?php if ($_banner_link): ?>
    <a href="<?php echo $_banner_link; ?>">
    <?php endif; ?>
        <div class="banner">
            <div class="banner-inner">
                <?php echo $_banner_content; ?>
            </div>
        </div>
    <?php if ($_banner_link): ?>
    </a>
    <?php endif; ?>
<?php endif; ?>

<main class="main-content front-page">
    <div id="hero" class="hero-wrapper full-bleed">
        <div class="hero-image">
            <?php the_attachment(33011); ?>
        </div>
        <div class="hero-text">
            <h1>Lass jetzt deine Steuer machen und erhalte durchschnittlich 1.047 Euro</span></h1>
            <p class="mt-4 text-2xl">Wir sind keine Steuersoftware, bei uns arbeiten echte Menschen.</p>
            <p class="text-2xl">Persönlich und digital beides aus einer Hand</p>
            <div class="mt-8 mb-16 cta-button">
                <a href="/beauftragen" class="btn btn-lg">Jetzt Steuern sparen</a>
            </div>
            <div class="mb-8 advantages">
                <ul>
                    <li>Einfach</li>
                    <li>Schnell</li>
                    <li>Preiswert</li>
                    <li>Sicher</li>
                </ul>
            </div>
            <div class="seals">
                <?php
                the_attachment(442, 'thumbnail', 'trusted-shops');
                the_attachment(34156, '', 'elster');
                the_attachment(28229, 'thumbnail', 'datenschutz');
                ?>
            </div>
        </div>
    </div>

    <div class="mt-12 sidebar-content-wrapper">
        <div class="sections-wrapper">
            <section id="steps" class="section section-mb">
                <h2 class="mb-6 h3">steuermachen - Gewinn für alle und schnell Geld zurück</h2>
                <div class="flip-cards-wrapper">
                    <div class="flip-card step">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <div class="flip-card-front-inner">
                                    <!-- <img src="<?php echo STM_THEME_URL; ?>/img/submit.svg" alt="Schritt 1"> -->
                                    <?php echo stm_get_image_tag(34140, 'Schritt 1', 'Schritt 1', 'center'); ?>
                                    <span>Gewünschte Steuererklärung beauftragen</span>
                                </div>
                            </div>
                            <div class="flip-card-back">
                                <div class="flip-card-back-inner">
                                    <div class="details-content">Fülle das Bestellformular aus, wähle das gewünschte Steuerjahr für das du die Steuer&shy;erklärung machen lassen willst und sende einfach das Formular ab.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flip-card step">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <div class="flip-card-front-inner">
                                    <!-- <img src="<?php echo STM_THEME_URL; ?>/img/open-email.svg" alt="Schritt 2"> -->
                                    <?php echo stm_get_image_tag(34139, 'Schritt 2', 'Schritt 2', 'center'); ?>
                                    <span>Unterlagen vorbereiten und versenden</span>
                                </div>
                            </div>
                            <div class="flip-card-back">
                                <div class="flip-card-back-inner">
                                    <div class="details-content">Du erhälst sofort eine Checkliste, mit deren Hilfe du deine erforderlichen Unterlagen zusammenstellst. Danach sendest du uns einfach deine gesammelten Unterlagen zu.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flip-card step">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <div class="flip-card-front-inner">
                                    <!-- <img src="<?php echo STM_THEME_URL; ?>/img/solution.svg" alt="Schritt 3"> -->
                                    <?php echo stm_get_image_tag(34141, 'Schritt 3', 'Schritt 3', 'center'); ?>
                                    <span>Deine persönliche Steuererklärung fertigt dein Steuerexperte an</span>
                                </div>
                            </div>
                            <div class="flip-card-back">
                                <div class="flip-card-back-inner">
                                    <div class="details-content">Deine beauftragte Steuerkanzlei prüft für dich sicher deine Unterlagen und berät dich online über noch offene Fragen. Anschließend erstellt sie für dich deine Steuer&shy;erklärung.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flip-card step">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <div class="flip-card-front-inner">
                                    <!-- <img src="<?php echo STM_THEME_URL; ?>/img/done.svg" alt="Schritt 4"> -->
                                    <?php echo stm_get_image_tag(34138, 'Schritt 4', 'Schritt 4', 'center'); ?>
                                    <span>Fertig: Du erhälst deinen geprüften Steuerbescheid</span>
                                </div>
                            </div>
                            <div class="flip-card-back">
                                <div class="flip-card-back-inner">
                                    <div class="details-content">Wenn dein Steuerbescheid vom Finanzamt erstellt worden ist, wird er von deinen Steuerexperten geprüft und an dich weitergeleitet.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <section id="vergleichstabelle" class="section section-mb">
                <div>
                    <h2>Wieso für steuermachen zahlen, statt ELSTER kostenfrei nutzen?</h2>
                    <p class="mt-4 mb-8">Mit steuermachen erhältst du schnell und sicher deine maximale Steuererstattung. Wir sind keine Steuersoftware, deine Steuererklärung wird von einem echten Steuerexperten für dich angefertigt.</p>
                    <a href="/jetzt-bauftragen/" class="btn">Jetzt Steuern sparen</a>
                </div>
                <div class="table">
                    <div class="cell header">&nbsp;</div>
                    <div class="cell header"><span>ELSTER</span></div>
                    <div class="cell header"><span>Steuersoftware</span></div>
                    <div class="cell header"><span>steuermachen</span></div>

                    <div class="cell label">ELSTER-Schnittstelle</div>
                    <div class="cell"><span class="material-icons text-primary">done</span></div>
                    <div class="cell"><span class="material-icons text-primary">done</span></div>
                    <div class="cell"><span class="material-icons text-primary">done</span></div>

                    <div class="cell label">Keine langwierige Registrierung</div>
                    <div class="cell not">-</div>
                    <div class="cell"><span class="material-icons text-primary">done</span></div>
                    <div class="cell"><span class="material-icons text-primary">done</span></div>

                    <div class="cell label">Keine Vorkenntnisse erforderlich</div>
                    <div class="cell not">-</div>
                    <div class="cell not">-</div>
                    <div class="cell"><span class="material-icons text-primary">done</span></div>

                    <div class="cell label">Persönliche Beratung und Betreuung durch echte Experten</div>
                    <div class="cell not">-</div>
                    <div class="cell not">-</div>
                    <div class="cell"><span class="material-icons text-primary">done</span></div>

                    <div class="cell label">Du musst nur die Unterlagen einreichen, der Rest wird für dich erledigt</div>
                    <div class="cell not">-</div>
                    <div class="cell not">-</div>
                    <div class="cell"><span class="material-icons text-primary">done</span></div>
                </div>
            </section>

            <!-- <section id="steuerratgeber" class="section section-mb">
                <h2 class="text-center">Steuerratgeber</h2>
                <div class="recent-posts">
                <?php
                $recent_posts_options = [
                    'numberposts' => 4,
                    'post_status' => 'publish',
                ];
                $recent_posts = wp_get_recent_posts($recent_posts_options);
                $latest_post = array_shift($recent_posts);
                $latest_post_id = $latest_post['ID'];
                $latest_post_url = get_permalink($latest_post_id);
                // $latest_post['guid']
                $latest_post_title = $latest_post['post_title'];
                $latest_post_thumbnail = get_the_post_thumbnail($latest_post_id, 'large');
                ?>
                    <div class="latest-post">
                        <a href="<?php echo $latest_post_url; ?>">
                            <div class="image">
                                <?php echo $latest_post_thumbnail; ?>
                            </div>
                        </a>
                        <a href="<?php echo $latest_post_url; ?>">
                            <div class="title">
                                <?php echo $latest_post_title; ?>
                            </div>
                        </a>
                    </div>
                    <div class="latest-posts">
                <?php foreach ($recent_posts as $post):

                    $post_id = $post['ID'];
                    // $post_url = $post['guid'];
                    $post_url = get_permalink($post_id);
                    $post_title = $post['post_title'];
                    $post_thumbnail = get_the_post_thumbnail($post_id, 'medium');
                    ?>
                        <div class="post">
                            <a href="<?php echo $post_url; ?>">
                                <div class="image">
                                    <?php echo $post_thumbnail; ?>
                                </div>
                            </a>
                            <div class="content">
                                <a href="<?php echo $post_url; ?>">
                                    <div class="title">
                                        <?php echo $post_title; ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                endforeach; ?>
                    </div>
                </div>
            </section> -->

            <!-- <section class="section section-mb">
                <a class="block mx-auto btn whitespace-nowrap w-fit" href="/steuererklaerung-beauftragen/">Jetzt Steuern sparen</a>
            </section> -->

            <!-- <section id="quicktax" class="p-8 bg-white section section-my"> -->
            <section id="quicktax" class="section section-my">
                <h2 class="mb-0 text-center">Du willst wissen ob es sich für dich lohnt? Berechne hier schnell und kostenlos deine voraussichtliche Steuererstattung.</h2>
                <?php the_steuerrechner(); ?>
                <a class="block mx-auto btn whitespace-nowrap w-fit" href="/steuererklaerung-beauftragen/?utm_source=steuermachen.de&amp;utm_medium=steuerrechner&amp;utm_campaign=steuer2021">Jetzt Steuererklärung machen lassen</a>
            </section>

            <section id="app" class="section section-mb">
                <div class="app-mockup">
                    <?php the_attachment(32579); ?>
                </div>
                <div class="text-center app-text">
                    <p class="font-normal h3">Noch leichter geht's mit der steuermachen App.</p>
                    <p class="font-normal h3">Sammle und übertrage deine Belege digital.</p>
                    <div class="store-badges">
                        <a href="/app/ios">
                            <?php echo stm_get_image_tag(32577, 'App Store', 'steuermachen - App Store', 'left', [200]); ?>
                        </a>
                        <a href="/app/android">
                            <?php echo stm_get_image_tag(32578, 'Play Store', 'steuermachen - Play Store', 'left', [200]); ?>
                        </a>
                    </div>
                </div>
            </section>

            <section id="entwickelt-fuer" class="section section-mb">
                <div class="flex flex-row gap-16 p-24 justify-content-space-between align-items-center box bg-accent br-6 box-shadow">
                    <div>
                        <p class="uppercase">steuermachen für Alle</p>
                        <ul>
                            <li>Familien</li>
                            <li>Singles</li>
                            <li>Renter</li>
                            <li>Kurzarbeiter</li>
                            <li>Arbeitnehmer</li>
                            <li>Beamte</li>
                            <li>Studenten</li>
                            <li>Expats</li>
                            <li>Auszubildende</li>
                        </ul>
                        <!-- <p>Entwickelt für dich.</p> -->
                    </div>
                    <div>
                        <!-- <img src="https://via.placeholder.com/720x720.png?text=Platzhalter" alt="Platzhalter" style="width:320px"> -->
                        <img class="br-5" src="<?= wp_get_attachment_image_url(34145, 'full') ?>" alt="">
                        <!-- https://unsplash.com/photos/tvbxqXI5mmo -->
                    </div>
                </div>
            </section>

            <section id="vorteile" class="section section-mb">
                <div class="benefits-box box-shadow">
                    <div class="px-6 py-5 header bg-primary">
                        <h3 class="m-0 font-normal">Durch steuermachen erhältst du jetzt die ideale und einfache Unterstützung deines persönlichen Steuerexperten.</h3>
                    </div>
                    <div class="main justify-content-flex-start" style="padding-left:1em">
                        <!-- <img style="width:230px" src="<?php echo wp_get_attachment_image_url('33026'); ?>" alt="Grundsteuer"> -->

                        <ul class="text-left benefits">
                            <li>Professionelle und individuelle Beratung</li>
                            <li>Sicherheitsgarantie durch Steuerexperten an deiner Seite</li>
                            <li>Zeit und Nerven gespart</li>
                            <li>Einfache und sichere Erfassung der relevanten Daten</li>
                            <li>Faire und transparente Preise</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-5 text-center order-now">
                    <a class="mx-auto my-4 btn" href="/steuererklaerung-beauftragen/">Jetzt beauftragen</a>
                </div>
            </section>

            <!-- <section id="zahlen-und-fakten" class="section section-mb">
                <h2>Zahlen & Fakten</h2>
                <div class="inner">
                    <?php the_attachment(33027, '', 'mockup'); ?>
                    <div class="items">
                        <div class="item">
                            <div class="item-title h2">100 %</div>
                            <div class="item-content">Nerven gespart und mehr Freizeit</div>
                        </div>
                        <div class="item">
                            <div class="item-title h2">5</div>
                            <div class="item-content">Jeder fünfte Steuerbescheid ist falsch</div>
                        </div>
                        <div class="item">
                            <div class="item-title h2">1.047 &euro;</div>
                            <div class="item-content">Durchschnittliche Steuerrückerstattung für Steuerzahler</div>
                        </div>
                        <div class="item">
                            <div class="item-title h2">3</div>
                            <div class="item-content">Jeder dritte Steuerzahler denkt, es lohnt sich nicht</div>
                        </div>
                    </div>
                </div>
            </section> -->

            <section id="bewertungen" class="section section-pb">
                <h2>Danach 100% zufrieden</h2>
                <div class="rating-boxes">
                    <?php // $trusted_shops_reviews = $_COOKIE['test'] ?? null; // if ( true === is_null( $trusted_shops_reviews ) ) //     create_one_hour_cookie( 'trusted_shops_reviews', $trusted_shops_reviews = json_encode( get_etrusted_reviews() ) ); // else //     $trusted_shops_reviews = json_decode( $trusted_shops_reviews, true );


                    // ! currently not working
                    // TODO: find a solution
                    $trusted_shops_reviews = get_etrusted_reviews(3, 5);
                    // TODO: remove arguments
                    foreach ($trusted_shops_reviews as $review):

                        $title = $review['title'];
                        $date = $review['date'];
                        $comment = $review['comment'];
                        $rating = number_format($review['rating'], 1);
                        $star_length = $rating / 0.05;
                        ?>
                    <div class="rating-box">
                        <div class="details-wrapper">
                            <div class="title"><?php echo $title; ?></div>
                            <div class="date">Datum: <?php echo $date; ?></div>
                            <q class="content"><?php echo $comment; ?></q>
                        </div>
                        <div class="rating-wrapper">
                            <div class="rating"><?php echo $rating; ?> / 5.0</div>
                            <div class="stars" style="--stars-width:<?php echo $star_length; ?>%"></div>
                        </div>
                    </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </section>

        </div>
        <?php get_sidebar('front-page'); ?>
    </div>
</main>

<?php get_footer();
