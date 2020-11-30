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

<div class="validateIp">
    <h1>Väder Data</h1>

    <h3>Följande router finns i detta api:</h3>
    <div class="ApiInstruction">
        <p>
            <code>GET /weatherapi</code><br>
            Visar ett meddelande hur API:t används.
        </p>
        <p>
            <code>POST /weatherapi</code><br>
            Sök väderleksrapport med ip-adress eller koordinater<br>
            Skicka med parametrarna "search" och "weather" i bodyn<br>
            "search" = ip-adress/koordinater(latitud,longitud)<br>
            "weather" = <b>"forecast"</b> visar kommande väder, <b>"history"</b> visar väder 5 dagar bakåt i tiden.<br>
            <br>
            exempel: {"search": "8.8.8.8", "weather": "forecast"}<br>
            exempel: {"search": "8.8.8.8", "weather": "history"}<br>
            exempel: {"search": "67,20", "weather": "forecast"}<br>
            exempel: {"search": "67,20", "weather": "history"}
        </p>
    </div>

    <h3>Testroutes</h3>
    <div class="testRoutes">
        <form class="hiddenForm" method="post" action="weatherapi">
            <input type="hidden" name="search" value="8.8.8.8"/>
            <input type="hidden" name="weather" value="forecast"/>
            <input class="valid" type="submit" name="" value="Rätt ip-adress"/>
        </form>
        <form class="hiddenForm" method="post" action="weatherapi">
            <input type="hidden" name="search" value="10,10"/>
            <input type="hidden" name="weather" value="forecast"/>
            <input class="valid" type="submit" name="" value="Rätt koordinater 'forecast'"/>
        </form>
        <form class="hiddenForm" method="post" action="weatherapi">
            <input type="hidden" name="search" value="10,10"/>
            <input type="hidden" name="weather" value="history"/>
            <input class="valid" type="submit" name="" value="Rätt koordinater 'history'"/>
        </form>
        <form class="hiddenForm" method="post" action="weatherapi">
            <input type="hidden" name="search" value="8.8.8.8.8"/>
            <input type="hidden" name="weather" value="forecast"/>
            <input class="notValid" type="submit" name="" value="Felaktig ip-adress"/>
        </form>
        <form class="hiddenForm" method="post" action="weatherapi">
            <input type="hidden" name="search" value="1000,1000"/>
            <input type="hidden" name="weather" value="forecast"/>
            <input class="notValid" type="submit" name="" value="Felaktiga koordinater"/>
        </form>
    </div>
    <h3>Se väder</h3>

    <form class="validateForm" method="post" action="weatherapi">
        <div class="radioBtn">
            <label for="forecast">Kommande dagar</label>
            <input type="radio" id="forecast" name="weather" checked value="forecast">
        </div>
        <div class="radioBtn">
            <label for="history">Föregående 5 dagar</label>
            <input type="radio" id="history" name="weather" value="history">
        </div>
        <label>Skriv in ip-adress att lokalisera:</label>
        <input type="text" name="search" value="<?= $userIp ?>"/>
        <input type="submit" name="" value="Validera"/>
    </form>
</div>
