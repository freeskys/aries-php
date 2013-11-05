<!DOCTYPE HTML>
<html>
    <head>
        <title>AriesPHP</title>

        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width">
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="description" value="AriesPHP is a MVC framework without the PAIN.">
        <meta name="keyword" value="aries, framework, ariesphp">

        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
        <link rel="author" href="humans.txt" />

        <?php echo $css ?>
        <?php echo $js ?>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center animated fadeInUp">
                        <img src="<?php echo IMG_DIR ?>logo-aries.png" alt="Logo"/>
                    </div>
                </div>
            </div>
        </header>

        <div class="container">
            <?php echo $content ?>
        </div>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <b>Links</b>
                        <ul class="list-unstyled">
                            <li><a href="http://ariesphp.blezcode.com" target="_blank"><?php echo $visit_ariesphp ?></a></li>
                            <li><a href="https://github.com/freeskys/aries-php"
                                   target="_blank"><?php echo $lang_fork_github ?></a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <b>Language</b>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo $base ?>home/index/en">English</a></li>
                            <li><a href="<?php echo $base ?>home/index/id">Indonesia</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3">
                        Copyright &copy; <?php echo $current_year ?>&nbsp;<a href="https://twitter.com/freeskys"
                                                                             target="_blank">@freeskys</a><br />
                        <?php echo $designed_by ?>
                        <a href="https://twitter.com/androvnugros" target="_blank">@androvnugros</a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>