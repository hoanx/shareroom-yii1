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

        $this->render('index');
    }

    public function actionDashboard()
    {
        $user_id = Yii::app()->user->id;
        $usersModel = Users::model()->findByPk($user_id);

        //download profile picture
        $pathProfilePicture =  Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . Constant::PATH_PROFILE_PICTURE.md5($user_id);
        Common::download_profile_picture($usersModel->profile_picture, $pathProfilePicture);

        $picture = file_get_contents($pathProfilePicture);
        echo $picture;

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
}