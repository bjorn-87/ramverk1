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
    <h1>Json API</h1>

    <h3>Följande router finns i detta JSON api:</h3>
    <div class="ApiInstruction">
        <p>
            <code>GET /ip-json</code>
            Visar ett meddelande hur API:t används.
        </p>
        <p>
            <code>POST /ip-json</code>
            Validera ip-address genom att skicka med ip i bodyn<br>
            exempel: {"ip": "8.8.8.8"}
        </p>
    </div>

    <h3>Testroutes</h3>
    <div class="testRoutes">
        <form class="hiddenForm" method="post" action="ip-json">
            <input type="hidden" name="ip" value="8.8.8.8"/>
            <input class="valid" type="submit" name="" value="Validerar"/>
        </form>
        <form class="hiddenForm" method="post" action="ip-json">
            <input type="hidden" name="ip" value="8.8.8.8.8"/>
            <input class="notValid" type="submit" name="" value="Validerar inte"/>
        </form>
    </div>
    <h3>Validera IP med json-api</h3>
    <label>Skriv in ip-adress att validera:</label>
    <form class="validateForm" method="post" action="ip-json">
        <input placeholder="ex. 1.1.1.1" type="text" name="ip" value=""/>
        <input type="submit" name="" value="Validera"/>
    </form>
</div>
