<?php

/**
 * Fields Summary:
 * - esters [numeric]
 * - keyingredient [manyToManyObjectRelation]
 * - localizedfields [localizedfields]
 * -- cocktails [input]
 * -- aromatizer [input]
 * -- aminoacids [input]
 * -- botanicals [input]
 * - graperelation [manyToOneRelation]
 * - ginstylename [manyToOneRelation]
 * - cognaclevel [manyToOneRelation]
 * - typerum [manyToOneRelation]
 * - rumstyle [manyToOneRelation]
 * - typetequilarelation [manyToOneRelation]
 * - grinding [checkbox]
 * - premium [checkbox]
 * - fermentable [checkbox]
 * - hasfiltration [checkbox]
 * - hasmaturation [checkbox]
 * - haspasteurization [checkbox]
 */

return \Pimcore\Model\DataObject\Objectbrick\Definition::__set_state(array(
   'dao' => NULL,
   'key' => 'strongAttributes',
   'parentClass' => '',
   'implementsInterfaces' => '',
   'title' => 'Міцна група',
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
         'title' => 'Міцна група',
         'width' => '',
         'height' => '',
         'collapsible' => false,
         'collapsed' => false,
         'bodyStyle' => '',
         'datatype' => 'layout',
         'children' => 
        array (
          0 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Numeric::__set_state(array(
             'name' => 'esters',
             'title' => 'Eфіри',
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
             'minValue' => 0.0,
             'maxValue' => NULL,
             'unique' => false,
             'decimalSize' => NULL,
             'decimalPrecision' => NULL,
             'width' => 220,
             'defaultValueGenerator' => '',
          )),
          1 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToManyObjectRelation::__set_state(array(
             'name' => 'keyingredient',
             'title' => 'Основний інгредієнт',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => false,
             'index' => false,
             'locked' => false,
             'style' => 'float:right; margin-right:1px; ',
             'permissions' => NULL,
             'fieldtype' => '',
             'relationType' => true,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => true,
             'blockedVarsForExport' => 
            array (
            ),
             'classes' => 
            array (
              0 => 
              array (
                'classes' => 'Components',
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
              \Pimcore\Model\DataObject\ClassDefinition\Data\Input::__set_state(array(
                 'name' => 'cocktails',
                 'title' => 'Входить в коктейлі',
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
                 'width' => 825,
                 'defaultValueGenerator' => '',
              )),
              1 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Input::__set_state(array(
                 'name' => 'aromatizer',
                 'title' => 'Ароматизатор',
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
                 'columnLength' => 600,
                 'regex' => '',
                 'regexFlags' => 
                array (
                ),
                 'unique' => false,
                 'showCharCount' => false,
                 'width' => 550,
                 'defaultValueGenerator' => '',
              )),
              2 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Input::__set_state(array(
                 'name' => 'aminoacids',
                 'title' => 'Амінокислоти',
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
                 'width' => 550,
                 'defaultValueGenerator' => '',
              )),
              3 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Input::__set_state(array(
                 'name' => 'botanicals',
                 'title' => 'Основні ботанікали',
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
                 'width' => 550,
                 'defaultValueGenerator' => '',
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
          3 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation::__set_state(array(
             'name' => 'graperelation',
             'title' => 'Сорт винограду',
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
             'width' => 710,
          )),
          4 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation::__set_state(array(
             'name' => 'ginstylename',
             'title' => 'Стиль джину',
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
                'classes' => 'Ginstyle',
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
             'width' => 710,
          )),
          5 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation::__set_state(array(
             'name' => 'cognaclevel',
             'title' => 'Класифікація (коньяк)',
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
                'classes' => 'Cognaclevel',
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
             'width' => 710,
          )),
          6 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation::__set_state(array(
             'name' => 'typerum',
             'title' => 'Вид рому',
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
                'classes' => 'Rumtype',
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
             'width' => 710,
          )),
          7 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation::__set_state(array(
             'name' => 'rumstyle',
             'title' => 'Стиль рому',
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
                'classes' => 'Rumstyle',
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
             'width' => 710,
          )),
          8 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation::__set_state(array(
             'name' => 'typetequilarelation',
             'title' => 'Тип текіли',
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
                'classes' => 'Tequilatype',
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
             'width' => 710,
          )),
          9 => 
          \Pimcore\Model\DataObject\ClassDefinition\Data\Checkbox::__set_state(array(
             'name' => 'grinding',
             'title' => 'Шліфування',
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
             'name' => 'premium',
             'title' => 'Преміальна',
             'tooltip' => 'Преміальна = true (галочка виставлена) 
столова = false (чекбокс порожній) ',
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
             'name' => 'fermentable',
             'title' => 'Бродільний алкоголь',
             'tooltip' => 'З додаванням бродільного алкоголю = true (галочка виставлена) 
без додавання бродільного алкоголю = false (чекбокс порожній) ',
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
             'name' => 'hasfiltration',
             'title' => 'Фільтроване/нефільтроване',
             'tooltip' => 'Фільтроване = true (галочка виставлена) 
Нефільтроване = false (чекбокс порожній) ',
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
             'name' => 'hasmaturation',
             'title' => 'Витримане/невитримане',
             'tooltip' => 'Витримане = true (галочка виставлена) 
Невитримане = false (чекбокс порожній) ',
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
             'name' => 'haspasteurization',
             'title' => 'Пастеризоване/непастеризоване',
             'tooltip' => 'Пастеризоване = true (галочка виставлена) 
Непастеризоване = false (чекбокс порожній) ',
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
