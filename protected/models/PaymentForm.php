<?php

class PaymentForm extends CFormModel
{
	public $checkin;
	public $checkout;
	public $number_of_guests;
	public $room_address_id;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('checkin, checkout, number_of_guests, room_address_id', 'required'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
}