Change Log
==========


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist jobsrey/yii2-changelog "*"
```

or add

```
"jobsrey/yii2-changelog": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :


```php

'components' => [
        ...
        'changelog' => [
            'class' => 'jobsrey\changelog\ChangeLog',
        ],
```

on model

```php

class Users extends \yii\db\ActiveRecord
{

    public $old_attr; //old atribute


    ...

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if($insert){ //save log insert            
            Yii::$app->changelog->saveLogMessage($this, $this->username.' telah dibuat!',1);
        } else { //save log update
            foreach($changedAttributes as $attr => $value){
                Yii::$app->changelog->saveLogUpdateByOne($attr,$this,$this->old_attr);
            }
        }

        return true;
    }

    public function afterFind(){

        parent::afterFind();
        
        $this->old_attr = $this->getAttributes(); //add to compare data
    }

}



```

keterangan status

1. insert
2. update
3. delete
4. only info