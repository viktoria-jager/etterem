<?php
require_once("models/DishModel.php");
require_once("models/DishTypeModel.php");

$query = explode("/", $_SERVER["REQUEST_URI"]);

switch ($query[1]) {
    case "":
        
        $dishModel = new DishModel();
        $dishTypeModel = new DishTypeModel();

     
        $dishTypes = $dishTypeModel->list();

        
        $topDishesByType = [];
        foreach ($dishTypes as $dishType) {
            $topDishesByType[$dishType['id']] = $dishModel->listActiveByDishType($dishType['id'], 5);
        }

        
        $allDishesByType = [];
        foreach ($dishTypes as $dishType) {
            $allDishesByType[$dishType['id']] = $dishModel->listActiveByDishType($dishType['id']);
        }

        
        include "views/index.view.php";
        break;

    
}
