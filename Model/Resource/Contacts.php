<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Iverve\CrudOperation\Model\Resource;
 
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Contacts extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('iverve_crudoperation', 'contact_id');
    }
}
