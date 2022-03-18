<?php

/**
 * hide admin bar for testing (get parameter)
 */
if (isset($_GET['hide_admin_bar']))
    show_admin_bar(false);