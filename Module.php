<?php

namespace kouosl\sample;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\web\HttpException;

class Module extends \kouosl\base\Module
{
    public $controllerNamespace = '';
 public function init()
    {
        parent::init();
         // custom initialization code goes here
    }
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        switch ($this->namespace)
        {
            case 'backend':{
             };break;
            case 'frontend':{
             };break;
            case 'api':{
                 $behaviors['authenticator'] = [
                    'class' => CompositeAuth::className(),
                    'authMethods' => [
                        HttpBasicAuth::className(),
                        HttpBearerAuth::className(),
                        QueryParamAuth::className(),
                    ],
                ];
            };break;
            case 'console':{
             };break;
            default:{
                throw new HttpException(500,'behaviors'.$this->namespace);
            };break;
        }
         return $behaviors;
     }
     public function registerTranslations()
    {
        Yii::$app->i18n->translations['site/*'] = [
@@ -63,7 +27,6 @@ public function registerTranslations()
            ],
        ];
    }
     public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('sample/' . $category, $message, $params, $language);
@@ -80,15 +43,7 @@ public static function initRules(){
                'tokens' => [
                    '{id}' => '<id:\\w+>'
                ],
                /*'patterns' => [
                    'GET new-action' => 'new-action'
                ]*/
            ],
         ] ;
     }
 }
