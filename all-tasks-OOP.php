<?php 
// 1. Создать класс Item, который не наследуется. В конструктор класса передается ID объекта.
// 2. Описать свойства (int) id, (string) name, (int) status, (bool) changed. Свойства доступны только внутри класса.
// 3. Создать метод init(). Предусмотреть одноразовый вызов метода.
// 4. Метод доступен только внутри класса.
// 5. Метод получает из таблицы objects. данные name и status и заполняет их в свойства экземпляра (реализация работы с базой не требуется, представим что класс уже работает с бд). Эти данные также необходимо хранить в сыром виде внутри объекта, до сохранения.
// 6. Сделать возможным получение свойств объекта, используя magic methods.
// 7. Сделать возможным задание свойств объекта, используя magic methods с проверкой вводимого значения на заполненность и тип значения. Свойство ID не поддается записи.
// 8. Создать метод save().
// 9. Метод публичный.
// 10. Метод сохраняет установленные значения name и status в случае, если свойства объекта были изменены извне.
// 11. Класс должен быть задокументирован в стиле PHPDocumentor.

/**
  * ItemsStorage::class for collect id of Item::class objects
*/

class ItemsStorage {

	/**
	 * [$items array of Item::class]
	 * @var [array]
	 */
	
	static private $items;

	/**
	 * [getItemById description]
	 * @param  [int] $id [description]
	 * @return [object]     [Item::class]
	 */
	static public function getItemById($id) {
		return self::$items[$id];
	}

	/**
	 * [setItemWithId description]
	 * @param [int] $id  [description]
	 * @param [object] $obj [Item::class]
	 */
	static public function setItemWithId($id,$obj) {
		self::$items[$id] = $obj;
	}

	/**
	 * [getAllItems description]
	 * @return [array] [array of Item:class objects]
	 */
	public function getAllItems() {
		return self::$items;
	}
}

/**
 * Item class for test OOP
 *@final 
 */

final class Item extends ItemsStorage {

/**
 * [$id id]
 * @var [int]
 */
	private $id;

/**
 * [$name name]
 * @var [string]
 */
	private $name;

/**
 * [$status status]
 * @var [int]
 */
	private $status;

/**
 * [$changed changed]
 * @var [bool]
 */
	private $changed;

/**
 * [$isInit is method init called]
 * @var boolean
 */
	private $isInit = false;

/**
 * [$table database instance]
 * @var [object]
 */
	private $table;

/**
 * [__construct description]
 * @param [Int] $id [description]
 */
	public function __construct($id) {
		$this->id = $id;

		parent::setItemWithId($id,$this);

		$this->__set('constructedName',$this->name);
		$this->__set('constructedStatus',$this->status);

	}

/**
 * [init description]
 * @return [type] [description]
 */
	private function init() {

		if (!$this->isInit) {

			$name = $this->table->get('name');
			$status = $this->table->get('status');

			$this->name = $name;
			$this->status = $status;
		}
		$this->isInit = true;
	}

/**
 * [__set description]
 * @param [String] $name  [description]
 * @param [Mixed] $value [description]
 */
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

/**
 * [save description]
 * @return [String] [result of proccess message]
 */
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

