<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AdminController extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
 	public $layout='//layouts/backend';

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public $role;

    /**
     * @param CAction $action
     * @return bool
     */
    public function beforeAction($action) {
        if (Yii::app()->getModule('admin')->user->hasState('language')) {
            Yii::app()->setLanguage(Yii::app()->getModule('admin')->user->getState('language')) ;
        }
        if (Yii::app()->getModule('admin')->user->hasState('role')) {
            $this->role = Yii::app()->getModule('admin')->user->getState('role');
        }
        
        return parent::beforeAction($action);
    }
}