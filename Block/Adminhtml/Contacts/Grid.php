<?php
namespace Iverve\CrudOperation\Block\Adminhtml\Contacts;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Vishwas\Mycontact\Model\ContactsFactory
     */
    protected $_contactsFactory;

    /**
     * @var \Vishwas\Mycontact\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Vishwas\Mycontact\Model\ContactsFactory $contactsFactory
     * @param \Vishwas\Mycontact\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Iverve\CrudOperation\Model\ContactsFactory $contactsFactory,
        \Iverve\CrudOperation\Model\Status $status,
        /* \Iverve\CrudOperation\Model\Hobbies $hobbies,*/
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_contactsFactory = $contactsFactory;
        $this->_status = $status;
       /* $this->_hobbies = $hobbies;*/
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('contact_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_contactsFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();
        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'contact_id',
            [
                'header' => __('Contact ID'),
                'type' => 'number',
                'index' => 'contact_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'name'=>'contact_id'
            ]
        );
        $this->addColumn(
            'fname',
            [
                'header' => __('First Name'),
                'index' => 'name',
                'class' => 'xxx',
                'name'=>'fname'
            ]
        );
        $this->addColumn(
            'lname',
            [
                'header' => __('Last Name'),
                'index' => 'name',
                'class' => 'xxx',
                'name'=>'lname'
            ]
        );
        $this->addColumn(
            'email',
            [
                'header' => __('Email ID'),
                'index' => 'email',
                'class' => 'xxx',
                'name'=>'email'
            ]
        );
        $this->addColumn(
            'contact',
            [
                'header' => __('Contact'),
                'index' => 'contact',
                'class' => 'xxx',
                'name'=>'contact'
            ]
        );
        $this->addColumn(
            'bod',
            [
                'header' => __('Birth Date'),
                'index' => 'bod',
                'class' => 'xxx',
                'name'=>'bod'
            ]
        );
       /*  $this->addColumn(
            'gender',
            [
                'header' => __('Gender'),
                'index' => 'gender',
                'class' => 'xxx',
                'name'=>'gender'
            ]
        );*/
        $this->addColumn(
            'featured_image',
            [
                'header' => __('featured_image'),
                'index' => 'featured_image',
                'class' => 'xxx',
                'name'=>'featured_image'
            ]
        );
      /*  $this->addColumn(
            'hobbies',
            [
                'header' => __('Hobbies'),
                'index' => 'hobbies',
                'class' => 'xxx',
                'name'=>'hobbies',
                'options' => $this->_hobbies->getOptionArray()
            ]
        );*/
        $this->addColumn(
            'is_active',
            [
                'header' => __('Status'),
                'index' => 'is_active',
                'type' => 'options',
                'name'=>'is_active',
                'options' => $this->_status->getOptionArray()
            ]
        );
        $this->addColumn(
            'edit',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => '*/*/edit'
                        ],
                        'field' => 'contact_id'
                    ]
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action'
            ]
        );

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        
        $this->setMassactionIdField('contact_id');
        $this->getMassactionBlock()->setTemplate('Iverve_CrudOperation::mycontact/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('fname');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('mycontact/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        array_unshift($statuses, ['label' => '', 'value' => '']);
        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('mycontact/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );


        return $this;
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('mycontact/*/grid', ['_current' => true]);
    }

    /**
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl(
            'mycontact/*/edit',
            ['contact_id' => $row->getId()]
        );
    }
}