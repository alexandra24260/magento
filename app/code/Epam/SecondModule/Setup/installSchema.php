<?php
namespace Epam\SecondModule\Setup;

/**
 * @file
 *  Contains install schema for the module's table.
 */

use \Magento\Framework\Setup\InstallSchemaInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 * @package Epam\SecondModule\Setup
 */
class InstallSchema implements InstallSchemaInterface {
	/**
	 * @const
	 *  Public const: the name of the table of this module. Can be used externally.
	 */
	public const TABLE_NAME = 'magento_task';

	/**
	 * @const
	 *  Just a default value for 'name' column of the table. Internal usage.
	 */
	private const TABLE_DEFAULT_NAME_VALUE = 'Unknown';

	/**
	 * {@inheritDoc}
	 */
	public function install( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
		$setup->startSetup();
		$this->installTable( $setup, $context );
		$setup->endSetup();
	}

	/**
	 * Adds table for this module into the DB.
	 *
	 * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
	 * @param \Magento\Framework\Setup\ModuleContextInterface $context
	 *
	 * @return void
	 * @throws \Zend_Db_Exception
	 */
	private function installTable( SchemaSetupInterface $setup, ModuleContextInterface $context ): void {

		if ( $setup->tableExists( self::TABLE_NAME ) ) {
			return;
		}

		// Prepare table schema.
		$table = $setup->getConnection()
		               ->newTable( $setup->getTable( self::TABLE_NAME ) )
		               ->addColumn(
				               'id',
				               Table::TYPE_BIGINT,
				               null,
				               [
						               'identity' => true,
						               'nullable' => false,
						               'primary'  => true,
				               ],
				               'Record ID'
		               )->addColumn(
						'name',
						Table::TYPE_TEXT,
						255,
						[
								'nullable' => false,
								'default'  => self::TABLE_DEFAULT_NAME_VALUE,
						],
						'Record name'
				)->addColumn(
						'created',
						Table::TYPE_BIGINT,
						null,
						[
								'default'  => 0,
								'nullable' => false,
						],
						'Creation time'
				)->addColumn(
						'updated',
						Table::TYPE_BIGINT,
						null,
						[
								'default'  => 0,
								'nullable' => false,
						],
						'Update time'
				)->addColumn(
						'is_visible',
						Table::TYPE_BOOLEAN,
						null,
						[
								'default'  => 0,
								'nullable' => false,
						],
						'Is visible for the customers?'
				)->setComment( 'HWTask2dot1 Table' );

		// Create table.
		$setup->getConnection()->createTable( $table );
	}
}
