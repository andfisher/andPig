<?php
namespace Game;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2019-12-15 at 11:58:41.
 */
class ManagerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Manager
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->player1Stub = $this->getMockBuilder(\Player\PlayerInterface::class)->getMock();
        $this->player2Stub = $this->getMockBuilder(\Player\PlayerInterface::class)->getMock();
        $this->object = new Manager([
            $this->player1Stub,
            $this->player2Stub,
        ]);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * @covers Game\Manager::addPlayer
     * @todo   Implement testAddPlayer().
     */
    public function testAddPlayer()
    {
        $player3 = $this->getMockBuilder(\Player\PlayerInterface::class)->getMock();
        $this->object->addPlayer($player3);

        $this->assertCount(3, $this->object->getPlayers());
    }

    /**
     * @covers Game\Manager::getActivePlayer
     * @todo   Implement testGetActivePlayer().
     */
    public function testGetActivePlayer()
    {
        $this->assertEquals($this->object->getActivePlayer(), $this->player1Stub);
    }

    /**
     * @covers Game\Manager::getState
     * @todo   Implement testGetState().
     */
    public function testGetState()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Game\Manager::getPlayers
     * @todo   Implement testGetPlayers().
     */
    public function testGetPlayers()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Game\Manager::getPlayer
     * @todo   Implement testGetPlayer().
     */
    public function testGetPlayer()
    {
        $this->assertEquals($this->object->getPlayer(1), $this->player2Stub);

        $this->expectException(\Exception::class);

        $this->object->getPlayer(9001);
    }

    /**
     * @covers Game\Manager::roll
     * @todo   Implement testRoll().
     */
    public function testRoll()
    {
        $this->object->roll();

        $this->assertEquals($this->object->getState(), Manager::GAME_STATE_PLAYING);
    }

    /**
     * @covers Game\Manager::pass
     * @todo   Implement testPass().
     */
    public function testPass()
    {
        $this->assertEquals($this->object->getActivePlayer(), $this->player1Stub);

        $this->object->pass();

        $this->assertEquals($this->object->getActivePlayer(), $this->player2Stub);

        $this->object->pass();

        $this->assertEquals($this->object->getActivePlayer(), $this->player1Stub);
    }

    /**
     * @covers Game\Manager::roundEnds
     * @todo   Implement testRoundEnds().
     */
    public function testRoundEnds()
    {
        $this->player1Stub->method('getScore')
             ->willReturn(100);

        $this->object->roundEnds();

        $this->assertEquals($this->object->getState(), Manager::GAME_STATE_WON);
    }


    /**
     * @covers Game\Manager::roundEnds
     * @todo   Implement testRoundEnds().
     */
    public function testRoundEndsOver100()
    {
        $this->player1Stub->method('getScore')
             ->willReturn(111);

        $this->object->roundEnds();

        $this->assertEquals($this->object->getState(), Manager::GAME_STATE_WON);
    }

    /**
     * @covers Game\Manager::reset
     * @todo   Implement testReset().
     */
    public function testReset()
    {
        $this->object->roll();

        $this->assertEquals($this->object->getState(), Manager::GAME_STATE_PLAYING);

        $this->object->reset();

        $this->assertEquals($this->object->getState(), Manager::GAME_STATE_PENDING);
    }
}
