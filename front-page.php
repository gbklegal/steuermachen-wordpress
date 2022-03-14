<?php get_header(); ?>


<main class="main-content front-page">
    <div id="hero" class="hero-wrapper">
        <div class="hero-text">
            <h1><span class="text-primary">Think Tax</span> - Lass jetzt deine Steuer machen</h1>
            <div class="seals">
                <?php
                    the_attachment(442, 'thumbnail', 'trusted-shops');
                    the_attachment(28234, '', 'elster');
                    the_attachment(28229, 'thumbnail', 'datenschutz');
                ?>
            </div>
            <div class="advantages">
                <ul>
                    <li>Einfach</li>
                    <li>Schnell</li>
                    <li>Preiswert</li>
                    <li>Sicher</li>
                </ul>
            </div>
            <div class="cta-button">
                <button class="btn btn-primary btn-lg">Loslegen</button>
            </div>
        </div>
        <div class="hero-image">
            <?php the_attachment(32118); ?>
        </div>
    </div>

    <section id="quicktax" class="section section-mb">
        <h2 class="h3 text-center">Quick Tax - Berechne schnell und kostenlos deine voraussichtliche Steuererstattung</h2>
        <a class="btn btn-primary mx-auto block whitespace-nowrap w-fit" href="http://steuermachen-theme.local/steuererklaerung-beauftragen/?utm_source=steuermachen.de&amp;utm_medium=steuerrechner&amp;utm_campaign=steuer2021">Jetzt Steuererklärung machen lassen</a>
    </section>

    <section id="steps" class="section section-mb">
        <div class="step">
            <img src="<?php echo STM_THEME_URL; ?>/img/submit.svg" alt="Schritt 1">
            <details>
                <summary>Gewünschte Steuererklärung beauftragen</summary>
                <div class="details-content">Fülle das Bestellformular aus, wähle das gewünschte Steuerjahr für das du die Einkommensteuererklärung machen lassen willst und sende einfach das Formular ab.</div>
            </details>
        </div>
        <div class="step">
            <img src="<?php echo STM_THEME_URL; ?>/img/open-email.svg" alt="Schritt 2">
            <details>
                <summary>Unterlagen vorbereiten und versenden</summary>
                <div class="details-content">Du erhälst sofort eine Checkliste, mit deren Hilfe du deine erforderlichen Unterlagen zusammenstellst. Danach sendest du uns einfach deine gesammelten Unterlagen zu.</div>
            </details>
        </div>
        <div class="step">
            <img src="<?php echo STM_THEME_URL; ?>/img/solution.svg" alt="Schritt 3">
            <details>
                <summary>Deine persönliche Steuerkanzlei bietet die Lösung für deine Steuererklärung</summary>
                <div class="details-content">Deine beauftragte Steuerkanzlei prüft für dich sicher deine Unterlagen, und berät dich online über noch offene Fragen. Anschließend erstellt sie für dich deine Einkommensteuererklärung.</div>
            </details>
        </div>
        <div class="step">
            <img src="<?php echo STM_THEME_URL; ?>/img/done.svg" alt="Schritt 4">
            <details>
                <summary>Fertig: Du erhälst deinen geprüften Steuerbescheid</summary>
                <div class="details-content">Wenn dein Steuerbescheid vom Finanzamt erstellt worden ist, wird er von deinen Steuerexperten geprüft und an dich weitergeleitet.</div>
            </details>
        </div>
    </section>

    <section id="not-clear-0" class="section section-mb text-center w-700 mx-auto">
        <h3>Einführung einer persönlichen Betreuung durch echte Steuerexperten.</h3>
        <p>Setzen Sie sich mit unseren Steuerexperten in Verbindung, die Ihnen bei der Bewältigung Ihrer steuerlichen Situation helfen können. Sie erhalten Zugang zu unbegrenzter Beratung, wenn Sie sie am dringendsten benötigen.*</p>
        <a class="btn btn-primary mx-auto" href="#">Jetzt beauftragen</a>
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
                    <div class="item-title h2">1047 &euro;</div>
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
            <div class="rating-box">
                <div class="title">Name</div>
                <div class="date">Datum: 07.06.2021</div>
                <q class="content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Placerat blandit feugiat accumsan quis. Montes, ultrices nunc, mauris nisi, ut  dictumst volutpat vel, amet. Lorem ipsum dolor leo placerat quis sit. Mollis velit vitae</q>
                <div class="rating-wrapper">
                    <div class="rating">4.8 / 5.0</div>
                    <div class="stars" style="--stars-width:96%"></div>
                </div>
            </div>
            <div class="rating-box">
                <div class="title">Name</div>
                <div class="date">Datum: 07.06.2021</div>
                <q class="content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Placerat blandit feugiat accumsan quis. Montes, ultrices nunc, mauris nisi, ut  dictumst volutpat vel, amet. Lorem ipsum dolor leo placerat quis sit. Mollis velit vitae</q>
                <div class="rating-wrapper">
                    <div class="rating">4.8 / 5.0</div>
                    <div class="stars" style="--stars-width:96%"></div>
                </div>
            </div>
            <div class="rating-box">
                <div class="title">Name</div>
                <div class="date">Datum: 07.06.2021</div>
                <q class="content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Placerat blandit feugiat accumsan quis. Montes, ultrices nunc, mauris nisi, ut  dictumst volutpat vel, amet. Lorem ipsum dolor leo placerat quis sit. Mollis velit vitae</q>
                <div class="rating-wrapper">
                    <div class="rating">4.8 / 5.0</div>
                    <div class="stars" style="--stars-width:96%"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="steuerratgeber" class="section section-py">
        <h2 class="text-center">Steuerratgeber</h2>
        <div class="recent-posts">
        <?php
            $recent_posts_options = [
                'numberposts' => 4
            ];

            $recent_posts = wp_get_recent_posts($recent_posts_options);
            $latest_post = array_shift($recent_posts);

            $latest_post_id = $latest_post['ID'];
            $latest_post_url = $latest_post['guid'];
            $latest_post_title = $latest_post['post_title'];
            $latest_post_thumbnail = get_the_post_thumbnail($latest_post_id, 'large');
            $latest_post_categories = get_the_category_list(' / ', '', $latest_post_id);
        ?>
            <div class="latest-post">
                <a href="<?php echo $latest_post_url; ?>">
                    <div class="image">
                        <?php echo $latest_post_thumbnail; ?>
                    </div>
                    <div class="categories"><?php echo $latest_post_categories; ?></div>
                    <div class="title"><?php echo $latest_post_title; ?></div>
                </a>
            </div>
        <?php
            foreach ($recent_posts as $post):
                $post_id = $post['ID'];
                $post_url = $post['guid'];
                $post_title = $post['post_title'];
                $post_thumbnail = get_the_post_thumbnail($post_id, 'medium');
                $post_categories = get_the_category_list(' / ', '', $post_id);

                ?>
            <div class="latest-posts">
                <div class="post">
                    <a href="<?php echo $post_url; ?>">
                        <div class="image">
                            <?php echo $post_thumbnail; ?>
                        </div>
                        <div class="content">
                            <div class="categories"><?php echo $post_categories; ?></div>
                            <div class="title"><?php echo $post_title; ?></div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
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
            <div class="more-details">
                <a href="#">Erfahre mehr über Sicherheit</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>