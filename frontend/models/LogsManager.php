<?php

namespace app\models;

/*
 * @author Michael Mutinda
 * @CopyRights HOPE ICT SOLUTIONS
 * 
 */

use yii\base\Model;
use Yii;

class LogsManager extends Model {


    public static function CreateLog($type, $message, $path) {
        date_default_timezone_set("Africa/Nairobi");

        $destinationPath = __DIR__ . $path . date("Y-m-d"); // upload path
        $destinationPath = Yii::getAlias('@webroot') .'/LOGS/'. $path .'/'. date("Y-m-d"); // upload path
        //print_r($destinationPath);die();
        $time = date("H:i:sa");
        if ($type == 'demorequest') {
            $file = 'demorequest.txt';
        } else if ($type == 'dms') {
            $file = 'dms.txt';
        
        } else if($type == 'sms'){
            $file = 'sms.txt';

        } else  {
            $file = 'notfound.txt';
        }
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $data = PHP_EOL . $time . " : " . $message;
        // using the FILE_APPEND flag to append the content to the end of the file
        // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
        file_put_contents($destinationPath . '/' . $file, $data, FILE_APPEND | LOCK_EX);
    }

}
