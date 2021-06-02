<?php
/**
 * Simple Hello World Module
 *
 * @category QaisarSatti
 * @package QaisarSatti_HelloWorld
 * @author Muhammad Qaisar Satti
 * @Email qaisarssatti@gmail.com
 *
 */

namespace Iverve\CrudOperation\Block;

class Reviewform extends \Magento\Framework\View\Element\Template
{
     public function getMyCustomMethod()
    {
        return '<b>I Am From MyCustomMethod</b>';
    }
}