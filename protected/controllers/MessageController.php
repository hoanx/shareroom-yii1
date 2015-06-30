<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/25/15
 */

class MessageController extends Controller
{
    protected function beforeAction($action) {
        if(!Yii::app()->user->id) {
            $this->redirect(Yii::app()->homeUrl);
        }
    
        return parent::beforeAction($action);
    }
    
    public function actionInbox(){
        $criteria = new CDbCriteria();
        $criteria->condition = 't.del_flg = :del_flg AND (t.from_id = :user_id OR t.to_id = :user_id)';
        
        if(isset($_GET['read_flg']) && $_GET['read_flg'] == 2) {
            $criteria->condition .= ' AND read_flg = 1';
        } elseif(isset($_GET['read_flg']) && $_GET['read_flg'] == 3) {
            $criteria->condition .= ' AND read_flg = 0';
        }
        
        $criteria->params = array(
            ':del_flg' => Constant::DEL_FALSE,
            ':user_id' => Yii::app()->user->id
        );
        
        $conversations = Conversation::model()->findAll($criteria);
        
        $this->render('inbox', array('conversations' => $conversations));
    }
    
    public function actionView($id = null){
        $conversation = Conversation::model()->findByPk($id);

        if(empty($conversation)) {
            $this->redirect(array('inbox'));
        }
        
        $conversation->read_flg = 1;
        $conversation->save();
    
        $newMessage = new Messages();
        
        if(isset($_POST['Messages'])) {
            $newMessage->attributes  = $_POST['Messages'];
            $newMessage->conversation_id = $conversation->id;
            $newMessage->message_type = Messages::MESSAGE_DEFAULT;
            $newMessage->from_user_id = Yii::app()->user->id;
            $newMessage->status_flg = 0;
        
            if($newMessage->validate()) {
                $newMessage->save();
                $newMessage = new Messages();
                
                $conversation->read_flg = 0;
                $conversation->save();
            }
        }
        
        $messages = Messages::model()->findAllByAttributes(array('conversation_id' => $id));
        
        $this->render('view', array('conversation' => $conversation, 'messages' => $messages, 'newMessage' => $newMessage));
    }
}