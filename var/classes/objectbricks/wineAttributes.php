<?php

/**
 * Fields Summary:
 * - colorwine [manyToOneRelation]
 * - countrywinename [manyToOneRelation]
 * - regionwinename [manyToOneRelation]
 * - fortifiedwine [manyToOneRelation]
 * - winefeatures [manyToManyObjectRelation]
 * - maturation [input]
 * - tempserving [input]
 * - tempstorage [input]
 * - sugarwine [numeric]
 * - naturalwine [checkbox]
 * - organicwine [checkbox]
 * - biodynamic [checkbox]
 * - kosherwine [checkbox]
 * - veganwine [checkbox]
 * - singlewineyard [checkbox]
 * - winecomposition [manyToManyObjectRelation]
 * - bodyscale [slider]
 * - sweetness [slider]
 * - acidityscale [slider]
 */

return \Pimcore\Model\DataObject\Objectbrick\Definition::__set_state(array(
   'dao' => NULL,
   'key' => 'wineAttributes',
   'parentClass' => '',
   'implementsInterfaces' => '',
   'title' => 'Вино',
   'group' => 'Кастомні (Алкоголь)',
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
         'title' => 'Вино',
         'width' => '',
         'height' => '',
         'collapsible' => false,
         'collapsed' => false,
         'bodyStyle' => '',
         'datatype' => 'layout',
         'children' => 
        array (
          0 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation::__set_state(array(
             'name' => 'colorwine',
             'title' => 'Колір вина (фільтр)',
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
                'classes' => 'Winecolor',
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
             'width' => 500,
          )),
          1 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation::__set_state(array(
             'name' => 'countrywinename',
             'title' => 'Країна вино (фільтр)',
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
                'classes' => 'Winecountry',
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
             'width' => 500,
          )),
          2 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation::__set_state(array(
             'name' => 'regionwinename',
             'title' => 'Регіон вино (фільтр)',
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
                'classes' => 'Wineregions',
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
             'width' => 500,
          )),
          3 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation::__set_state(array(
             'name' => 'fortifiedwine',
             'title' => 'Вид кріпленого (фільтр)',
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
                'classes' => 'Fortified',
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
             'width' => 500,
          )),
          4 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToManyObjectRelation::__set_state(array(
             'name' => 'winefeatures',
             'title' => 'Особливості (фільтр) ',
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
                'classes' => 'Specialwine',
              ),
            ),
             'displayMode' => 'combo',
             'pathFormatterClass' => '',
             'maxItems' => NULL,
             'visibleFields' => 'key',
             'allowToCreateNewObject' => false,
             'allowToClearRelation' => true,
             'optimizedAdminLoading' => false,
             'enableTextSelection' => false,
             'visibleFieldDefinitions' => 
            array (
            ),
             'width' => '',
             'height' => '',
          )),
          5 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Input::__set_state(array(
             'name' => 'maturation',
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
             'columnLength' => 190,
             'regex' => '',
             'regexFlags' => 
            array (
            ),
             'unique' => false,
             'showCharCount' => false,
             'width' => 350,
             'defaultValueGenerator' => '',
          )),
          6 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Input::__set_state(array(
             'name' => 'tempserving',
             'title' => 'Температура подачі',
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
             'width' => 350,
             'defaultValueGenerator' => '',
          )),
          7 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Input::__set_state(array(
             'name' => 'tempstorage',
             'title' => 'Температура зберігання',
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
             'width' => 350,
             'defaultValueGenerator' => '',
          )),
          8 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Numeric::__set_state(array(
             'name' => 'sugarwine',
             'title' => 'Цукор',
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
             'width' => 220,
             'defaultValueGenerator' => '',
          )),
          9 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Checkbox::__set_state(array(
             'name' => 'naturalwine',
             'title' => 'Натуральне',
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
             'defaultValue' => 0,
             'defaultValueGenerator' => '',
          )),
          10 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Checkbox::__set_state(array(
             'name' => 'organicwine',
             'title' => 'Органіка',
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
             'defaultValue' => 0,
             'defaultValueGenerator' => '',
          )),
          11 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Checkbox::__set_state(array(
             'name' => 'biodynamic',
             'title' => 'Біодинаміка',
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
             'defaultValue' => 0,
             'defaultValueGenerator' => '',
          )),
          12 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Checkbox::__set_state(array(
             'name' => 'kosherwine',
             'title' => 'Кошерне',
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
             'defaultValue' => 0,
             'defaultValueGenerator' => '',
          )),
          13 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Checkbox::__set_state(array(
             'name' => 'veganwine',
             'title' => 'Веганське',
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
             'defaultValue' => 0,
             'defaultValueGenerator' => '',
          )),
          14 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Checkbox::__set_state(array(
             'name' => 'singlewineyard',
             'title' => 'Один винний двір',
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
             'defaultValue' => 0,
             'defaultValueGenerator' => '',
          )),
          15 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToManyObjectRelation::__set_state(array(
             'name' => 'winecomposition',
             'title' => 'Сортовий склад',
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
                'classes' => 'Winecomposition',
              ),
            ),
             'displayMode' => 'combo',
             'pathFormatterClass' => '',
             'maxItems' => NULL,
             'visibleFields' => 'winevariety',
             'allowToCreateNewObject' => false,
             'allowToClearRelation' => true,
             'optimizedAdminLoading' => false,
             'enableTextSelection' => false,
             'visibleFieldDefinitions' => 
            array (
            ),
             'width' => '',
             'height' => '',
          )),
          16 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Slider::__set_state(array(
             'name' => 'bodyscale',
             'title' => 'Тіло',
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
             'minValue' => 1.0,
             'maxValue' => 5.0,
             'vertical' => false,
             'increment' => NULL,
             'decimalPrecision' => NULL,
             'height' => '',
             'width' => '',
          )),
          17 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Slider::__set_state(array(
             'name' => 'sweetness',
             'title' => 'Солодкість',
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
             'minValue' => 1.0,
             'maxValue' => 5.0,
             'vertical' => false,
             'increment' => NULL,
             'decimalPrecision' => NULL,
             'height' => '',
             'width' => '',
          )),
          18 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Slider::__set_state(array(
             'name' => 'acidityscale',
             'title' => 'Кислотність',
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
             'minValue' => 1.0,
             'maxValue' => 5.0,
             'vertical' => false,
             'increment' => NULL,
             'decimalPrecision' => NULL,
             'height' => '',
             'width' => '',
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
      'fieldname' => 'alcoholcustomization',
    ),
  ),
));
