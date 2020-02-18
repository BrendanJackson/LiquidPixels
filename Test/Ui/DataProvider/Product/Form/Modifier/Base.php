<?php
namespace Liquid\Test\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\CustomOptions;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\Form\Element\Checkbox;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Ui\Component\Form\Field;

class Base extends AbstractModifier
{
    /**
     * @var array
     */
    protected $meta = [];

    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyMeta(array $meta)
    {
        $this->meta = $meta;

        $this->addFields();

        return $this->meta;
    }

    /**
     * Adds fields to the meta-data
     */
    protected function addFields()
    {
        $groupCustomOptionsName    = CustomOptions::GROUP_CUSTOM_OPTIONS_NAME;
        $optionContainerName       = CustomOptions::CONTAINER_OPTION;
        $commonOptionContainerName = CustomOptions::CONTAINER_COMMON_NAME;

        // Add fields to the option
        $this->meta[$groupCustomOptionsName]['children']['options']['children']['record']['children']
        [$optionContainerName]['children'][$commonOptionContainerName]['children'] = array_replace_recursive(
            $this->meta[$groupCustomOptionsName]['children']['options']['children']['record']['children']
            [$optionContainerName]['children'][$commonOptionContainerName]['children'],
            $this->getOptionFieldsConfig()
        );


    }

    /**
     * The custom option fields config
     *
     * @return array
     */
    protected function getOptionFieldsConfig()
    {
        $fields['liquifire_argument'] = $this->getLiquifireArgumentFieldConfig();

        return $fields;
    }



    /**
     * Get liquifire_argument field config
     *
     * @return array
     */
    protected function getLiquifireArgumentFieldConfig()
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label'         => __('LiquiFire Argument'),
                        'componentType' => Field::NAME,
                        'formElement'   => Input::NAME,
                        'dataScope'     => 'liquifire_argument',
                        'dataType'      => Text::NAME,
                        'sortOrder'     => 65,
                        'validation'      => [
                            'required-entry' => false
                        ],
                    ],
                ],
            ],
        ];
    }


}
