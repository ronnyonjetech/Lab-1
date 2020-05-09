<?php
	interface Crud {
		public function save();
		public function readAll();
		public function readUnique();
		public function search();
		public function update();
		public function removeOne();
		public function removeAll();
		//this two methods are for lab 2.
		public function valiteForm();
		public function createUserSession();
	}
?>