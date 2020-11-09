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
    <h1>Validera IP</h1>

    <form class="validateForm" method="get">
        <label>Skriv in ip-adress att validera:</label>
        <input placeholder="ex. 1.1.1.1" type="text" name="ip" value=""/>
        <input type="submit" name="" value="Validera"/>
    </form>
    <?php if ($valid === "True") : ?>
        <div class="validResult">
            <p>ip: <?= htmlentities($ip) ?></p>
            <p>Validerar: <?= $valid ?></p>
            <p>Typ: <?= $type ?></p>
            <p>Host: <?= $host ?></p>
        </div>
        <div class="resetBtn">
            <a href="?">Återställ</a>
        </div>
    <?php elseif ($valid === "False") : ?>
        <div class="notValidResult">
            <p>ip: <?= htmlentities($ip) ?></p>
            <p>Validerar: <?= $valid ?></p>
        </div>
        <div class="resetBtn">
            <a href="?">Återställ</a>
        </div>
    <?php endif; ?>
</div>
