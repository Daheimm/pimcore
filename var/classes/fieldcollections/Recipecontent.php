<?php

/**
 * Fields Summary:
 * - stepimage [image]
 * - stepnumber [numeric]
 * - localizedfields [localizedfields]
 * -- steptext [textarea]
 */

return \Pimcore\Model\DataObject\Fieldcollection\Definition::__set_state(array(
   'dao' => NULL,
   'key' => 'Recipecontent',
   'parentClass' => '',
   'implementsInterfaces' => '',
   'title' => 'Додати крок',
   'group' => 'Recipe',
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
          \Pimcore\Model\DataObject\ClassDefinition\Data\Image::__set_state(array(
             'name' => 'stepimage',
             'title' => 'Фото',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => false,
             'index' => false,
             'locked' => false,
             'style' => 'float: right;',
             'permissions' => NULL,
             'fieldtype' => '',
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => false,
             'blockedVarsForExport' => 
            array (
            ),
             'uploadPath' => '',
             'width' => 250,
             'height' => 200,
          )),
          1 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Numeric::__set_state(array(
             'name' => 'stepnumber',
             'title' => 'Крок',
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
             'integer' => true,
             'unsigned' => false,
             'minValue' => 1.0,
             'maxValue' => NULL,
             'unique' => false,
             'decimalSize' => NULL,
             'decimalPrecision' => 1,
             'width' => 90,
             'defaultValueGenerator' => '',
          )),
          2 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Localizedfields::__set_state(array(
             'name' => 'localizedfields',
             'title' => '',
             'tooltip' => NULL,
             'mandatory' => false,
             'noteditable' => false,
             'index' => false,
             'locked' => false,
             'style' => NULL,
             'permissions' => NULL,
             'fieldtype' => '',
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => true,
             'visibleSearch' => true,
             'blockedVarsForExport' => 
            array (
            ),
             'children' => 
            array (
              0 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Textarea::__set_state(array(
                 'name' => 'steptext',
                 'title' => 'Опис',
                 'tooltip' => '',
                 'mandatory' => false,
                 'noteditable' => false,
                 'index' => false,
                 'locked' => false,
                 'style' => 'float: left;',
                 'permissions' => NULL,
                 'fieldtype' => '',
                 'relationType' => false,
                 'invisible' => false,
                 'visibleGridView' => false,
                 'visibleSearch' => false,
                 'blockedVarsForExport' => 
                array (
                ),
                 'maxLength' => NULL,
                 'showCharCount' => false,
                 'excludeFromSearchIndex' => false,
                 'height' => 100,
                 'width' => 450,
              )),
            ),
             'region' => NULL,
             'layout' => NULL,
             'maxTabs' => NULL,
             'border' => false,
             'provideSplitView' => false,
             'tabPosition' => 'top',
             'hideLabelsWhenTabsReached' => NULL,
             'referencedFields' => 
            array (
            ),
             'permissionView' => NULL,
             'permissionEdit' => NULL,
             'labelWidth' => 100,
             'labelAlign' => 'left',
             'fieldDefinitionsCache' => NULL,
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
));
