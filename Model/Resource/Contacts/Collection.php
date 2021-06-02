<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Iverve\CrudOperation\Model\Resource\Contacts;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
 
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Iverve\CrudOperation\Model\Contacts',
        			 'Iverve\CrudOperation\Model\Resource\Contacts');
        //$this->_map['fields']['page_id'] = 'main_table.page_id';
    }
 
    
}
