<?php if (false === is_frame_mode()): ?>
    <footer id="footer" class="mx-auto max-width">
        <div class="footer-top">
            <?php echo get_image_tag(31979, 'steuermachen', 'steuermachen', 'left', [0, 25]); ?>
            <div class="social">
                <!-- <a href="#"><i class="icon-instagram"></i></a>
                <a href="#"><i class="icon-facebook"></i></a> -->
                <a href="https://www.instagram.com/steuermachen.de/" title="@steuermachen.de - Instagram"><?php echo get_image_tag(33018, 'Instagram', '', 'left', 32); ?></a>
                <a href="https://www.facebook.com/steuermachen.de/" title="@steuermachen.de - Facebook"><?php echo get_image_tag(33017, 'Facebook', '', 'left', 32); ?></a>
                <a href="https://www.pinterest.de/steuermachen/" title="@steuermachen - Pinterest"><?php echo get_image_tag(33019, 'Pinterest', '', 'left', 32); ?></a>
                <a href="https://www.linkedin.com/company/steuermachen/" title="@steuermachen - LinkedIn"><?php echo get_image_tag(33016, 'LinkedIn', '', 'left', 32); ?></a>
            </div>
        </div>

        <hr>

        <div class="text-center sign-up">
            <!-- <h2 class="uppercase">Jetzt registrieren! Keine Verpflichtung kostenlose Testverion (ist dieser Text wirklich final?)</h2>
            <p>Melde Dich bei Think-Tax an und mache deine persönliche Tour durch Think-Tax (ist auch dieser Text wirklich final?)</p>
            <a href="/dashboard" class="btn btn-secondary btn-lg">Anmelden</a> -->
            <iframe src="https://tf53be01c.emailsys1a.net/139/6219/913c50802d/subscribe/form.html?_g=1651052315" frameborder="0" width="100%" height="345" id="newsletter"></iframe>
        </div>

        <div class="text-center app-badges">
            <a href="/app/ios">
                <?php echo stm_get_image_tag(32577, 'App Store', 'steuermachen - App Store', 'left', [200]); ?>
            </a>
            <a href="/app/android">
                <?php echo stm_get_image_tag(32578, 'Play Store', 'steuermachen - Play Store', 'left', [200]); ?>
            </a>
        </div>

        <div class="footer-navs">
            <div class="footer-nav">
                <h3>Über steuermachen</h3>
                <?php get_nav_menu('footer_1'); ?>
            </div>
            <div class="footer-nav">
                <h3>Rechtliche Dokumente</h3>
                <?php get_nav_menu('footer_2'); ?>
            </div>
            <div class="footer-nav">
                <h3>Kooperation | Wir helfen Ihnen</h3>
                <?php get_nav_menu('footer_3'); ?>
            </div>
            <div class="trusted-shops-logo-wrapper">
                <?php the_attachment('442', 'thumbnail'); ?>
            </div>
        </div>
        <div class="footer-text" id="copyright">
            <p>Copyright &copy; steuermachen (GDF). Sämtliche Inhalte, Fotos, Texte und Graphiken sind urheberrechtlich geschützt. Sie dürfen ohne vorherige schriftliche Zustimmung oder Genehmigung der GDF weder ganz noch auszugsweise kopiert, verändert, vervielfältigt oder veröffentlicht werden.</p>
            <p>&ldquo;TaxGreen – Papierlos glücklich&rdquo; ist die Kampagne von steuermachen.de, die den Plan und die Maßnahmen von steuermachen.de zum Schutz dieser Erde und Umwelt umfasst.</p>
        </div>
        <p><small>* Preise inkl. 19% Mwst. *** Preise netto zzgl. der gesetzlichen Mehrwertsteuer von 19%.<br>
        ** Wichtiger Hinweis zum Bruttojahreseinkommen: Die Bemessungsgrundlage setzt sich zusammen aus: - dem auf der Lohnsteuerkarte des betreffenden Steuerjahres eingetragenen Bruttoarbeitslohn - dem jährlichen Gesamtbetrag der Renten, Versorgungsbezüge, Lohnersatzleistungen und Unterhaltsleistungen - den Einnahmen aus Vermietung und Verpachtung, sowie den Einnahmen aus Kapitalvermögen. Im Falle von zusammenveranlagten Ehegatten werden die zuvor genannten Bemessungsgrundlagen und Einnahmen zusammengerechnet.</small></p>
    </footer>

<?php endif; ?>

    <div class="back-to-top-wrapper">
        <a id="back-to-top" href="#">
            <i class="icon-chevrons-up"></i>
        </a>
    </div>
</div>
</div>

<?php wp_footer(); ?>

</body>
</html>