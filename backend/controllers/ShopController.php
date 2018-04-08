<?php

namespace backend\controllers;

class ShopController extends \yii\web\Controller
{
	public $layout = false;

    public function actionLists()
    {
        return $this->render('lists');
    }

    public function actionAdd()
    {
        return $this->render('add');
    }

}
