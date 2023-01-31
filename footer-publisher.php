    <footer id="footer">
        <div class="footer-inner">
            <img src="<?php echo wp_get_attachment_url(get_theme_mod('custom_logo')); ?>" class="custom-logo" alt="steuermachen">
            <p class="text-justify">Copyright &copy; steuermachen (GDF). Sämtliche Inhalte, Fotos, Texte und Graphiken sind urheberrechtlich geschützt. Sie dürfen ohne vorherige schriftliche Zustimmung oder Genehmigung der GDF weder ganz noch auszugsweise kopiert, verändert, vervielfältigt oder veröffentlicht werden.</p>
            <ul>
                <li>
                    <a href="javascript:modalFrame.show(113)" class="text-primary">Impressum</a>
                </li>
                <li>&bull;</li>
                <li>
                    <a href="javascript:modalFrame.show(110)" class="text-primary">Datenschutz</a>
                </li>
                <li>&bull;</li>
                <li>
                    <a href="javascript:modalFrame.show(123)" class="text-primary">Demo</a>
                </li>
            </ul>
        </div>
    </footer>


    <div id="modalWrapper">
        <div id="modalClose" class="btn btn-primary">schließen <i class="icon-x"></i></div>
        <div class="loader u-spin icon-loader"></div>
        <div id="modalFrame" class="prose"></div>
    </div>

    <div class="back-to-top-wrapper">
        <a id="back-to-top" href="#">
            <i class="icon-chevrons-up"></i>
        </a>
    </div>

</div>
</div>

<script>
var faCookieExp = 90;
</script>
<script src="https://fat.financeads.net/fpc.js"></script>

<?php wp_footer(); ?>

</body>
</html>