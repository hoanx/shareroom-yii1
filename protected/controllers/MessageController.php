<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/25/15
 */

class MessageController extends Controller
{
    public function actionInbox(){
        $criteria = new CDbCriteria();
        $criteria->condition = 't.del_flg = :del_flg AND (t.from_id = :user_id OR t.to_id = :user_id)';
        
        $criteria->params = array(
            ':del_flg' => Constant::DEL_FALSE,
            ':user_id' => Yii::app()->user->id
        );
        
        $conversations = Conversation::model()->findAll($criteria);
        
        $this->render('inbox', array('conversations' => $conversations));
    }
}