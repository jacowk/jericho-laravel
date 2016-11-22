<?php

class SeleniumTest extends PHPUnit_Extensions_Selenium2TestCase
{
	public function setUp()
	{
		$this->setHost('localhost');
		$this->setPort(8000);
		$this->setBrowserUrl('http://localhost:8000/');
		$this->setBrowser('firefox');
	}
	
	public function tearDown()
	{
		$this->stop();
	}
	
	public function testLogin()
	{
// 		$this->open('/');
// 		$this->byName('email')->value('jaco.wk@gmail.com');
// 		$this->byName('password')->value('password');
// 		$this->byName('login')->submit();
	}
}