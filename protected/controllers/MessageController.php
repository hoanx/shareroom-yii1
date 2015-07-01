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
            $criteria->join = 'INNER JOIN tb_messages ON tb_messages.conversation_id = t.id AND tb_messages.read_flg = 1 AND tb_messages.to_user_id = ' . Yii::app()->user->id;
            $criteria->group = 't.id';
        } elseif(isset($_GET['read_flg']) && $_GET['read_flg'] == 3) {
            $criteria->join = 'INNER JOIN tb_messages ON tb_messages.conversation_id = t.id AND tb_messages.read_flg = 0 AND tb_messages.to_user_id = ' . Yii::app()->user->id;
            $criteria->group = 't.id';
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
        
        $newMessage = new Messages();
        
        if(isset($_POST['Messages'])) {
            $newMessage->attributes  = $_POST['Messages'];
            $newMessage->conversation_id = $conversation->id;
            $newMessage->message_type = Messages::MESSAGE_DEFAULT;
            $newMessage->from_user_id = Yii::app()->user->id;
            $newMessage->to_user_id = ($conversation->to_id == Yii::app()->user->id) ? $conversation->from_id : $conversation->to_id;
            $newMessage->read_flg = 0;
            $newMessage->status_flg = 0;
        
            if($newMessage->validate()) {
                $newMessage->save();
                $newMessage = new Messages();
            }
        }
        
        $messages = Messages::model()->findAllByAttributes(array('conversation_id' => $id));
        
        Messages::model()->updateAll(array('read_flg' => 1),'conversation_id = :conversation_id AND to_user_id = :to_user_id', 
                array(':conversation_id' => $conversation->id, ':to_user_id' => Yii::app()->user->id));
        
        $this->render('view', array('conversation' => $conversation, 'messages' => $messages, 'newMessage' => $newMessage));
    }
}