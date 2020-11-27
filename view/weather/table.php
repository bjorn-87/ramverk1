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
    <?php foreach ($forecast as $key => $value) : ?>
        <tr>
            <td><?= htmlentities($value["date"]) ?></td>
            <td><?= htmlentities($value["temp_min"]) ?>&deg;C</td>
            <td><?= htmlentities($value["temp_max"]) ?>&deg;C</td>
            <td><?= htmlentities($value["wind_speed"]) ?>m/s</td>
            <td><?= htmlentities($value["weather"]) ?> <img src=" http://openweathermap.org/img/wn/<?= htmlentities($value["icon"]) ?>@2x.png" alt="image"></td>
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
        <?php
        array_reverse($forecast);
        foreach ($forecast as $key => $value) : ?>
            <tr>
                <td><?= htmlentities($value["date"]) ?></td>
                <td><?= htmlentities($value["temp"]) ?>&deg;C</td>
                <td><?= htmlentities($value["wind_speed"]) ?>m/s</td>
                <td><?= htmlentities($value["weather"]) ?> <img src=" http://openweathermap.org/img/wn/<?= htmlentities($value["icon"]) ?>@2x.png" alt="image"></td>
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
