<?php

namespace backend\controllers;
use Yii;
use yii\web\UploadedFile;
use common\models\Brand;
class BrandController extends \yii\web\Controller
{
	public $layout = false;

	public function init()
    {
        $this->enableCsrfValidation = false;
    }

    public function actionLists()
    {
        $brand = Brand::find()->all();
        return $this->render('lists',['brand'=>$brand]);
    }

    public function actionAdd()
    {
    	//首先判断是否是POST提交，不是post提交的输出4
        if(\Yii::$app->request->isPost) {
            //接收图片的信息值
            $image = UploadedFile::getInstanceByName('brand_log');
            if (!$image) {
            	return $this->redirect('lists',['error'=>'没有文件上传']);
            }
            //可以打印看看
            //上传目录，进行命名
            $dir='upload/'.date('Ymd').'/';
           	if (!is_dir($dir)) {
           		@mkdir($dir);
           	}
            //这个文件要创建到web的目录下
            $name = explode(".", $image->name);
            $name = end($name);
            $name = time().rand(1000,9999).'.'.$name;
            //文件的绝对路径
            // $name = $dir.$image->name;
            $name = $dir.$name;
            //保存文件函数，在手册上有，将图片保存到本地
            $status = $image->saveAs($name,true);
            //这个打印出来的是1！！
            //进行判断,保存本地失败，输出3
            if ($status) {
                //实例化model层，model层用GII创建，否则报错
                $model = new Brand();
                //定义将添加的图片路径
                $model->brand_log=$name;
 				//调用model层attributes方法，将post接值数据一起（这是将表单中的其他值接受过来，一起入库使的）
               	$model->attributes = \Yii::$app->request->post();
                //$moell->save 等同与 $model->insert();
                //进行判断，如果添加成功，将进行提示跳转
                if ($model->save() && $model->validate())
                {
                    //成功  输出1
                    return $this->redirect('lists');
                }else{
                    return $this->redirect('lists',['error'=>'添加失败']);
                }

            }else{
                  return $this->redirect('lists',['error'=>'Log上传失败']);
            }

        }else{
            return $this->redirect('lists',['error'=>'提交有误']);
        }

    }
}