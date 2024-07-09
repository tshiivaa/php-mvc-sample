<!-- This is just a view that defines how the page looks. It doesn't do any logic, access the DB, or anything else. It is completely dumb. -->

<h1 style="color: deeppink">
    Hello <?php
    echo is_object($person) ? htmlspecialchars($person->name) : 'Guest'; ?>
</h1>

<p>
    You like everything to
    be <?php echo is_object($person) && isset($person->fav_colour) ? htmlspecialchars($person->fav_colour) : 'unknown'; ?>
    ;)
</p>

<form method="post" action="index.php?action=add">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name">
    <label for="fav_color">Favorite Color:</label>
    <input type="text" name="fav_color" id="fav_color">
    <button type="submit" name="submit_action" value="add">Add Person</button>
    <button type="submit" name="submit_action" value="edit">Edit Person</button>
</form>
