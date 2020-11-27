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
    <h1>Väder</h1>

    <form class="validateForm" method="get">
        <div class="radioBtn">
            <label for="forecast">Kommande dagar</label>
            <input type="radio" id="forecast" name="weather" checked value="forecast">
        </div>
        <div class="radioBtn">
            <label for="hist">Föregående 5 dagar</label>
            <input type="radio" id="hist" name="weather" value="hist">
        </div>
        <label>Ip-adress eller kommaseparerade koordinater(lat,long):</label>
        <input type="text" name="ip" value="<?= htmlentities($userIp) ?>"/>
        <input type="submit" name="" value="Validera"/>
    </form>
</div>
