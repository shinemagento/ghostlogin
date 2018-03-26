<?php
/**
 * A Magento 2 module named Shinesoftware/Ghostlogin
 * Copyright (C) 2017 Michelangelo Turillo
 * 
 * This file is part of Shinesoftware/Ghostlogin.
 * 
 * Shinesoftware/Ghostlogin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Shinesoftware\Ghostlogin\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
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
            'token_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );
        

        
        $table_shinesoftware_ghostlogin_token->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'created_at'
        );
        

        
        $table_shinesoftware_ghostlogin_token->addColumn(
            'token',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => False],
            'token'
        );
        

        
        $table_shinesoftware_ghostlogin_token->addColumn(
            'path',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'path'
        );
        

        
        $table_shinesoftware_ghostlogin_token->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
            null,
            [],
            'status'
        );
        

        
        $table_shinesoftware_ghostlogin_token->addColumn(
            'customer_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' => False],
            'customer_id'
        );
        

        
        $table_shinesoftware_ghostlogin_token->addColumn(
            'counter',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'counter'
        );
        

        $setup->getConnection()->createTable($table_shinesoftware_ghostlogin_token);

        $setup->endSetup();
    }
}
