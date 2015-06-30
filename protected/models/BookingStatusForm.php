<?php
class BookingStatusForm extends CFormModel
{
	public $booking_id;
	public $status;
	public $content;
	public $filter_status;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('booking_id, status', 'required', 'on'=>'update_status'),
			array('filter_status', 'safe'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'status'=>'Trạng thái',
			'content'=>'Nội dung',
		);
	}
}