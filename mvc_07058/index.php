<?php
require_once 'controllers/MahasiswaController.php';

$controller = new MahasiswaController();
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'add':
        $controller->add();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        $controller->index();
        break;
}
?>
