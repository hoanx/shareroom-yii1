<?php

class AdminModule extends CWebModule
{
    public $defaultController = 'default';
    public $homeUrl = 'admin/';

    public function init()
    {
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*'
        ));

        Yii::app()->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'admin/default/error',
            ),
            'widgetFactory' => array(
                'widgets' => array(
                    'CGridView' => array(
                        'ajaxUpdate' => false,
                        'pager' => array(
                            'header' => '',
                            'htmlOptions' => array('class' => 'pagination pull-right'),
                            'selectedPageCssClass' => 'active',
                        ),
                        'itemsCssClass' => 'table table-striped',
                        'pagerCssClass' => '',
                        'template' => '<div class="table-responsive">{items}</div>{pager}'
                    )
                )
            )
        ));

        $this->components = array(
            'user' => array(
                'class' => 'AdminWebUser',
                'loginUrl' => Yii::app()->createUrl('admin/default/login'),
                'returnUrl' => Yii::app()->createUrl('admin/default/index'),
            )
        );

        Yii::app()->user->setStateKeyPrefix('_admin');
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            $route = $controller->id . '/' . $action->id;
            $publicPages = array(
                'default/login',
                'default/error',
            );
            if (Yii::app()->getModule("{$this->id}")->user->isGuest && !in_array($route, $publicPages)) {
                /* set the return URL */
                $request = Yii::app()->request->getUrl();
                Yii::app()->getModule("{$this->id}")->user->returnURL = $request;

                /* redirect to module login form */
                Yii::app()->getModule("{$this->id}")->user->loginRequired();
            } else return true;
        } else
            return false;
    }
}