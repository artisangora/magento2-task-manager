<?php

namespace Artisangora\Task\Setup;


use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @deprecated Need to do https://devdocs.magento.com/guides/v2.3/extension-dev-guide/declarative-schema/db-schema.html
 */
class InstallSchema implements InstallSchemaInterface
{

    const TABLE = 'artisangora_task';

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     *
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $adapter = $setup->getConnection();
        $setup->startSetup();

        $table = $adapter
            ->newTable($setup->getTable(self::TABLE))
            ->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary'  => true
                ],
                'ID'
            )
            ->addColumn(
                'title',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Title'
            )
            ->addColumn(
                'content',
                Table::TYPE_TEXT,
                null,
                ['nullable' => true],
                'Content'
            )
        ;


        $adapter->createTable($table);
        $setup->endSetup();
    }
}