<?php
namespace Epam\Declarative\Setup\Patch\Data;

/**
 * @file
 *  Contains a patch which adds some data to the module's table once.
 */

use \Magento\Framework\Setup\Patch\DataPatchInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class TaskPatch1
 * @package Epam\Declarative\Setup\Patch\Data
 */
class TaskPatch1 implements DataPatchInterface
{
	/**
	 * @const
	 *  Module's table name.
	 */
	public const TABLE_NAME = 'atask22';

	/**
	 * @var \Magento\Framework\Setup\ModuleDataSetupInterface
	 */
	private $setup;

	/**
	 * TaskPatch1 constructor.
	 * @param ModuleDataSetupInterface $setup
	 */
	public function __construct(ModuleDataSetupInterface $setup)
	{
		$this->setup = $setup;
	}

	/**
	 * {@inheritDoc}
	 */
	public function apply()
	{
		if (!$this->setup->getConnection()->isTableExists(self::TABLE_NAME)) {
			return;
		}

		$this->setup->getConnection()
		            ->insertArray(
				            $this->setup->getTable(self::TABLE_NAME),
				            $this->getColumns(),
				            $this->getData()
		            );
	}

	/**
	 * Returns an array of column names.
	 *
	 * @return array
	 */
	private function getColumns(): array
	{
		return ['name', 'created', 'updated', 'is_visible'];
	}

	/**
	 * Returns an array of sub-arrays with data for table.
	 *
	 * @return array
	 */
	private function getData(): array
	{
		return [
				['Item_1', time(), time(), false],
				['Item_2', time(), time(), true],
				['Item_3', time(), time(), true],
				['Item_4', time(), time(), false],
				['Item_5', time(), time(), false],
		];
	}

	/**
	 * {@inheritDoc}
	 */
	public static function getDependencies()
	{
		return [];
	}

	/**
	 * {@inheritDoc}
	 */
	public function getAliases()
	{
		return [];
	}
}
