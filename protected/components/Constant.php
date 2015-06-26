<?php
class Constant {
    const PAGE_SIZE = 50;

    const DEL_TRUE = 1;
    const DEL_FALSE = 0;

    const PREFIX_ENCRYPT = 'keyencrypt-';
    const DEFAULT_PASSWORD = 'shareroom.vn';

    const PATH_PROFILE_PICTURE = '/uploads/users_profile/';
    const PATH_UPLOAD_PICTURE = '/uploads/rooms/';

    const GUEST_MAX = 16;

    const BEDROOMS_MAX = 10;

    const BEDS_MAX = 16;
    
    const MAX_DISTANCE = 20;

    const AMENITIES_SMOKING_ALLOWED = 'smoking_allowed';
    const AMENITIES_PETS_ALLOWED = 'pets_allowed';
    const AMENITIES_TV = 'tv';
    const AMENITIES_INTERNET = 'internet';
    const AMENITIES_AIR_CONDITIONING = 'air_conditioning';
    const AMENITIES_ELEVATOR_IN_BUILDING = 'elevator_in_building'; // Thang may
    const AMENITIES_HANDICAP_ACCESSIBLE = 'handicap_accessible'; // Thich hop voi nguoi tan tat
    const AMENITIES_POOL = 'pool'; // Be boi
    const AMENITIES_KITCHEN = 'kitchen'; // Bep
    const AMENITIES_PARKING = 'parking'; // cho do xe
    const AMENITIES_WASHER = 'washer'; // May Giat
    const AMENITIES_GYM = 'gym';
    const AMENITIES_HOT_TUB = 'hot_tub'; // Bon tam nuoc nong
    const AMENITIES_BREAKFAST = 'breakfast'; // Bua sang
    const AMENITIES_KID = 'kid'; // tre em

    const ROOM_TYPE_ENTIRE_HOME = 'entire_home'; // Toan bo nha
    const ROOM_TYPE_PRIVATE_ROOM = 'private_room'; // Phong rieng
    const ROOM_TYPE_SHARE_ROOM = 'share_room'; // Phong chia se

    const CANCELLATION_FLEXIBILITY = 1;
    const CANCELLATION_MEDIUM = 2;
    const CANCELLATION_STRICT = 3;

    const MIN_NIGHTS = 30;
    const MAX_NIGHTS = 180;

    const MIN_IMAGE_ROOM = 6;
    const MIN_LEN_ROOM_NAME = 20;
    const MIN_LEN_ROOM_DESCRIPTION = 400;

