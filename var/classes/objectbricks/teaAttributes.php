<?php

/**
 * Fields Summary:
 * - teaintensity [slider]
 * - teaflavor [input]
 * - teaaroma [input]
 * - teacondition [input]
 * - tea [manyToOneRelation]
 * - teabrewingmethod [structuredTable]
 */

return \Pimcore\Model\DataObject\Objectbrick\Definition::__set_state(array(
   'dao' => NULL,
   'key' => 'teaAttributes',
   'parentClass' => '',
   'implementsInterfaces' => '',
   'title' => 'Чай',
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
          \Pimcore\Model\DataObject\ClassDefinition\Data\Slider::__set_state(array(
             'name' => 'teaintensity',
             'title' => 'Насиченість',
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
             'maxValue' => 5.0,
             'vertical' => false,
             'increment' => NULL,
             'decimalPrecision' => NULL,
             'height' => '',
             'width' => 250,
          )),
          1 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Input::__set_state(array(
             'name' => 'teaflavor',
             'title' => 'Смак',
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
             'columnLength' => 190,
             'regex' => '',
             'regexFlags' => 
            array (
            ),
             'unique' => false,
             'showCharCount' => false,
             'width' => '',
             'defaultValueGenerator' => '',
          )),
          2 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Input::__set_state(array(
             'name' => 'teaaroma',
             'title' => 'Аромат',
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
             'columnLength' => 190,
             'regex' => '',
             'regexFlags' => 
            array (
            ),
             'unique' => false,
             'showCharCount' => false,
             'width' => '',
             'defaultValueGenerator' => '',
          )),
          3 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Input::__set_state(array(
             'name' => 'teacondition',
             'title' => 'Стан',
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
             'columnLength' => 190,
             'regex' => '',
             'regexFlags' => 
            array (
            ),
             'unique' => false,
             'showCharCount' => false,
             'width' => '',
             'defaultValueGenerator' => '',
          )),
          4 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation::__set_state(array(
             'name' => 'tea',
             'title' => 'Тип чаю',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => false,
             'index' => false,
             'locked' => false,
             'style' => '',
             'permissions' => NULL,
             'fieldtype' => '',
             'relationType' => true,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => false,
             'blockedVarsForExport' => 
            array (
            ),
             'classes' => 
            array (
              0 => 
              array (
                'classes' => 'Teatype',
              ),
            ),
             'displayMode' => 'grid',
             'pathFormatterClass' => '',
             'assetInlineDownloadAllowed' => false,
             'assetUploadPath' => '',
             'allowToClearRelation' => true,
             'objectsAllowed' => true,
             'assetsAllowed' => false,
             'assetTypes' => 
            array (
            ),
             'documentsAllowed' => false,
             'documentTypes' => 
            array (
            ),
             'width' => '',
          )),
          5 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\StructuredTable::__set_state(array(
             'name' => 'teabrewingmethod',
             'title' => 'Способи заварювання чаю',
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
             'labelWidth' => 250,
             'labelFirstCell' => 'Спосіб заварювання',
             'cols' => 
            array (
              0 => 
              array (
                'position' => 1,
                'key' => 'time',
                'label' => 'Час',
                'type' => 'number',
              ),
              1 => 
              array (
                'type' => 'number',
                'position' => 2,
                'key' => 'fusions',
                'label' => 'Кількість проливів',
              ),
              2 => 
              array (
                'type' => 'number',
                'position' => 3,
                'key' => 'temperature',
                'label' => 'Температура',
              ),
            ),
             'rows' => 
            array (
              0 => 
              array (
                'position' => 1,
                'key' => 'european',
                'label' => 'Європейський',
              ),
              1 => 
              array (
                'position' => 2,
                'key' => 'authentic',
                'label' => 'Автентичний',
              ),
            ),
             'height' => '',
             'width' => 1000,
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
   'activeDispatchingEvents' => 
  array (
  ),
));
