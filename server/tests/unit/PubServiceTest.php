<?php

use app\modules\v1\services\PubService;
use app\modules\v1\models\Pub;

class PubServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testCnahgePubMusic()
    {
        $pubId = 1;
        $oldMusic = 1;
        $newMusic = 2;
        $pubService = new PubService();
        $pub = Pub::findOne($pubId) ;
        $this->assertEquals($oldMusic, $pub->playing_music);
        $this->assertEquals(7, $pub->getDrinkingClient()->count());
        $this->assertEquals(3, $pub->getDancingClient()->count());
        $pubService->cnahgePubMusic($pubId, $newMusic);
        $pub = Pub::findOne($pubId);
        $this->assertEquals($newMusic, $pub->playing_music);
        $this->assertEquals(8, $pub->getDrinkingClient()->count());
        $this->assertEquals(2, $pub->getDancingClient()->count());
    }
}