<?php
namespace Ambab\EmiCalc\Block\Adminhtml\Grid\Edit;


/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) 
    {
        // $this->_options = $options;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => [
                            'id' => 'edit_form', 
                            'enctype' => 'multipart/form-data', 
                            'action' => $this->getData('action'), 
                            'method' => 'post'
                        ]
            ]
        );

        $form->setHtmlIdPrefix('wkgrid_');
        if ($model->getEntityId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Bank'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'Bank_Name',
            'text',
            [
                'name' => 'Bank_Name',
                'label' => __('Bank Name'),
                'id' => 'Bank_Name',
                'title' => __('Bank Name'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'Emi_Plan',
            'text',
            [
                'name' => 'Emi_Plan',
                'label' => __('Emi Plan'),
                'id' => 'Emi_Plan',
                'title' => __('Emi Plan'),
                'class' => 'validate-number',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'Intrest(pa)',
            'text',
            [
                'name' => 'Intrest(pa)',
                'label' => __('Intrest Per Annum'),
                'id' => 'Intrest(pa)',
                'title' => __('Intrest'),
                'class' => 'validate-number',
                'required' => true,
            ]
        );
        
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}