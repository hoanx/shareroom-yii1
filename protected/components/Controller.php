<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
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

    public $loginFormModel;
    public $userRegisterModel;

    public $descriptions = 'Đặt phòng du lịch với giá tốt nhất, Phòng sinh viên, Phòng sinh hoạt chung, phòng chia sẻ';
    public $keywords = 'Phòng chia sẻ,thuê phòng,phòng trọ,khách sạn, nhà nghỉ,du lịch,nghỉ trọ';
    public $title = 'Phòng chia sẻ,thuê phòng,phòng trọ,khách sạn, nhà nghỉ,du lịch,nghỉ trọ';


    protected function afterRender($view, &$output) {
        parent::afterRender($view,$output);
        //Yii::app()->facebook->addJsCallback($js); // use this if you are registering any additional $js code you want to run on init()
       /* Yii::app()->facebook->initJs($output); // this initializes the Facebook JS SDK on all pages
        Yii::app()->facebook->renderOGMetaTags(); // this renders the OG tags*/
        return true;
    }
}