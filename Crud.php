<?php
//we create the interface
interface Crud{
	/*all this methods have to be implemented by any class that uses this interface*/
	public function save();
	public function readAll();
	public function readUnique();
	public function search();
	public function update();
	public function removeOne();
	public function removeAll();
}
?>