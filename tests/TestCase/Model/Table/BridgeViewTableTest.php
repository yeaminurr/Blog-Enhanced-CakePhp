<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BridgeViewTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BridgeViewTable Test Case
 */
class BridgeViewTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BridgeViewTable
     */
    protected $BridgeView;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.BridgeView',
        'app.Articles',
        'app.Roles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('BridgeView') ? [] : ['className' => BridgeViewTable::class];
        $this->BridgeView = $this->getTableLocator()->get('BridgeView', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->BridgeView);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BridgeViewTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\BridgeViewTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
