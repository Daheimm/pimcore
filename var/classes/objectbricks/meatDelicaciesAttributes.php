<?php

/**
 * Fields Summary:
 * - meattype [select]
 * - cookingmethod [select]
 * - additiontomeat [multiselect]
 * - meatendurance [numeric]
 * - meatsalinity [slider]
 * - spicymeat [slider]
 */

return \Pimcore\Model\DataObject\Objectbrick\Definition::__set_state(array(
   'dao' => NULL,
   'key' => 'meatDelicaciesAttributes',
   'parentClass' => '',
   'implementsInterfaces' => '',
   'title' => 'Мʼясні делікатеси ',
   'group' => 'Кастомні (Продукти)',
   'layoutDefinitions' => 
  \Pimcore\Model\DataObject\ClassDefinition\Layout\Panel::__set_state(array(
     'name' => NULL,
     'type' => NULL,
     'region' => NULL,
     'title' => NULL,
     'width' => 0,
     'height' => 0,
     'collapsible' => false,
     'collapsed' => false,
     'bodyStyle' => NULL,
     'datatype' => 'layout',
     'children' => 
    array (
      0 => 
      \Pimcore\Model\DataObject\ClassDefinition\Layout\Fieldset::__set_state(array(
         'name' => 'Layout',
         'type' => NULL,
         'region' => NULL,
         'title' => '',
         'width' => '',
         'height' => '',
         'collapsible' => false,
         'collapsed' => false,
         'bodyStyle' => '',
         'datatype' => 'layout',
         'children' => 
        array (
          0 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Select::__set_state(array(
             'name' => 'meattype',
             'title' => 'Тип мʼяса',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => false,
             'index' => false,
             'locked' => false,
             'style' => '',
             'permissions' => NULL,
             'fieldtype' => '',
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => false,
             'blockedVarsForExport' => 
            array (
            ),
             'options' => 
            array (
              0 => 
              array (
                'key' => 'Свинина',
                'value' => 'Свинина',
              ),
              1 => 
              array (
                'key' => 'Телятина',
                'value' => 'Телятина',
              ),
              2 => 
              array (
                'key' => 'Яловичина',
                'value' => 'Яловичина',
              ),
              3 => 
              array (
                'key' => 'Курятина',
                'value' => 'Курятина',
              ),
              4 => 
              array (
                'key' => 'Індичка',
                'value' => 'Індичка',
              ),
            ),
             'defaultValue' => '',
             'optionsProviderClass' => '',
             'optionsProviderData' => '',
             'columnLength' => 190,
             'dynamicOptions' => false,
             'defaultValueGenerator' => '',
             'width' => '',
          )),
          1 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Select::__set_state(array(
             'name' => 'cookingmethod',
             'title' => 'Спосіб приготування ',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => false,
             'index' => false,
             'locked' => false,
             'style' => '',
             'permissions' => NULL,
             'fieldtype' => '',
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => false,
             'blockedVarsForExport' => 
            array (
            ),
             'options' => 
            array (
              0 => 
              array (
                'key' => 'Вʼялене',
                'value' => 'Вʼялене',
              ),
              1 => 
              array (
                'key' => 'Копчене',
                'value' => 'Копчене',
              ),
              2 => 
              array (
                'key' => 'Сиро-вʼялене',
                'value' => 'Сиро-вʼялене',
              ),
            ),
             'defaultValue' => '',
             'optionsProviderClass' => '',
             'optionsProviderData' => '',
             'columnLength' => 190,
             'dynamicOptions' => false,
             'defaultValueGenerator' => '',
             'width' => '',
          )),
          2 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Multiselect::__set_state(array(
             'name' => 'additiontomeat',
             'title' => 'Додатки',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => false,
             'index' => false,
             'locked' => false,
             'style' => '',
             'permissions' => NULL,
             'fieldtype' => '',
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => false,
             'blockedVarsForExport' => 
            array (
            ),
             'options' => 
            array (
              0 => 
              array (
                'key' => 'Фісташки',
                'value' => 'Фісташки',
              ),
              1 => 
              array (
                'key' => 'Трюфель',
                'value' => 'Трюфель',
              ),
              2 => 
              array (
                'key' => 'Перець',
                'value' => 'Перець',
              ),
              3 => 
              array (
                'key' => 'Трави',
                'value' => 'Трави',
              ),
            ),
             'maxItems' => NULL,
             'renderType' => 'tags',
             'optionsProviderClass' => '',
             'optionsProviderData' => '',
             'dynamicOptions' => false,
             'height' => '',
             'width' => 250,
          )),
          3 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Numeric::__set_state(array(
             'name' => 'meatendurance',
             'title' => 'Витримка',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => false,
             'index' => false,
             'locked' => false,
             'style' => '',
             'permissions' => NULL,
             'fieldtype' => '',
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => false,
             'blockedVarsForExport' => 
            array (
            ),
             'defaultValue' => NULL,
             'integer' => false,
             'unsigned' => false,
             'minValue' => 0.0,
             'maxValue' => NULL,
             'unique' => false,
             'decimalSize' => NULL,
             'decimalPrecision' => NULL,
             'width' => 250,
             'defaultValueGenerator' => '',
          )),
          4 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Slider::__set_state(array(
             'name' => 'meatsalinity',
             'title' => 'Солоність',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => false,
             'index' => false,
             'locked' => false,
             'style' => '',
             'permissions' => NULL,
             'fieldtype' => '',
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => false,
             'blockedVarsForExport' => 
            array (
            ),
             'minValue' => 0.0,
             'maxValue' => NULL,
             'vertical' => false,
             'increment' => NULL,
             'decimalPrecision' => NULL,
             'height' => '',
             'width' => 250,
          )),
          5 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Slider::__set_state(array(
             'name' => 'spicymeat',
             'title' => 'Гострота',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => false,
             'index' => false,
             'locked' => false,
             'style' => '',
             'permissions' => NULL,
             'fieldtype' => '',
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => false,
             'blockedVarsForExport' => 
            array (
            ),
             'minValue' => 0.0,
             'maxValue' => NULL,
             'vertical' => false,
             'increment' => NULL,
             'decimalPrecision' => NULL,
             'height' => '',
             'width' => 250,
          )),
        ),
         'locked' => false,
         'blockedVarsForExport' => 
        array (
        ),
         'fieldtype' => 'fieldset',
         'labelWidth' => 100,
         'labelAlign' => 'left',
      )),
    ),
     'locked' => false,
     'blockedVarsForExport' => 
    array (
    ),
     'fieldtype' => 'panel',
     'layout' => NULL,
     'border' => false,
     'icon' => NULL,
     'labelWidth' => 100,
     'labelAlign' => 'left',
  )),
   'fieldDefinitionsCache' => NULL,
   'blockedVarsForExport' => 
  array (
  ),
   'classDefinitions' => 
  array (
    0 => 
    array (
      'classname' => 'Product',
      'fieldname' => 'pcustomization',
    ),
  ),
));
