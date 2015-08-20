<?php
class AdminWebUser extends CWebUser
{
    private $_keyPrefix;
    private $_access=array();

    public function isAdmin()
    {
        if($this->getIsGuest())
            return false;

        return true;
    }
}