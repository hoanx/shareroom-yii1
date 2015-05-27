<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/21/15
 */

class ProfileController extends Controller
{
    public function beforeAction($action){
        if(Yii::app()->user->isGuest){
            $this->redirect(array('site/signin'));
        }

        return parent::beforeAction($action);
    }
    public function actionIndex()
    {
        $this->actionEdit();
    }

    public function actionEdit()
    {
        $user_id = Yii::app()->user->id;
        $usersModel = Users::model()->findByPk($user_id);

        if(isset($_POST['Users']) && $dataPost = $_POST['Users']){
            $usersModel->attributes = $dataPost;
            if($usersModel->save()){
                Yii::app()->user->setFlash('success', Yii::t('app', 'Cập nhật thông tin thành công!'));
            }
        }

        $this->render('edit', array(
            'usersModel' => $usersModel,
        ));
    }

    public function actionDashboard()
    {
        $user_id = Yii::app()->user->id;
        $usersModel = Users::model()->findByPk($user_id);

        $this->render('dashboard', array(
            'usersModel' => $usersModel,
        ));
    }
    public function actionMy_Room()
    {

        $this->render('my_room');
    }
    public function actionMy_Booking()
    {
        $this->render('my_booking');
    }

    public function actionPicture()
    {

        $this->render('picture');
    }
    public function actionChangePass()
    {

        $this->render('changepass');
    }

    public function actionImage($id = null){
        if(is_null($id)){
            $picture_name = md5(Yii::app()->user->id);
        }
        $pathProfilePicture =  Yii::app()->basePath . '/..' . Constant::PATH_PROFILE_PICTURE.$picture_name;
        header("Content-Type: image/jpg");

        if(file_exists($pathProfilePicture)){
            echo file_get_contents($pathProfilePicture);
        }else{
            $pathProfilePicture = Yii::app()->basePath . '/..' . Constant::PATH_PROFILE_PICTURE.'default_avatar.jpg';
            echo file_get_contents($pathProfilePicture);
        }

        Yii::app()->end();
    }
}