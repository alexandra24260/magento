<?php
namespace Epam\SecondModule\Setup;

/**
 * @file
 *  Contains data to be added into the module's table.
 */

use \Magento\Framework\Setup\InstallDataInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class InstallData.
 *  Adds some data to the module's table.
 *
 * @package Epam\SecondModule\Setup
 */
class InstallData implements InstallDataInterface
{
	/**
	 * {@inheritDoc}
	 */
	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$data = [
				['name' => 'Item_1', 'created' => time(), 'updated' => time(), 'is_visible' => true,],
				['name' => 'Item_2', 'is_visible' => false],
				['created' => time()],
				['name' => 'Item_4', 'is_visible' => true],
				[],
		];

		foreach ($data as $packet) {
			$setup->getConnection()
			      ->insertForce($setup->getTable(InstallSchema::TABLE_NAME), $packet);
		}
	}
}
