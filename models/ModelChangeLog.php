<?php

namespace jobsrey\changelog\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

class ModelChangeLog extends \yii\db\ActiveRecord
{


    //STATUS
    // 1 => create
    // 2 => update

    public static function tableName()
    {
        return 'change_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['table_name', 'model_name', 'messages'], 'string'],
            [['parent_id', 'user_id', 'is_active', 'created', 'updated', 'createby', 'updateby'], 'integer'],
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
        ];
    }
}
