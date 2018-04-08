<?php

namespace backend\controllers;

use common\models\AdminColumn;
use Yii;

class ColumnController extends BaseController
{
    public function init()
    {
        $this->enableCsrfValidation = false;
    }
    public function actionLists()
    {
        $column = AdminColumn::find()->where(['column_show' => 1])->orderBy('column_sort asc')->asArray()->all();
        $column = AdminColumn::subTree($column);
        return $this->renderPartial('lists', ['column' => $column]);
    }

    public function actionAdd()
    {
        $request = Yii::$app->request;
        if ($request->isGet) {
            $column = AdminColumn::find()->where(['column_show' => 1])->asArray()->all();
            $column = AdminColumn::subTree($column);
            return $this->renderPartial('add', ['column' => $column]);

        } else {
            $post   = $request->post();
            $column = new AdminColumn;
            $column->load($post, ''); //批量插入
            if ($column->validate() && $column->save()) {
                return \common\helps\tools::json('200', '成功');
            } else {
                return \common\helps\tools::json('400', $this->getErrors($column->getFirstErrors()));
            }
        }
    }

    public function actionEdit()
    {
        $request = Yii::$app->request;
        if ($request->isGet) {
            $id = $request->get('column_id');
            $column = AdminColumn::find()->where(['column_id'=>$id])->asArray()->one();
            return $this->renderPartial('edit',['column'=>$column]);
        }else{
            $post = $request->post();
            $column = AdminColumn::find()->where(['column_id'=>$post['column_id']])->one();
            $column -> column_show = $post['column_show'];
            $column -> column_name = $post['column_name'];
            $column -> column_action = $post['column_action'];
            $column -> column_sort = $post['column_sort'];
            $column -> column_data = $post['column_data'];
            $column -> column_module = $post['column_module'];
            if ($column -> save()) {
                return \common\helps\tools::json('200', '成功');
            }else{
                return \common\helps\tools::json('400', $this->getErrors($column->getFirstErrors()));

            }
        }
    }

    public function actionDelete()
    {
        $request = Yii::$app->request;
        $id = $request ->post('column_id');
        $column = AdminColumn::find()->where(['column_id'=>$id])->one();
        if ($column -> delete()) {
             return \common\helps\tools::json('200', '成功');
        }else{
             return \common\helps\tools::json('400', $this->getErrors($column->getFirstErrors()));
            
        }
       
    }
}
