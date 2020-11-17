<?php

namespace Anax\View;

/**
 * Render content within an article.
 */
// echo $valid;
// echo $host;
// echo $type;
// echo showEnvironment(get_defined_vars(), get_defined_functions());
?>

<div class="validateIp">
    <h1>Lokalisera IP</h1>

    <form class="validateForm" method="get">
        <label>Skriv in ip-adress att lokalisera:</label>
        <input type="text" name="ip" value="<?= htmlentities($userIp) ?>"/>
        <input type="submit" name="" value="Validera"/>
    </form>
    <?php if ($valid) : ?>
        <div class="validResult">
            <h4>Validerar!</h4>
            <p><b>IP:</b> <?= htmlentities($ip) ?></p>
            <p><b>Typ:</b> <?= $type ?></p>
            <p><b>Host:</b> <?= $host ?></p>
            <p><b>Kontinent:</b> <?= htmlentities($location["continent_name"]) ?></p>
            <p><b>Land:</b> <?= htmlentities($location["country_name"]) ?></p>
            <p><b>Ort:</b> <?= htmlentities($location["city"]) ?></p>
            <p><b>Postkod:</b> <?= htmlentities($location["zip"]) ?></p>
            <p><b>Latitude:</b> <?= htmlentities($location["latitude"]) ?></p>
            <p><b>Longitude:</b> <?= htmlentities($location["longitude"]) ?></p>
            <p><a href="<?= htmlentities($mapLink) ?>">Kartlänk</a></p>
            <img class="countryFlag" src="<?= htmlentities($location["location"]["country_flag"]) ?>"/>
        </div>
        <div class="resetBtn">
            <a href="?">Återställ</a>
        </div>
    <?php elseif (!$valid && isset($ip)) : ?>
        <div class="notValidResult">
            <h4>Validerar inte</h4>
            <p><b>ip:</b> <?= htmlentities($ip) ?></p>
        </div>
        <div class="resetBtn">
            <a href="?">Återställ</a>
        </div>
    <?php endif; ?>
</div>
