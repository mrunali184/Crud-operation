<?php

namespace Iverve\CrudOperation\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()->newTable(
            $installer->getTable('crud_operation')
        )->addColumn(
            'contact_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true, 'nullable' => false, 'primary' => true),
            'Contact ID'
        )->addColumn(
            'fname',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            array('nullable' => false),
            'First Name'
        )->addColumn(
            'lname',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            array('nullable' => false),
            'Last Name'
        )->addColumn(
            'email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '255',
            array('nullable' => false),
            'Email ID'
        )->addColumn(
            'contact',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            15,
            array(),
            'Contact Num'
        )->addColumn(
            'bod',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            array(),
            'Birth Date'
        /*)->addColumn(
            'gender',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
             array(),
            'Gender'*/
       )->addColumn(
        'featured_image', 
        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
         255,
         array(),
         'Post Featured Image' 
     /* )->addColumn(
            'hobbies',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'Hobbies'*/
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            array(),
            'Active Status'
        )->setComment(
            'Custom Form Table'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();

    }
}
