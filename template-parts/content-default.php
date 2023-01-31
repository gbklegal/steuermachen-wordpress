<?php $_is_steuerlexikon =
    wp_get_post_parent_id() === STM_STEUERLEXIKON_PAGE_ID; ?>
<div class="post-wrapper<?= return_if(
    $_is_steuerlexikon,
    ' single-post steuerlexikon-post'
) ?>">
    <header id="hero" class="post-header hero-wrapper"><?php
// if (has_title_image()) echo ' hero-wrapper'
?>
        <div class="hero-text">
            <?php the_title('<h1 class="post-title">', '</h1>'); ?>
            <?php if (has_secondary_title()): ?>
                <div class="secondary-title"><?php the_secondary_title(); ?></div>
            <?php endif; ?>
        </div>
        <?php if (has_title_image()): ?>
            <div class="hero-image">
                <?php the_title_image(); ?>
            </div>
        <?php endif; ?>
    </header>
    <div class="post-content-wrapper">
        <div class="post-content">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php the_content(); ?>
            </article>
        </div>
        <?php if ($_is_steuerlexikon): ?>
            <div class="post-sidebar">
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
        <?php endif; ?>
    </div>
</div>