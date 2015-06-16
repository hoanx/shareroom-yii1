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

    public function actionPrice($id = null)
    {
        $model=new RoomPrice;

        if(isset($_POST['RoomPrice']))
        {
            $model->attributes=$_POST['RoomPrice'];
            if($model->validate())
            {
                // form inputs are valid, do something here
                return;
            }
        }
        $this->render('price',array('model'=>$model));
    }
}