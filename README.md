Change Log
==========
Change Log 

Installation
------------

Contoh

```
'components' => [
        ...
        'changelog' => [
            'class' => 'app\components\ChangeLogAsset',
        ],
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
<?= \jobsrey\changelog\AutoloadExample::widget(); ?>
```