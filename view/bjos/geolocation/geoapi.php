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
    <h1>GeoLocation API</h1>

    <h3>Följande router finns i detta api:</h3>
    <div class="ApiInstruction">
        <p>
            <code>GET /geoapi</code>
            Visar ett meddelande hur API:t används.
        </p>
        <p>
            <code>POST /geoapi</code>
            Validera ip-address och visa geodata genom att skicka med ip i bodyn<br>
            exempel: {"ip": "8.8.8.8"}
        </p>
    </div>

    <h3>Testroutes</h3>
    <div class="testRoutes">
        <form class="hiddenForm" method="post" action="geoapi">
            <input type="hidden" name="ip" value="8.8.8.8"/>
            <input class="valid" type="submit" name="" value="Validerar"/>
        </form>
        <form class="hiddenForm" method="post" action="geoapi">
            <input type="hidden" name="ip" value="8.8.8.8.8"/>
            <input class="notValid" type="submit" name="" value="Validerar inte"/>
        </form>
    </div>
    <h3>Lokalisera ip med GeoLocation Api</h3>
    <label>Skriv in ip-adress att lokalisera:</label>
    <form class="validateForm" method="post" action="geoapi">
        <input type="text" name="ip" value="<?= $userIp ?>"/>
        <input type="submit" name="" value="Validera"/>
    </form>
</div>
