<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SingerTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SingerTable Test Case
 */
class SingerTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SingerTable
     */
    protected $Singer;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Singer',
        'app.Songs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Singer') ? [] : ['className' => SingerTable::class];
        $this->Singer = $this->getTableLocator()->get('Singer', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Singer);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\SingerTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
