<?php 
class Constant {
    const PAGE_SIZE = 50;

    const DEL_TRUE = 1;
    const DEL_FALSE = 0;
    
    const PREFIX_ENCRYPT = 'keyencrypt-';

    static function deleteFlag($status = null) {
        $base = array(
            '' => Yii::t('app', ''),
            self::DEL_FALSE => Yii::t('app', 'Activated'),
            self::DEL_TRUE=> Yii::t('app', 'Deleted')
        );
        return !empty($base[$status]) ? $base[$status] : $base;
    }
    

}