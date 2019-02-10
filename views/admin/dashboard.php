<div class="wrap">
    <h1>AppWeb Plugin</h1>
    <?php settings_errors(); ?>

    <form action="options.php" method="post">
        <?php
            settings_fields('appweb_options_group');
            do_settings_sections('appweb_plugin');
            submit_button();
        ?>
    </form>
</div>