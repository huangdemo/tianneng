<?php

namespace backend\controllers;

class BrandController extends \yii\web\Controller
{
	public $layout = false;
	
    public function actionLists()
    {
        return $this->render('lists');
    }

}
