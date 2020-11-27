<?php 


// 8. Создать метод save().
// 9. Метод публичный.
// 10. Метод сохраняет установленные значения name и status в случае, если свойства объекта были изменены извне.
// 11. Класс должен быть задокументирован в стиле PHPDocumentor.

class Item {

	private $id;

	private $name;

	private $status;

	public function __get($name) {

		if (isset($this->$name)) {
			return $this->$name;
		}
	}

	public function __construct() {
		$this->__set('constructedName',$this->name);
		$this->__set('constructedStatus',$this->status);
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

	public function save() {

		$result = 'saved properties: ';
		$name = $this->constructedName;
		$status = $this->constructedStatus;

		if ($this->name !== $name) {
			$name = ' name changed and saved; ';

			$result .= $name;
		}

		if ($this->status !== $status) {
			$status = ' status changed and saved; ';
			$result .= $status;
		}

		return $result;
	}
}
