<?php 
class Constant {
    const PAGE_SIZE = 50;

    const DEL_TRUE = 1;
    const DEL_FALSE = 0;
    
    const PREFIX_ENCRYPT = 'keyencrypt-';
    const DEFAULT_PASSWORD = 'shareroom.vn';

    const PATH_PROFILE_PICTURE = '/uploads/users_profile/';

    const GUEST_MAX = 16;

    static function deleteFlag($status = null) {
        $base = array(
            '' => Yii::t('app', ''),
            self::DEL_FALSE => Yii::t('app', 'Activated'),
            self::DEL_TRUE=> Yii::t('app', 'Deleted')
        );
        return !empty($base[$status]) ? $base[$status] : $base;
    }

    static function listGuests($idGuests = null){
        for($i=1; $i <= self::GUEST_MAX; $i++){
            $base[$i] = Yii::t('app', '{number} Khách', array('{number}'=>$i));
        }

        return !empty($base[$idGuests]) ? $base[$idGuests] : $base;
    }

    /**
     * check exists profile picture by md5 user id
     *
     * @param null $user_id_encode
     * @return bool
     */
    public static function checkProfilePicture($user_id_encode = null){
        if(is_null($user_id_encode)) return false;

        $pathProfilePicture =  Yii::app()->basePath . '/..' . Constant::PATH_PROFILE_PICTURE.$user_id_encode;

        return file_exists($pathProfilePicture);

    }
    

}