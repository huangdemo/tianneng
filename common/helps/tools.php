<?php

namespace common\helps;

/*
 * 自定义全局公共方法
 */

class tools {

    public static function json($status = '200', $msg = '', $data = []) {
        $result = [
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        ];
        return \yii\helpers\Json::encode($result);
    }

}

?>