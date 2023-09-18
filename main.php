<?php declare(strict_types=1);
require_once './autoload.php';

use Entities\UserTableWrapper;

$userTable = new UserTableWrapper();
$userTable->insert(['id' => 1, 'login' => 'lisin', 'email' => 'lisin@ya.ru']);
$userTable->insert(['id' => 2, 'login' => 'medvedev', 'email' => 'medvedev@ya.ru']);
$userTableRows = $userTable->get();
print_r($userTableRows);
$updArr = $userTable->update(1, ['login' => 'lisinoff']);
print_r($updArr);
echo PHP_EOL;
echo $updArr['login'];
echo PHP_EOL;
echo 'Удаление элемента массива' . PHP_EOL;
$userTable->delete(2);
$userTableRows = $userTable->get();
print_r($userTableRows);