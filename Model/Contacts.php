<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Iverve\CrudOperation\Model;

use Magento\Framework\Model\AbstractModel;

class Contacts extends AbstractModel
{
	public function _construct()
	{
	    $this->_init('Iverve\CrudOperation\Model\Resource\Contacts');
	}
}