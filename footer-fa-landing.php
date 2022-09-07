    <footer class="max-width">
        <div class="footer-inner">
            <?php the_custom_logo(); ?>
            <p class="text-justify">Copyright &copy; steuermachen.de (GDF). Sämtliche Inhalte, Fotos, Texte und Graphiken sind urheberrechtlich geschützt. Sie dürfen ohne vorherige schriftliche Zustimmung oder Genehmigung der GDF weder ganz noch auszugsweise kopiert, verändert, vervielfältigt oder veröffentlicht werden.</p>
            <ul>
                <li>
                    <a href="javascript:modal.show('/impressum?frame_mode')" class="text-primary">Impressum</a>
                </li>
                <li>
                    <a href="javascript:modal.show('/datenschutz?frame_mode')" class="text-primary">Datenschutz</a>
                </li>
            </ul>
        </div>
    </footer>


    <div id="modal">
        <div id="modalClose" class="btn btn-primary">schließen <i class="icon-x"></i></div>
        <div class="loader u-spin icon-loader"></div>
        <iframe id="modalFrame" src="" frameborder="0"></iframe>
    </div>

    <a id="back-to-top" href="#">
        <i class="icon-chevrons-up"></i>
    </a>

</div>
</div>

<script>
var faCookieExp = 90;
</script>
<script src="https://fat.financeads.net/fpc.js"></script>

<?php wp_footer(); ?>

</body>
</html>