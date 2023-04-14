<?php

use Tritonium\Base\App;


/**
 * This is template file
 *
 * @var $data  Array
 * @var $theme Array
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= App::$config->app->name ?></title>

    <link rel="stylesheet" href="<?= WEB_CSS ?>error_handler.light.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="<?= WEB_JS ?>error_handler.js"></script>
</head>
<body>
<div class="title">
    <h1>Another one PHP error...</h1>
</div>
<div class="container ErrLevel<?= $theme['error']['level'] ?>">
    <div class="block">
        <div class="head">
            <span class="errType">[<?= $theme['error']['code'] ?>] <?= $theme['error']['type'] ?></span>
            <span id="HelpMeStack"><a href="https://stackoverflow.com/search?q=[php] <?= $theme['error']['message'] ?>" target="_blank">Help me, Stack Overflow!</a></span>
        </div>
        <div class="head">
            <span><?= $theme['error']['message'] ?></span>
        </div>
        <div class="head" style="color: rgba(255,255,255,0.7)">
            <span>On <?= $theme['file']['name'] ?>:<?= $theme['file']['line'] ?></span>
        </div>
    </div>
    <div class="block">
        <?php
        foreach ($theme['backtrace'] as $index => $step) {
            echo "<div class=\"code\" id=\"file{$index}\">" . PHP_EOL;
            echo $theme['file']['preview'][$index];
            echo "</div>" . PHP_EOL;
        }
        ?>
    </div>
    <div class="block">
        <div class="backtrace">
            <p id="backtraceSwitch"><a href="#">Show/Hide Trace</a></p>
            <div id="backtraceList" style="display: none;">
                <?php
                //TODO: Подсвечивать активный бектрейс
                foreach ($theme['backtrace'] as $index => $step) {
                    if (isset($step['file'])) {
                        echo "<p onclick=\"selectBacktrace({$index})\" class=\"backtraceItem\">
                        <span class=\"file\">{$step['file']}:{$step['line']}</span>
                        <span class=\"index\">{$index} </span>
                        Initiator: {$step['asString']}
                        </p>" . PHP_EOL;
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="variables">
            <div id="varGET">
                <pre>
                <?
                $varString = print_r($theme['variables'], TRUE);

                $varString = preg_replace("/Array\n.*\(/", "[", $varString);
                $varString = preg_replace("/\)\n/", "]", $varString);
                $varString = preg_replace("/\[(.*)\]/mU", "'$1'", $varString);
                $varString = str_replace(["'GET'", "'POST'", "'COOKIE'", "'SESSION'", "'SERVER'"], ["\$_GET", "\$_POST", "\$_COOKIE", "\$_SESSION", "\$_SERVER"], $varString);

                echo $varString;
                ?>
                </pre>
            </div>
        </div>
    </div>
</div>
</body>
</html>