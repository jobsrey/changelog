<?php

namespace jobsrey\changelog;

use yii;
use yii\base\Component;
use jobsrey\changelog\models\ModelChangeLog;

class ChangeLog extends Component
{

	//di gunakan di dalam fungsi afterSave ActiveRecord
	public function saveLogUpdateByOne($attribute,$newData,$oldValue,$status = 2){
		$attributesLabel						= $newData->attributeLabels();
		$changeLogModel 						= new ModelChangeLog; //model change log
		$changeLogModel->status 				= $status;
		$changeLogModel->table_name 			= $newData->tableName();
		$changeLogModel->model_name             = \yii\helpers\StringHelper::basename(get_class($newData));
		$changeLogModel->alias_column_name 		= $attributesLabel[$attribute];
		
		//mencari field primary key
		foreach($newData->primaryKey() as $key => $value){
			$changeLogModel->id_record 				= $newData->{$value};
		}

		$changeLogModel->column_name 			= $attribute;
		$changeLogModel->newvalue 				= $newData->{$attribute};
		$changeLogModel->oldvalue 				= $oldValue[$attribute];
		$changeLogModel->user_id 				= Yii::$app->user->identity->id;
		$changeLogModel->parent_id              = Yii::$app->user->identity->parent_id;
		$changeLogModel->save(false);
	}


	//digunakan untuk informasi saja bukan keterangan update file tapi hanya pesan saja
	public function saveLogMessage($model,$message,$status = 3){
		$attributesLabel						= $model->attributeLabels();
		$changeLogModel 						= new ModelChangeLog; //model change log
		$changeLogModel->status 				= $status;
		$changeLogModel->table_name 			= $model->tableName();
		$changeLogModel->model_name             = \yii\helpers\StringHelper::basename(get_class($model));
		
		//mencari field primary key
		foreach($model->primaryKey() as $key => $value){
			$changeLogModel->id_record 			= $model->{$value};
		}

		$changeLogModel->column_name 			= null;
		$changeLogModel->newvalue 				= $message;
		$changeLogModel->user_id 				= Yii::$app->user->identity->id;
		$changeLogModel->parent_id              = Yii::$app->user->identity->parent_id;
		$changeLogModel->save(false);
	}
}
