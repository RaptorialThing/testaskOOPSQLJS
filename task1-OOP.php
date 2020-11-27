<?php 
// 1. Создать класс Item, который не наследуется. В конструктор класса передается ID объекта.

class ItemsStorage {
	static private $items;

	static public function getItemById($id) {
		return self::$items[$id];
	}

	static public function setItemWithId($id,$obj) {
		self::$items[$id] = $obj;
	}

	public function getAllItems() {
		return self::$items;
	}
}

final class Item extends ItemsStorage {
	private $id;

	public function __construct($id) {
		$this->id = $id;

		parent::setItemWithId($id,$this);

	}
}

// $a = new Item(1);
// $b = new Item(2);
// $c = new Item(3);
// var_dump($c->getAllItems());
// var_dump($a->getItemById(3));

// доступ ко внутреннему идентификатору обьекта (#3) я не нашел.
// object(Item)#3 (1) {
//   ["id":"Item":private]=>
//   int(3)
// } 
