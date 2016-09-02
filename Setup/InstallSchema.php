<?php

namespace Test\Testimonials\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface {

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
        $installer = $setup;
        $installer->startSetup();
        $table = $installer->getConnection()
                ->newTable($installer->getTable('test_testimonials'))
                ->addColumn('post_id', Table::TYPE_SMALLINT, null, ['identity' => true, 'nullable' => false, 'primary' => true], 'Post ID')
                ->addColumn('url_key', Table::TYPE_TEXT, 100, ['nullable' => true, 'default' => null])
                ->addColumn('name', Table::TYPE_TEXT, 100, ['nullable' => true, 'default' => null])
                ->addColumn('text', Table::TYPE_TEXT, '2M', [], 'Testmonials Content')

                ->addColumn('photo_url', Table::TYPE_TEXT, 100, ['nullable' => true, 'default' => null])
                ->addColumn('is_active', Table::TYPE_SMALLINT, null, ['nullable' => false, 'default' => '1'], 'Is Post Active?')
                ->addColumn('creation_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Creation Time')
                ->addColumn('update_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Update Time')
                ->addIndex($installer->getIdxName('test_testimonials', ['url_key']), ['url_key'])
                ->setComment('test\Testimonials posts table');               
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
