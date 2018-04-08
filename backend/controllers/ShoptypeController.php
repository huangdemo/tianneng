<?php

namespace backend\controllers;

class ShoptypeController extends \yii\web\Controller
{
	public $layout = false;

    public function actionLists()
    {
        return $this->render('lists');
    }

}
