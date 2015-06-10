<?php
/**
 * Created by HoaNguyen.
 * Date: 5/24/15
 */

class RoomsController extends Controller
{
    public function actionIndex(){

    }


    public function actionNew(){
        $this->setPageTitle(Yii::t('app', 'Đăng tin cho thuê'));

        $model = new RoomAddress();

        $this->render('new', array(
            'model' => $model,
        ));

    }
}