    const DATE_FORMAT = 'dd-mm-yyyy';


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
            if(self::GUEST_MAX==$i){
                $base[$i] = Yii::t('app', '{number}+ Khách', array('{number}'=>$i));
            }else{
                $base[$i] = Yii::t('app', '{number} Khách', array('{number}'=>$i));
            }
        }

        return !empty($base[$idGuests]) ? $base[$idGuests] : $base;
    }

    static function listBedRooms($id = null){
        for($i=1; $i <= self::BEDROOMS_MAX; $i++){
            $base[$i] = Yii::t('app', '{number} Phòng ngủ', array('{number}'=>$i));
        }

        return !empty($base[$id]) ? $base[$id] : $base;
    }

    static function listBeds($id = null){
        for($i=1; $i <= self::BEDS_MAX; $i++){
            if(self::BEDS_MAX==$i){
                $base[$i] = Yii::t('app', '{number}+ Giường', array('{number}'=>$i));
            }else{
                $base[$i] = Yii::t('app', '{number} Giường', array('{number}'=>$i));
            }
        }

        return !empty($base[$id]) ? $base[$id] : $base;
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

    public static function getRoomType($type = null){
        $base = array(
            self::ROOM_TYPE_ENTIRE_HOME => Yii::t('app', 'Cả căn hộ'),
            self::ROOM_TYPE_PRIVATE_ROOM => Yii::t('app', 'Phòng riêng'),
            self::ROOM_TYPE_SHARE_ROOM => Yii::t('app', 'Phòng chia sẻ'),
        );

        return !empty($base[$type]) ? $base[$type] : $base;
    }

    public static function getAmenities($value = null){
        $base = array(
            self::AMENITIES_SMOKING_ALLOWED => Yii::t('app', 'Được hút thuốc'),
            self::AMENITIES_PETS_ALLOWED => Yii::t('app', 'Cho phép vật nuôi'),
            self::AMENITIES_TV => Yii::t('app', 'TV'),
            self::AMENITIES_INTERNET => Yii::t('app', 'Internet'),
            self::AMENITIES_AIR_CONDITIONING => Yii::t('app', 'Điều hoà'),
            self::AMENITIES_ELEVATOR_IN_BUILDING => Yii::t('app', 'Thang máy'),
            self::AMENITIES_HANDICAP_ACCESSIBLE => Yii::t('app', 'Thích hợp cho người tàn tật'),
            self::AMENITIES_POOL => Yii::t('app', 'Bể bơi'),
            self::AMENITIES_KITCHEN => Yii::t('app', 'Bếp'),
            self::AMENITIES_PARKING => Yii::t('app', 'Chỗ đỗ xe'),
            self::AMENITIES_WASHER => Yii::t('app', 'Máy giặt'),
            self::AMENITIES_GYM => Yii::t('app', 'GYM'),
            self::AMENITIES_HOT_TUB => Yii::t('app', 'Bồn tắm nước nóng'),
            self::AMENITIES_BREAKFAST => Yii::t('app', 'Bữa sáng'),
            self::AMENITIES_KID => Yii::t('app', 'Trẻ em dưới 6 tuổi'),
        );

        return !empty($base[$value]) ? $base[$value] : $base;
    }

    public static function getCancellation($type = null){
        $base = array(
            self::CANCELLATION_FLEXIBILITY => Yii::t('app', 'Linh hoạt: Trả 100%, trừ phí dịch vụ nếu hủy ít nhất 1 ngày trước ngày đến'),
            self::CANCELLATION_MEDIUM => Yii::t('app', 'Trung bình: Trả 100%, trừ phí dịch vụ nếu hủy ít nhất 5 ngày trước ngày đến'),
            self::CANCELLATION_STRICT => Yii::t('app', 'Nghiêm ngặt: Trả 50%, trừ phí dịch vụ nếu hủy ít nhất 1 tuần trước ngày đến'),
        );

        return !empty($base[$type]) ? $base[$type] : $base;
    }

    public static function getCancellationShort($type = null){
        $base = array(
            self::CANCELLATION_FLEXIBILITY => Yii::t('app', 'Linh hoạt'),
            self::CANCELLATION_MEDIUM => Yii::t('app', 'Trung bình'),
            self::CANCELLATION_STRICT => Yii::t('app', 'Nghiêm ngặt'),
        );

        return !empty($base[$type]) ? $base[$type] : $base;
    }

    public static function getMinNights($value = null){
        for($i=1; $i <= self::MIN_NIGHTS; $i++){
            $base[$i] = $i;
        }

        return !empty($base[$value]) ? $base[$value] : $base;
    }

    public static function getMaxNights($value = null){
        for($i=1; $i <= self::MAX_NIGHTS; $i++){
            $base[$i] = $i;
        }

        return !empty($base[$value]) ? $base[$value] : $base;
    }

    public static function getTimeCheck($value = null){
        for($i=0; $i < 24; $i++){
            $base[$i] = Yii::t('app', '{number}:00', array('{number}'=>$i));
            /*if($i < 12){
                $base[$i] = Yii::t('app', '{number} AM', array('{number}'=>$i));
            }else{

            }*/

        }

        return !empty($base[$value]) ? $base[$value] : $base;

    }

}