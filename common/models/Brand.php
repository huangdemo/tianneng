<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * This is the model class for table "brand".
 *
 * @property int $id 主键id
 * @property string $brand_name 品牌名
 * @property string $brand_log 品牌log
 * @property int $sort 排序
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_name', 'brand_log', 'sort'], 'required'],
            [['sort'], 'integer'],
            [['brand_log'], 'file','extensions' => 'png, jpg', 'maxFiles' => 4],
            [['brand_name'], 'string', 'max' => 30],
            [['brand_log'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键id',
            'brand_name' => '品牌名',
            'brand_log' => '品牌log',
            'sort' => '排序',
        ];
    }

   
}
