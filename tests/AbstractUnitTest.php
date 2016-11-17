<?php
use ReflectionObject;

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
// 		$refl = new ReflectionObject($this);
// 		foreach ($refl->getProperties() as $prop) {
// 			if (!$prop->isStatic() && 0 !== strpos($prop->getDeclaringClass()->getName(), 'PHPUnit_')) {
// 				$prop->setAccessible(true);
// 				$prop->setValue($this, null);
// 			}
// 		}
		
		parent::tearDown();
		// 		Mockery::close();
	}
	
}