<?php

namespace jobsrey\changelog\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;


class ModelChangeLog extends \yii\db\ActiveRecord
{

    //dynamic db
    //https://forum.yiiframework.com/t/will-this-work-changing-model-db-on-the-fly/84693/3

    public static $connection;

    //STATUS
    // 1 => create
    // 2 => update

    public static function tableName()
    {
        return 'change_log';
    }

    public static function getDb()
    {

        // return Yii::$app->get($this->getConf());
        return Yii::$app->get(self::$connection);
    }

    public  function setDb($connection)
    {

        self::$connection = $connection;

        return $this;
    }

    public function rules()
    {
        return [
            [['table_name', 'model_name', 'messages'], 'string'],
            [['parent_id', 'user_id', 'is_active', 'created', 'updated', 'createby', 'updateby'], 'integer'],
            [['jns_transaksi'],'string','max'=>'255'],
        ];
    }



    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'createby',
                'updatedByAttribute' => 'updateby',
            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => date('Y-m-d H:i:s'),
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_name' => 'Table Name',
            'model_name' => 'Model Name',
            'messages' => 'Messages',
            'parent_id' => 'Parent ID',
            'user_id' => 'User ID',
            'is_active' => 'Is Active',
            'created' => 'Created',
            'updated' => 'Updated',
            'createby' => 'Createby',
            'updateby' => 'Updateby',
            'jns_transaksi' => 'Jenis Transaksi',
        ];
    }
}
