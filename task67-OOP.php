<?php 

// 6. Сделать возможным получение свойств объекта, используя magic methods.
// 7. Сделать возможным задание свойств объекта, используя magic methods с проверкой вводимого значения на заполненность и тип значения. Свойство ID не поддается записи.


class Item {

	private $id;

	private $name;

	public function __get($name) {

		if (isset($this->$name)) {
			return $this->$name;
		}
	}

	public function __set($name,$value) {

		if (is_null($this->$name)) {
			return $this->$name = $value;
		}

		if (is_null($value) || empty($value)) {
			return $name." cant be empty ";
		}

		if (strtolower($name) === 'id' ) {
			return $name.' cant be overwritten ';
		}

		if (gettype($this->$name) !== gettype($value)) {
			return $name.' must be of type: '.gettype($this->$name);
		}

		return $this->$name = $value;	
	}
}
