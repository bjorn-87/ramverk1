<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
//
// if (!is_array($forecast)) {
//     return;
// }
// var_dump($forecast);
?>
<?php if ($type === "forecast") : ?>
<div class="validateIp">
    <h2>Väderleksrapport</h2>
<table>
    <tr class="first">
        <th>Datum</th>
        <th>Lägsta temp</th>
        <th>Högsta temp</th>
        <th>Vind</th>
        <th>Beskrivning</th>
        <!-- <th>Väder</th> -->
    </tr>
    <?php foreach ($forecast as $row) : ?>
        <tr>
            <td><?= htmlentities($row["dt"]) ?></td>
            <td><?= htmlentities($row["temp"]["min"]) ?>&deg;C</td>
            <td><?= htmlentities($row["temp"]["max"]) ?>&deg;C</td>
            <td><?= htmlentities($row["wind_speed"]) ?>m/s</td>
            <td><?= htmlentities($row["weather"][0]["description"]) ?> <img src=" http://openweathermap.org/img/wn/<?= htmlentities($row["weather"][0]["icon"]) ?>@2x.png" alt="image"></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php elseif ($type === "history") : ?>
    <table>
        <tr class="first">
            <th>Datum</th>
            <th>Temp</th>
            <th>Vind</th>
            <th>Beskrivning</th>
        </tr>
        <?php foreach (array_reverse($forecast) as $row) : ?>
            <tr>
                <td><?= htmlentities($row["current"]["dt"]) ?></td>
                <td><?= htmlentities($row["current"]["temp"]) ?>&deg;C</td>
                <td><?= htmlentities($row["current"]["wind_speed"]) ?>m/s</td>
                <td><?= htmlentities($row["current"]["weather"][0]["description"]) ?> <img src=" http://openweathermap.org/img/wn/<?= htmlentities($row["current"]["weather"][0]["icon"]) ?>@2x.png" alt="image"></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php elseif (!$valid) : ?>
    <div class="notValidResult">
        <h3 style="text-align: center;">Not a valid input</h3>
    </div>
<?php else : ?>
    <div class="validResult">
        <h3 style="text-align: center;">No location found</h3>
    </div>
<?php endif; ?>
</div>
