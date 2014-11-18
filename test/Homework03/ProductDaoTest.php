<?php
/**
 * Created by PhpStorm.
 * User: kukori
 * Date: 11/18/2014
 * Time: 5:47 AM
 */

use Tdd\Homework03\ProductDao;
class ProductDaoTest extends \PHPUnit_Framework_TestCase
{
//	public function testCreate()
//	{
//		$ean  = 'ean' . time();
//		$name = 'name' . time();
//
//		$product = $this->getProductMock($ean, $name);
//		$productDao = new ProductDao($this->getPDO());
//		$this->assertTrue($productDao->create($product));
//	}

	public function testGetByEAN()
	{
		$ean = '9999';
		$productDao = new ProductDao($this->getPDO());
		$this->assertEquals(2, $productDao->getByEan($ean)->id);
	}

	public function testGetById()
	{
		$id = 2;
		$productDao = new ProductDao($this->getPDO());
		$this->assertEquals(9999, $productDao->getById($id)->ean);
	}

	public function testModify()
	{
		$id = 2;
		$productDao = new ProductDao($this->getPDO());
		$product = $productDao->getById($id);
		$product->name = 'updated updated turkey product';
		$this->assertEquals(true, $productDao->modify($product));
	}

	public function getProductMock($ean, $name)
	{
		$product = $this->getMock('Tdd\Homework03\Product');

		$reflection = new ReflectionClass($product);
		$reflectionProperty = $reflection->getProperty('ean');
		$reflectionProperty->setAccessible(true);
		$reflectionProperty->setValue($product, $ean);

		$reflectionProperty2 = $reflection->getProperty('name');
		$reflectionProperty2->setAccessible(true);
		$reflectionProperty2->setValue($product, $name);

		return $product;
	}

	public function getPDO()
	{
		$pdo = new PDO('sqlite:./product_dev.db');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $pdo;
	}
}
