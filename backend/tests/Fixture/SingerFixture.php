<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SingerFixture
 */
class SingerFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'singer';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-12-12 10:46:08',
                'modified' => '2025-12-12 10:46:08',
            ],
        ];
        parent::init();
    }
}
