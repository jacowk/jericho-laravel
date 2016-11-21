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
		/* The following 3 lines of code are required to sort out the "Too many connections error" */
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