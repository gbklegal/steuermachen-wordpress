<?php get_header(); ?>

<?php if (false === get_theme_mod('hide_banner')): ?>
    <?php if (get_theme_mod('banner_link')): ?>
    <a href="<?php echo get_theme_mod('banner_link'); ?>">
        <div class="banner">
            <?php echo get_theme_mod('banner_content'); ?>
        </div>
    </a>
    <?php else: ?>
    <div class="banner">
        <?php echo get_theme_mod('banner_content'); ?>
    </div>
    <?php endif; ?>
<?php endif; ?>

<main class="main-content front-page">
    <div id="hero" class="hero-wrapper">
        <div class="hero-text">
            <h1 class="font-medium"><?php # echo get_image_tag(31979, 'steuermachen', 'steuermachen', 'left', [0, 40]); ?>Lass jetzt deine <strong>Steuer machen</strong> und erhalte <strong class="whitespace-nowrap">&Oslash; 1.047 &euro;</strong></h1>
            <p class="text-4xl">Wir sind keine Steuersoftware, bei uns arbeiten echte Menschen.</p>
            <p class="text-2xl">Persönlich und digital beides aus einer Hand</p>
            <div class="advantages">
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
                the_attachment(28234, '', 'elster');
                the_attachment(28229, 'thumbnail', 'datenschutz');
                ?>
            </div>
            <div class="cta-button">
                <a href="/beauftragen" class="btn btn-primary btn-lg">Jetzt Steuern sparen</a>
            </div>
        </div>
        <div class="hero-image">
            <?php the_attachment(33011); ?>
        </div>
    </div>

    <div class="sidebar-content-wrapper">
        <div class="sections-wrapper">
            <section id="steuerratgeber" class="section section-mb">
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
            </section>

            <section class="section section-mb">
                <a class="block mx-auto btn btn-primary whitespace-nowrap w-fit" href="/steuererklaerung-beauftragen/">Jetzt Steuern sparen</a>
            </section>

            <section id="quicktax" class="section section-mb">
                <h2 class="text-center h3">Du willst wissen ob es sich für dich lohnt? Berechne hier schnell und kostenlos deine voraussichtliche Steuererstattung.</h2>
                <?php the_steuerrechner(); ?>
                <a class="block mx-auto btn btn-primary whitespace-nowrap w-fit" href="/steuererklaerung-beauftragen/?utm_source=steuermachen.de&amp;utm_medium=steuerrechner&amp;utm_campaign=steuer2021">Jetzt Steuererklärung machen lassen</a>
            </section>

            <section id="steps" class="section section-mb">
                <h2 class="text-center h3">Leichter Ablauf und schnell Geld zurück</h2>
                <div class="flip-cards-wrapper">
                    <div class="flip-card step">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <div class="flip-card-front-inner">
                                    <img src="<?php echo STM_THEME_URL; ?>/img/submit.svg" alt="Schritt 1">
                                    <div class="h4">Gewünschte Steuererklärung beauftragen</div>
                                </div>
                            </div>
                            <div class="flip-card-back">
                                <div class="flip-card-back-inner">
                                    <div class="details-content">Fülle das Bestellformular aus, wähle das gewünschte Steuerjahr für das du die Einkommensteuererklärung machen lassen willst und sende einfach das Formular ab.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flip-card step">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <div class="flip-card-front-inner">
                                    <img src="<?php echo STM_THEME_URL; ?>/img/open-email.svg" alt="Schritt 2">
                                    <div class="h4">Unterlagen vorbereiten und versenden</div>
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
                                    <img src="<?php echo STM_THEME_URL; ?>/img/solution.svg" alt="Schritt 3">
                                    <div class="h4">Deine persönliche Steuerkanzlei bietet die Lösung für deine Steuererklärung</div>
                                </div>
                            </div>
                            <div class="flip-card-back">
                                <div class="flip-card-back-inner">
                                    <div class="details-content">Deine beauftragte Steuerkanzlei prüft für dich sicher deine Unterlagen, und berät dich online über noch offene Fragen. Anschließend erstellt sie für dich deine Einkommensteuererklärung.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flip-card step">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <div class="flip-card-front-inner">
                                    <img src="<?php echo STM_THEME_URL; ?>/img/done.svg" alt="Schritt 4">
                                    <div class="h4">Fertig: Du erhälst deinen geprüften Steuerbescheid</div>
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

            <section id="app" class="section section-mb">
                <div class="app-mockup">
                    <?php the_attachment(32579); ?>
                </div>
                <div class="text-center app-text">
                    <h3>Hol dir jetzt die steuermachen App!</h3>
                    <div class="store-badges">
                        <a href="/app/ios">
                            <?php echo stm_get_image_tag(32577, 'App Store', 'steuermachen - App Store', 'left', [200]); ?>
                        </a>
                        <!-- <a href="/app/android"> -->
                            <?php
