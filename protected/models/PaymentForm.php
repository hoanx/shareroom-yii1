<?php

class PaymentForm extends CFormModel
{
	public $checkin;
	public $checkout;
	public $number_of_guests;
	public $room_address_id;

    public $number_night;
    public $min_night;
    public $max_night;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('checkin, checkout, number_of_guests, room_address_id', 'required'),
			array('number_night, min_night, max_night', 'safe'),
            array('number_night', 'requiredMinNight'),
            array('number_night', 'requiredMaxNight'),
		);
	}

    public function requiredMinNight($attribute_name, $params)
    {
        if($this->$attribute_name < $this->min_night){
            $this->addError($attribute_name, Yii::t('app', "Số đêm tối thiểu {min_night} đêm.", array(
                '{min_night}' => $this->min_night
            )));
            return false;
        }
        return true;
    }

    public function requiredMaxNight($attribute_name, $params)
    {
        if($this->$attribute_name > $this->max_night){
            $this->addError($attribute_name, Yii::t('app', "Số đêm tối đa {max_night} đêm.", array(
                '{max_night}' => $this->max_night
            )));
            return false;
        }
        return true;
    }
}