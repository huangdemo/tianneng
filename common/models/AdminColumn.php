<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "admin_column".
 *
 * @property int $column_id 栏目id
 * @property string $column_name 栏目名
 * @property int $column_pid 对应栏目id
 * @property string $column_action 方法
 * @property string $column_module 所用控制器
 * @property string $column_data 所带参数
 * @property int $column_show 是否显示
 * @property int $column_sort 排序
 */
class AdminColumn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_column';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['column_name', 'column_pid', 'column_module', 'column_show', 'column_sort'], 'required'],
            [['column_pid', 'column_show', 'column_sort'], 'integer'],
            [['column_name', 'column_action', 'column_module', 'column_data'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
      return [
            'column_id' => '栏目id',
            'column_name' => '栏目名',
            'column_pid' => '对应栏目id',
            'column_action' => '方法',
            'column_module' => '所用控制器',
            'column_data' => '所带参数',
            'column_show' => '是否显示',
            'column_sort' => '排序',
        ];
    }

        /**
     * 递归，查找子孙树
     * @param array $arr
     * @param int $id
     * @param int $lev
     * @return array
     */
    public static function subTree($arr, $id = 0, $lev = 1)
    {
        $subs = [];
        foreach ($arr as $v) {
            if ($v['column_pid'] == $id) {
                $v['lev'] = $lev;
                $subs[]   = $v;
                $subs     = array_merge($subs, self::subTree($arr, $v['column_id'], $lev + 1));
            }
        }

        return $subs;
    }

    public static function tree()
    {
        $cats = Column::find()->select(['pid as pId', 'id', 'name', 'sort','url'])->asArray()->all();
        return self::subTree($cats, 0, 1);
    }


    //前台输出
    public static function make_tree($arr)
    {
        $refer = array();
        $tree  = array();
        foreach ($arr as $k => $v) {
            $refer[$v['column_id']] = &$arr[$k]; //创建主键的数组引用
        }
        foreach ($arr as $k => $v) {
            $pid = $v['column_pid']; //获取当前分类的父级id
            if ($pid == 0) {
                $tree[] = &$arr[$k]; //顶级栏目
            } else {
                if (isset($refer[$pid])) {
                    $refer[$pid]['subcat'][] = &$arr[$k]; //如果存在父级栏目，则添加进父级栏目的子栏目数组中
                }
            }
        }
        return $tree;
    }
}