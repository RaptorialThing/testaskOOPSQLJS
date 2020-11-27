<?php

// Есть несколько таблиц в БД: users, objects
// 1. users: id, login, password, object_id
// 2. objects: id, name, status
// Нужно сделать выборку пользователей из базы данных с использованием конструкции JOIN у которых есть запись в таблице objects, соответствующая значению object_id

$sql = "select u.`id`, u.`login`, obj.`name`
			 FROM `users` u 
			 INNER JOIN  `objects` obj ON  u.object_id = obj.id;";


// +----+------+--------+
// | id | name | status |
// +----+------+--------+
// |  1 | Obj1 | 1      |
// |  2 | Obj2 | 0      |
// |  3 | Obj3 | 1      |
// +----+------+--------+


// +----+-------+----------+-----------+
// | id | login | password | object_id |
// +----+-------+----------+-----------+
// |  1 | Ivan  | 1        |         1 |
// |  2 | Piter | 1        |         2 |
// |  3 | Sidor | 1        |         1 |
// +----+-------+----------+-----------+

// +----+-------+------+
// | id | login | name |
// +----+-------+------+
// |  1 | Ivan  | Obj1 |
// |  3 | Sidor | Obj1 |
// |  2 | Piter | Obj2 |
// +----+-------+------+

