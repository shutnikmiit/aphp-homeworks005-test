<?php declare(strict_types=1);
namespace Tests;

require_once './autoloadTests.php';

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Entities\UserTableWrapper;

class UserTableWrapperTest extends TestCase
{

    private $userTable;

    protected function setUp(): void
    {
        $this->userTable = new UserTableWrapper();
    }

    public static function insertProvider(): array
    {
        return [
            [['id' => 1, 'login' => 'lisin']],
            [['id' => 2, 'login' => 'medvedev']]
        ];
    }

    #[DataProvider('insertProvider')]
    public function testInsert(array $values): void
    {
        $this->userTable->insert($values);
        $userTableGetResult = $this->userTable->get();
        $this->assertContains($values, $userTableGetResult);
    }

    public function testGet(): void
    {
        $initialData = ['id' => 1, 'login' => 'lisin'];
        $this->userTable->insert($initialData);
        $row = $this->userTable->get();

        $this->assertEquals($initialData, $row[0]);
    }

    public function testUpdate(): void
    {
        $this->userTable->insert(['id' => 1, 'login' => 'lisin']);
        $updatedArr = $this->userTable->update(1, ['login' => 'lisinoff']);

        $this->assertSame('lisinoff', $updatedArr['login']);
    }

    #[DataProvider('insertProvider')]
    public function testDelete($values):void
    {
        $this->userTable->insert($values);
        $this->userTable->delete(1);

        $this->assertNotContains(['id' => 1, 'login' => 'lisin'], $this->userTable->get());
    }
}