// 32578
?>
                            <?php echo stm_get_image_tag(28749, 'Play Store', 'steuermachen - Play Store', 'left', [200]); ?>
                        <!-- </a> -->
                    </div>
                </div>
            </section>

            <!-- <section id="steuerexperten" class="mx-auto text-center section section-mb w-700">
                <h3>Deine persönliche Betreuung durch Steuerexperten</h3>
                <p class="mb-0">Setze dich mit unseren Steuerexperten in Verbindung, die dir bei der Bewältigung deiner steuerlichen Situation helfen können. Du erhältst Zugang zu unbegrenzter Beratung, wenn du sie am dringendsten benötigst.</p>
                <a class="mx-auto my-4 btn btn-primary" href="/steuererklaerung-beauftragen/">Jetzt beauftragen</a>
                <h4>Lass jetzt auch deine Grundsteuererklärung anfertigen!</h4>
                <p>Grundstückseigentümer müssen jetzt eine Grundsteuererklärung machen lassen! Das Formular ist sehr kompliziert und bei mehreren Grundstücken kann es schnell unübersichtlich werden. Durch steuermachen erhältst du jetzt die ideale und einfache Unterstützung deines persönlichen Steuerexperten. So kannst du unkompliziert und preiswert deine Grundsteuererklärung machen lassen.</p>
                <h4>Deine Vorteile auf einem Blick:</h4>
                <ul>
                    <li>Professionelle und individuelle Beratung</li>
                    <li>Sicherheitsgarantie durch Steuerexperten an deiner Seite</li>
                    <li>Zeit und Nerven gespart</li>
                    <li>Einfache und sichere Erfassung der relevanten Daten</li>
                    <li>Faire und transparente Preise</li>
                </ul>
            </section> -->
            <section id="steuerexperten" class="text-center section section-mb">
                <div class="mx-auto w-700">
                    <h3>Deine persönliche Betreuung durch Steuerexperten</h3>
                    <p class="mb-0">Setze dich mit unseren Steuerexperten in Verbindung, die dir bei der Bewältigung deiner steuerlichen Situation helfen können. Du erhältst Zugang zu unbegrenzter Beratung, wenn du sie am dringendsten benötigst.</p>
                    <a class="mx-auto my-4 btn btn-primary" href="/steuererklaerung-beauftragen/">Jetzt beauftragen</a>
                </div>

                <div class="mx-auto my-4 w-700">
                    <h3>Lass jetzt auch deine Grundsteuererklärung anfertigen!</h3>
                    <p>Grundstückseigentümer müssen jetzt eine Grundsteuererklärung machen lassen! Das Formular ist sehr kompliziert und bei mehreren Grundstücken kann es schnell unübersichtlich werden.</p>
                </div>

                <div class="benefits-box box-shadow">
                        <div class="px-4 py-3 header bg-secondary">
                            <h3>Durch steuermachen erhältst du jetzt die ideale und einfache Unterstützung deines persönlichen Steuerexperten.</h3>
                        </div>
                        <div class="main justify-content-flex-start" style="padding-left:1em">
                            <img style="width:230px" src="<?php echo STM_THEME_IMG; ?>/mortgage-loan.svg" alt="Tax">

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
                        <a class="mx-auto my-4 btn btn-primary" href="/steuererklaerung-beauftragen/">Jetzt beauftragen</a>
                    </div>
            </section>

            <section id="zahlen-und-fakten" class="section section-mb">
                <div class="box">
                    <div class="header">
                        <h2>Zahlen & Fakten</h2>
                        <?php the_attachment(32119, '', 'mockup'); ?>
                    </div>
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
            </section>

            <section id="bewertungen" class="section section-pb">
                <h2 class="text-center">Danach 100% zufrieden</h2>
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

            <section id="sicherheit" class="section section-my">
                <div class="section-inner">
                    <div class="shield">
                        <i class="icon-lock"></i>
                    </div>
                    <h2>Deine Sicherheit hat höchste Priorität, jetzt und immer.</h2>
                    <ul class="benefits">
                        <li><i class="icon-shield-check"></i> Verschlüsselung</li>
                        <li><i class="icon-database"></i> Datenspeicherung</li>
                        <li><i class="icon-lock"></i> Datenschutz</li>
                    </ul>
                    <?php
/*
                    <div class="more-details">
                        <a href="#">Erfahre mehr über Sicherheit</a>
                    </div>
                    */
?>
                </div>
            </section>
        </div>
        <?php get_sidebar('front-page'); ?>
    </div>
</main>

<?php get_footer(); ?>
