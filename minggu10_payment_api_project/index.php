<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';
require __DIR__ . '/db.php';
// redirect to form
header('Location: views/order_form.php');
exit;
?>
