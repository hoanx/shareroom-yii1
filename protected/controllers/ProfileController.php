<?php

/**
 * Created by ACV.HoaNX.
 * Date: 5/21/15
 */
class ProfileController extends Controller
{
    public function beforeAction($action)
    {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('site/signin'));
        }

        return parent::beforeAction($action);
    }

    public function actionShow($id = null)
    {
        if (is_null($id)) {
            $this->redirect('/');
        }

        $usersModel = Users::model()->findByPk($id, 'del_flg = 0');
        if (!$usersModel) {
            $this->redirect('/');
        }

        $this->render('show', array(
            'usersModel' => $usersModel,
        ));
    }

    public function actionEdit()
    {
        $this->setPageTitle(Yii::t('app', 'Thông tin chi tiết'));
        $user_id = Yii::app()->user->id;
        $usersModel = Users::model()->findByPk($user_id, 'del_flg = 0');

        if (isset($_POST['Users']) && $dataPost = $_POST['Users']) {
            $usersModel->attributes = $dataPost;
            if ($usersModel->save()) {
                Yii::app()->user->setFlash('success', Yii::t('app', 'Cập nhật thông tin thành công!'));
            }
        }

        $this->render('edit', array(
            'usersModel' => $usersModel,
        ));
    }

    public function actionDashboard()
    {
        $this->setPageTitle(Yii::t('app', 'Bảng hoạt động'));
        $user_id = Yii::app()->user->id;
        $usersModel = Users::model()->findByPk($user_id, 'del_flg = 0');

        $this->render('dashboard', array(
            'usersModel' => $usersModel,
        ));
    }

    public function actionMy_Room()
    {
        $this->setPageTitle(Yii::t('app', 'Bài đăng của tôi'));

        $this->render('my_room');
    }

    public function actionMy_Booking()
    {
        $this->setPageTitle(Yii::t('app', 'Đặt chỗ của tôi'));

        $user_id = Yii::app()->user->id;
        $criteria = new CDbCriteria();
        $criteria->compare('del_flg', Constant::DEL_FALSE);
        $criteria->compare('user_id', $user_id);
        $myBookingModel = Booking::model()->findAll($criteria);

        $this->render('my_booking', array(
            'myBookingModel'=>$myBookingModel,
        ));
    }

    public function actionPicture()
    {
        $this->setPageTitle(Yii::t('app', 'Hình ảnh cá nhân'));

        $this->render('picture');
    }

    public function actionBankinfo()
    {
        $this->setPageTitle(Yii::t('app', 'Thông tin ngân hàng'));
        $criteria = new CDbCriteria();
        $criteria->compare('user_id', Yii::app()->user->id);
        $criteria->compare('del_flg', Constant::DEL_FALSE);
        $userBankModel = UsersBank::model()->find($criteria);
        if (!$userBankModel) {
            $userBankModel = new UsersBank();
        }

        if (isset($_POST['UsersBank']) && $dataPost = $_POST['UsersBank']) {
            $userBankModel->attributes = $dataPost;
            if ($userBankModel->save()) {
                Yii::app()->user->setFlash('success', Yii::t('app', 'Cập nhật thông tin ngân hàng thành công!'));
            }
        }

        $this->render('bankinfo', array(
            'userBankModel' => $userBankModel
        ));
    }

    public function actionChangePass()
    {
        $this->setPageTitle(Yii::t('app', 'Thiết lập tài khoản'));
        $user_id = Yii::app()->user->id;
        $changePassModel = new ChangePassword();
        $usersModel = Users::model()->findByPk($user_id, 'del_flg = 0');

        if (isset($_POST['ChangePassword']) && $data = $_POST['ChangePassword']) {
            $changePassModel->password = $usersModel->password;
            $changePassModel->attributes = $data;

            if ($changePassModel->validate()) {
                $usersModel->password = $changePassModel->new_pass;
                if ($usersModel->save(false)) {
                    Yii::app()->user->setFlash('success', Yii::t('app', 'Đổi mật khẩu thành công!'));
                }
            } else {
                $changePassModel->current_pass = $data['current_pass'];
            }
        }

        $this->render('changepass', array(
            'usersModel' => $usersModel,
            'changePassModel' => $changePassModel
        ));
    }

    public function actionImage($id = null)
    {
        if (is_null($id)) {
            $picture_name = md5(Yii::app()->user->id);
        } else {
            $picture_name = md5($id);
        }

        $pathProfilePicture = Yii::app()->basePath . '/..' . Constant::PATH_PROFILE_PICTURE . $picture_name;
        header("Content-Type: image/jpg");

        if (file_exists($pathProfilePicture)) {
            echo file_get_contents($pathProfilePicture);
        } else {
            $pathProfilePicture = Yii::app()->basePath . '/..' . Constant::PATH_PROFILE_PICTURE . 'default_avatar.jpg';
            echo file_get_contents($pathProfilePicture);
        }

        Yii::app()->end();
    }

    public function actionRemoveimage($id = null)
    {
        if (is_null($id)) {
            $picture_name = md5(Yii::app()->user->id);
        } else {
            $picture_name = md5($id);
        }
        $pathProfilePicture = Yii::app()->basePath . '/..' . Constant::PATH_PROFILE_PICTURE . $picture_name;

        if (file_exists($pathProfilePicture)) {
            unlink($pathProfilePicture);
        }

        $this->redirect(array('profile/picture'));
    }

    public function actionUpload()
    {
        $user_id = Yii::app()->user->id;
        $pathProfilePicture = Yii::app()->basePath . '/..' . Constant::PATH_PROFILE_PICTURE . md5($user_id);

        $ext = strtolower(pathinfo($_FILES['avatar-file']['name'], PATHINFO_EXTENSION));

        if(in_array($ext, array('png', 'jpg', 'jpeg'))){
            $source = $_FILES['avatar-file']['tmp_name'];
            $dest = $pathProfilePicture;
            if (!move_uploaded_file($source, $dest)) {
                Yii::app()->user->setFlash('error', Yii::t('app', 'Tải lên hình ảnh thất bại. Vui lòng thử lại!'));
            }
        }else{
            Yii::app()->user->setFlash('error', Yii::t('app', 'Hãy chọn các ảnh có định dạng png, jpg hoặc jpeg.'));
        }

        $this->redirect(array('profile/picture'));


    }

    public function actionBooking($booking_id = null)
    {
        if(is_null($booking_id)){
            $this->redirect(array('profile/my_booking'));
        }


        $this->render('booking');
    }
}