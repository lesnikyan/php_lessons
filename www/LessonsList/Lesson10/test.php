<?php

include '../common.php';
include 'user.db.php';

$db = new UserDB();

//$updatedCount = $db->update(3, ['name' => 'User3 Userovich']);
//p("updated $updatedCount rows");

// $updatedCount = $db->delete(7);
// p("deleted $updatedCount rows");

$users = $db->parent()->select("SELECT id, login FROM `users` id = ? ;", array(2));

pr($users);

