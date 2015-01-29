<?php

	class Product extends Eloquent{

		public $timestamps =false;

		protected $table = 'products';

		protected $fillable = array('title','image');



	}


?>