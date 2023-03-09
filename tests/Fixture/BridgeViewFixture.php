<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BridgeViewFixture
 */
class BridgeViewFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'bridge_view';
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
                'article_id' => 1,
                'role_id' => 1,
            ],
        ];
        parent::init();
    }
}
