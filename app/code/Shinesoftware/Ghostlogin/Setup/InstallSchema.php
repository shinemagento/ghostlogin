<?php


namespace Shinesoftware\Ghostlogin\Setup;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\InstallSchemaInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $table_shinesoftware_ghostlogin_token = $setup->getConnection()->newTable($setup->getTable('shinesoftware_ghostlogin_token'));

        $table_shinesoftware_ghostlogin_token->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );

        $table_shinesoftware_ghostlogin_token->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            ['nullable' => False],
            'token creation date'
        );

        $table_shinesoftware_ghostlogin_token->addColumn(
            'token',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => False],
            'Custom Token'
        );

        $table_shinesoftware_ghostlogin_token->addColumn(
            'path',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => False],
            'Custom Path'
        );

        $table_shinesoftware_ghostlogin_token->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
            null,
            ['nullable' => False],
            'Status of the token'
        );

        $table_shinesoftware_ghostlogin_token->addColumn(
            'customer_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' => False, 'unsigned' => true],
            'Customer Id'
        );

        $table_shinesoftware_ghostlogin_token->addColumn(
            'counter',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' => False, 'unsigned' => true],
            'uses of the link'
        );

        $setup->getConnection()->createTable($table_shinesoftware_ghostlogin_token);

        $setup->endSetup();
    }
}
