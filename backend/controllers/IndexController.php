<?php

namespace backend\controllers;
use common\models\AdminColumn;
class IndexController extends \yii\web\Controller
{
	public $layout = false;

    public function actionIndex()
    {	
    	$column = AdminColumn::find()->where(['column_show'=>1])->asArray()->all();
    	$column = AdminColumn::make_tree($column);
        return $this->render('index',['column'=>$column]);
    }

    public function actionLists()
    {
        return $this->render('lists');
    }

}
