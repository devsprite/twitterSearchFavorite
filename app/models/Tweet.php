<?php
class Tweet extends Eloquent{
    protected $guarded = array();

	/*public static $timestamps = false;*/

	public function name(){
		return $this->belongs_To('name');
	}

}