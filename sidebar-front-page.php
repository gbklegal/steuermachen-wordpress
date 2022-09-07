<div class="sidebar sidebar-front-page">
    <div class="sidebar-item newsletter">
        <h3 class="text-center sidebar-item-title br-2">Erhalte <span class="text-primary">kostenlose</span> Steuerberatungen und Updates!</h3>
        <div class="sidebar-item-content">
            <?php echo get_image_tag(32993, 'steuermachen App herunterladen', 'steuermachen App herunterladen', 'center', [100, 100]); ?>
            <!-- <iframe class="newsletter-iframe" src="https://tf53be01c.emailsys1a.net/139/6219/913c50802d/subscribe/form.html?_g=1651052315" frameborder="0" width="290" height="654"></iframe> -->
            <iframe class="iframe-loading" src="/newsletter/?frame_mode&hide_admin_bar" frameborder="0" scrolling="no" onload="adjustIframe(this)" class="newsletter-frame"></iframe>
        </div>
    </div>
    <div class="sidebar-item why-us">
        <div class="text-center text-white sidebar-item-title bg-secondary br-2">Warum steuermachen?</div>
        <div class="sidebar-item-content">Wir sind keine Steuersoftware, kein Chatbot. Deine Steuererklärung wird von einem echten Steuerexperten schnell und sicher bearbeitet. Dein persönlicher Steuerexperte beantwortet deine Fragen und hilft dir, deine maximale Rückerstattung zu bekommen!</div>
    </div>
    <?php if (false): ?>
    <div class="text-center sidebar-item new-product">
        <h3 class="text-white sidebar-item-title bg-primary br-2">Unser neustes Produkt!</h3>
        <div class="sidebar-item-content">
            <h4>grundsteuererklärungMACHEN</h4>
            <a href="/steuererklaerung-beauftragen/?product=grundsteuererklärungMACHEN" class="btn btn-secondary">Jetzt beauftragen</a>
        </div>
    </div>
    <?php endif; ?>
    <div class="sidebar-item qr-code-app-download">
        <h3 class="pb-0 text-center sidebar-item-title">QR scannen & App herunterladen</h3>
        <div class="sidebar-item-content">
            <a href="/app">
                <?php echo get_image_tag(32987, 'steuermachen App herunterladen', 'steuermachen App herunterladen', 'left', [200, 200]); ?>
            </a>
        </div>
    </div>
    <div class="sidebar-item contact-form">
        <h3 class="text-center sidebar-item-title">Kontaktformular</h3>
        <div class="sidebar-item-content"><?php echo do_shortcode('[contact-form-7 id="30" title="Kontaktformular"]'); ?></div>
    </div>
    <div class="sidebar-item steuerratgeber">
        <h3 class="text-center text-white sidebar-item-title bg-secondary br-2">Steuerratgeber</h3>
        <!-- <div class="sidebar-content"><a href="/steuerratgeber/">Steuerratgeber</a></div> -->
        <div class="sidebar-item-content">
            <div class="latest-posts">
            <?php
            $quick_link_ids = [get_theme_mod('quick_link_1'), get_theme_mod('quick_link_2'), get_theme_mod('quick_link_3'), get_theme_mod('quick_link_4')];
            $quick_link_ids = array_filter($quick_link_ids, function ($item) {
                if (false === empty($item) && false !== $item) {
                    return $item;
                }
            });
            $quick_link_ids_count = count($quick_link_ids);

            foreach ($quick_link_ids as $key => $quick_link_id):

                $post = get_post($quick_link_id);

                $post_id = $post->ID;
                $post_url = get_permalink($post_id);
                $post_title = $post->post_title;
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
                <?php if ($key + 1 < $quick_link_ids_count): ?>
                <hr class="my-3">
                <?php endif; ?>
            <?php
            endforeach;
            ?>
            </div>
        </div>
    </div>
</div>