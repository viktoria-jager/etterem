<?php
require_once("models/DishModel.php");
require_once("models/DishTypeModel.php");

$dishModel = new DishModel();
$dishTypeModel = new DishTypeModel();

$dishTypes = $dishTypeModel->list();

$topDishesByType = [];
$allDishesByType = [];

foreach ($dishTypes as $type) {
    $topDishesByType[$type['id']] = $dishModel->listActiveByDishType($type['id'], 5);
    $allDishesByType[$type['id']] = $dishModel->listActiveByDishType($type['id']);
}

include "views/index.view.php";
