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

        <?= $css ?>
        <?= $js ?>
    </head>
    <body>
        <!-- Header -->
        <div class="container header-container" style="width:100%;">
            <div class="container">
                <div class="minibox_2 language animated bounceIn">
                    <a href="http://ariesphp.blezcode.com" target="_blank"><?= $visit_ariesphp ?></a>
                </div>
                <div class="minibox_2 language animated bounceIn">
                    <a href="https://github.com/freeskys/aries-php" target="_blank"><?= $lang_fork_github ?></a>
                </div>
                <div class="minibox_4 header animated bounceIn">
                    <h3>
                        <img src="<?= IMG_DIR ?>logo-aries.png" alt="Logo"/>
                    </h3>
                </div>
                <div class="minibox_2 language animated bounceIn">
                    <?= $view_in ?> <a href="<?= $base ?>home/index/en">English</a>
                </div>
                <div class="minibox_2 language animated bounceIn">
                    <?= $view_in ?> <a href="<?= $base ?>home/index/id">Indonesia</a>
                </div>
            </div>
        </div>

        <div class="container gradient_orange" style="width:100%;height:5px">
            <div class="container">
                <div class="minibox_12">
                    <br />
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="container">
            <?= $content ?>
        </div>
        <br />
        <!-- Footer -->
        <div class="container animated fadeInUp" id="footerContainer">
            <div class="container footer">
                <div class="minibox_12 footer_item">
                    Copyright &copy; <?= $current_year ?>&nbsp;<a href="https://twitter.com/freeskys" target="_blank">AriesPHP Team</a>.
                    <?= $designed_by ?>
                    <a href="https://twitter.com/androvnugros" target="_blank">@androvnugros</a>
                </div>
            </div>
        </div>
    </body>
</html>