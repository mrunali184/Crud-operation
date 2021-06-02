<?php

namespace Iverve\CrudOperation\Block\Adminhtml\Contacts\Edit\Tab;

/**
 * Post edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    /**
     * @var \Vishwas\Mycontact\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Iverve\CrudOperation\Model\Status $status,
        /* \Iverve\CrudOperation\Model\Hobbies $hobbies,*/
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_status = $status;
        /*$this->_hobbies = $hobbies;*/
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /* @var $model \Vishwas\Mycontact\Model\Contacts */

        $model = $this->_coreRegistry->registry('contacts_post');
       
        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Information')]);

        if ($model->getId()) {
            $fieldset->addField('contact_id', 'hidden', ['name' => 'contact_id']);
        }

        


        $fieldset->addField(
            'fname',
            'text',
            [
                'name' => 'fname',
                'label' => __('First Name'),
                'title' => __('First Name'),
                'required' => true,
                'disabled' => $isElementDisabled,
                'value' =>'abc'
            ]
        );
        $fieldset->addField(
            'lname',
            'text',
            [
                'name' => 'lname',
                'label' => __('Last Name'),
                'title' => __('Last Name'),
                'required' => true,
                'disabled' => $isElementDisabled,
                'value' =>'abc'
            ]
        );
         $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Email ID'),
                'title' => __('Email ID'),
                'required' => true,
                'disabled' => $isElementDisabled,
                'value' =>'abc'
            ]
        );
         $fieldset->addField(
            'contact',
            'text',
            [
                'name' => 'contact',
                'label' => __('Contact Num'),
                'title' => __('Contact Num'),
                'required' => false,
                'disabled' => $isElementDisabled,
                'value' =>'abc'
            ]
        );

        $dateFormat = $this->_localeDate->getDateFormat(
            \IntlDateFormatter::SHORT
        );

        $fieldset->addField(
            'bod',
            'date',
            [
                'name' => 'bod',
                'label' => __('Birth Date'),
                'date_format' => $dateFormat,
                'disabled' => $isElementDisabled,
                'class' => 'validate-date validate-date-range date-range-custom_theme-from'
            ]
        );

        /* $fieldset->addField(
            'gender',
            'radio',
            [
                'name' => 'gender',
                'label' => __('Gender'),
                'title' => __('Gender'),
                'required' => false,
                'disabled' => $isElementDisabled
                
            ]
        );*/

        $fieldset->addField(
            'featured_image',
            'fileupload',
            [
                'name' => 'featured_image',
                'label' => __('Featured image'),
                'title' => __('Featured image'),
                'required' => false,
                'disabled' => $isElementDisabled    
            ]
        );

       /* $fieldset->addField(
            'hobbies',
            'select',
            [
                'label' => __('Hobbies'),
                'title' => __('Hobbies'),
                'name' => 'hobbies',
                'required' => false,
                'options' => $this->_status->getOptionArray(),
                'disabled' => $isElementDisabled
            ]
        );*/

        $fieldset->addField(
            'is_active',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'is_active',
                'required' => true,
                'options' => $this->_hobbies->getOptionArray(),
                'disabled' => $isElementDisabled
            ]
        );
        if (!$model->getId()) {
            $model->setData('is_active', $isElementDisabled ? '0' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Crud Operation');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Crud Operation');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
