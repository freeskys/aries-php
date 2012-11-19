<!DOCTYPE HTML>
<html>
    <head>
        <title>AriesPHP</title>

        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width">
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="description" value="AriesPHP is a MVC framework without the PAIN.">
        <meta name="keyword" value="aries, framework, ariesphp">

        <link rel="author" href="humans.txt" />

        <?= $css ?>
        <?= $js ?>
    </head>
    <body>
        <!-- Header -->
        <div class="container gradient_black" style="width:100%;">
            <div class="container">
                <div class="minibox_8 header">
                    <h3>
                        <img src="<?= IMG_DIR ?>logo-aries.png" alt="Logo"/>
                    </h3>
                </div>
                <div class="minibox_3 language push_1">
                    Language: <a href="<?= $base ?>home/index/en">English</a> | <a href="<?= $base ?>home/index/id">Indonesia</a>
                </div>
            </div>
        </div>
        <div class="container gradient_orange" style="width:100%;">
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
        <div class="container" id="footerContainer">
            <div class="container footer">
                <div class="minibox_4 footer_item">
                    <h3><?= $lang_contribute ?></h3>
                    <a href="https://github.com/freeskys/aries-php" target="_blank"><?= $lang_fork_github ?></a>
                </div>
                <div class="minibox_4 footer_item">
                    <h3>Developer</h3>
                    <a href="https://twitter.com/freeskys">@freeskys</a> - Project Manager and Lead Developer
                    <a href="https://twitter.com/androvnugros">@androvnugros</a> - Graphic Designer
                </div>
                <div class="minibox_4 footer_item">
                    <h3><?= $lang_framework_included ?></h3>
                    <a href="https://github.com/uudshan/gemini-css" target="_blank">Minibox System</a> by Moh. Nuruddin Ef.<br />
                    <a href="http://jquery.com/" target="_blank">jQuery</a> by The jQuery Foundation<br />
                </div>
            </div>
        </div>
        <div class="container gradient_orange" id="footerContainer2">
            <div class="container">
                <div class="minibox_12 copyright">
                    <br />
                    Copyright &copy; <?= $current_year ?> Harditya Rahmat Ramadhan | <?= $lang_licensed ?>.
                </div>
            </div>
        </div>
    </body>
</html>