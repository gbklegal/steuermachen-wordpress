<?php $_is_post_modified = get_the_modified_date('U') !== get_the_time('U'); ?>
<div class="post-wrapper single-post">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header id="hero" class="post-header">
            <?php the_title('<h1 class="post-title">', '</h1>'); ?>
            <?php if (get_theme_mod('single_meta', 1)): ?>
            <div class="post-meta">
                <p class="uppercase posted-on">Veröffentlicht am <?php the_date(); ?> von <?php echo get_the_author(); ?></p>
                <?php if ($_is_post_modified): ?>
                <p class="uppercase updated-on text-grey">Aktualisiert am <?php the_modified_date(); ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php if (!is_frame_mode()): ?>
            <div class="post-categories">
                <?php echo get_the_category_list(' / '); ?>
            </div>
            <?php endif; ?>
        </header>
        <main class="post-content-wrapper">
            <div class="post-content">
                <?php if (has_post_thumbnail()) {
                    the_post_thumbnail('post-thumbnail', [
                        'class' => 'post-thumbnail',
                    ]);
                } ?>
                <?php
                $table_of_contents = table_of_contents(get_the_content());
                if (!empty($table_of_contents)): ?>
                <div class="post-table-of-contents">
                    <h3>Inhaltsverzeichnis</h3>
                    <ul class="table-of-contents">
                        <?php echo table_of_contents(get_the_content()); ?>
                    </ul>
                </div>
                <?php endif;
                ?>
                <?php the_content(); ?>
            </div>
            <div class="post-sidebar">
                <?php the_author_info(); ?>
                <div>
                    <h3>Unsere Inhalte werden juristisch geprüft:</h3>
                    <p>Tobias Gußmann ist Fachanwalt für Steuerrecht und Mitbegründer der Fachanwaltskanzlei GBK legal sowie Gussmann Böhner & Kropp GbR. Seine langjährigen Erfahrungen im Steuerrecht untermauern seine Expertise. Durch seinen Ehrgeiz und seiner Wissbegierde kennt er sich über alle aktuellen Gesetzesänderungen und Neuheiten bestens aus. Sein Fachwissen ist für jeden seiner Mandanten eine Bereicherung.</p>
                </div>
                <div>
                    <h3>Warum steuermachen:</h3>
                    <p>
                        Keine Arbeit mit der Steuererklärung!<br />
                        Lass jetzt deine Steuererklärung von Steuerexperten machen!<br />
                        Wir sind keine Steuersoftware, bei uns arbeiten echte Menschen.<br />
                        Dein persönlicher Steuerexperte beantwortet deine Fragen und hilft dir, deine maximale Steuerrückerstattung zu bekommen. Persönlich und digital beides aus einer Hand!
                    </p>
                </div>
            </div>
        </main>
        <?php if (comments_open() || get_comments_number()):
            echo '<hr>';
            comments_template();
        endif; ?>
    </article>
</div>