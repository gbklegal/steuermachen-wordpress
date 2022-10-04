<div class="sidebar sidebar-front-page">
    <?php if (false): ?>
    <div class="sidebar-item newsletter">
        <h3 class="p-4 text-center">Erhalte <span class="text-primary">kostenlose</span> Steuerberatungen und Updates!</h3>
        <div class="sidebar-item-content">
            <?php echo get_image_tag(32993, 'steuermachen App herunterladen', 'steuermachen App herunterladen', 'center', [100, 100]); ?>
            <!-- <iframe class="newsletter-iframe" src="https://tf53be01c.emailsys1a.net/139/6219/913c50802d/subscribe/form.html?_g=1651052315" frameborder="0" width="290" height="654"></iframe> -->
            <iframe class="iframe-loading" src="/newsletter/?frame_mode&hide_admin_bar" frameborder="0" scrolling="no" onload="adjustIframe(this)" class="newsletter-frame"></iframe>
        </div>
    </div>
    <?php endif; ?>
    <div class="text-center sidebar-item new-product">
        <h3 class="p-4">Grundsteuererklärung</h3>
        <div class="sidebar-item-content">
            <img class="br-4" src="<?= wp_get_attachment_image_url(34146, 'medium') ?>" alt="Grundsteuererklärung">
            <p>Grundstückseigentümer müssen jetzt eine Grundsteuererklärung machen lassen. Lass jetzt auch deine Grundsteuererklärung anfertigen!</p>
            <a href="/steuererklaerung-beauftragen/?product=grundsteuererklärungMACHEN" class="btn">Jetzt Steuern sparen</a>
        </div>
    </div>
    <div class="sidebar-item qr-code-app-download">
        <h3 class="p-4 text-center">QR scannen & App herunterladen</h3>
        <div class="sidebar-item-content">
            <a href="/app">
                <?php echo get_image_tag(32987, 'steuermachen App herunterladen', 'steuermachen App herunterladen', 'left', [200, 200]); ?>
            </a>
        </div>
    </div>
    <div class="sidebar-item contact-form">
        <h3 class="p-4 text-center">Kontaktformular</h3>
        <div class="sidebar-item-content"><?php echo do_shortcode('[contact-form-7 id="30" title="Kontaktformular"]'); ?></div>
    </div>
    <div class="sidebar-item steuerratgeber">
        <h3 class="p-4 text-center">Steuerratgeber</h3>
        <!-- <div class="sidebar-content"><a href="/steuerratgeber/">Steuerratgeber</a></div> -->
        <div class="sidebar-item-content">
            <div class="latest-posts">
            <?php
            $recent_posts_options = [
                'numberposts' => 4,
                'post_status' => 'publish',
            ];
            $recent_posts = wp_get_recent_posts($recent_posts_options);

            foreach ($recent_posts as $key => $post):

                $post_id = $post['ID'];
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
                <?php if ($key + 1 < 4): ?>
                <hr class="my-3">
                <?php endif; ?>
            <?php
            endforeach;
            ?>
            </div>
        </div>
    </div>
</div>