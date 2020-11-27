<?php 

// 3. Создать метод init(). Предусмотреть одноразовый вызов метода.
// 4. Метод доступен только внутри класса.
// 5. Метод получает из таблицы objects. данные name и status и заполняет их в свойства экземпляра (реализация работы с базой не требуется, представим что класс уже работает с бд). Эти данные также необходимо хранить в сыром виде внутри объекта, до сохранения.

class Item {
	private $isInit = false;

	private $name;

	private $status;

	private $table;

	private function init() {

		if (!$this->isInit) {

			$name = $this->table->get('name');
			$status = $this->table->get('status');

			$this->name = $name;
			$this->status = $status;
		}
		$this->isInit = true;
	}
}