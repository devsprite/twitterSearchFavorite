<?php
class Name extends Eloquent{
    protected $guarded = array();

	/*public static $timestamps = false;*/

	public function tweets(){
		return $this->has_many('tweet');
	}

}