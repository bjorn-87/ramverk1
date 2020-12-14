<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToCreate = url("book/create");
$urlToDelete = url("book/delete");
?>
<br>
<img src="image/books/bocker.jpg?a=50,0,0,0&sharpen" class="" alt="Böcker">

<h1>Alla Böcker</h1>

<p>
    <a href="<?= $urlToCreate ?>">Lägg till</a> |
    <a href="<?= $urlToDelete ?>">Ta bort</a>
</p>

<?php if (!$items) : ?>
    <p>There are no items to show.</p>
<?php
    return;
endif;
?>

<table class="table">
    <tr>
        <th class="first">Id</th>
        <th>Titel</th>
        <th>Beskrivning</th>
        <th>Författare</th>
        <th>Bild</th>
    </tr>
    <?php foreach ($items as $item) : ?>
    <tr>
        <td class="first">
            <a href="<?= url("book/update/{$item->id}"); ?>"><?= $item->id ?></a>
        </td>
        <td><?= $item->title ?></td>
        <td class="wrapping"><?= $item->description ?></td>
        <td><?= $item->author ?></td>
        <td><img src="<?= $item->image ?>" class="bookImage" alt="<?= $item->image ?>"></td>
    </tr>
    <?php endforeach; ?>
</table>
