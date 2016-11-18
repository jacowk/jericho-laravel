<?php

/**
 * 
 * @author Jaco Koekemoer
 * 2016-11-17
 *
 */
class AbstractUnitTest extends TestCase
{
	public function setUp()
	{
		parent::setUp();
		$this->artisan('db:seed');
	}
	
	public function tearDown()
	{
		$this->beforeApplicationDestroyed(function () {
			DB::disconnect();
		});
		
		parent::tearDown();
		// 		Mockery::close();
	}
	
	/**
	 * A basic test example.
	 *
	 * @return void
	 */
	public function testExample()
	{
		$this->assertTrue(true);
	}
	
}