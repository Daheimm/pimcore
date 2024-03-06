<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - active [checkbox]
 * - infoblockname [input]
 * - infoblocktype [select]
 * - banner3 [objectbricks]
 * - hidetitle [checkbox]
 * - hideframe [checkbox]
 * - titlecolor [select]
 * - templatehtml [select]
 * - gamma [select]
 * - style [select]
 * - format [select]
 * - backgroundimage [select]
 * - backconversion [select]
 * - percentageimage [select]
 * - percentconversion [select]
 * - percentlocation [select]
 * - buttonlocation [select]
 * - fotobanner [hotspotimage]
 * - videobanner [video]
 */

return \Pimcore\Model\DataObject\ClassDefinition::__set_state(array(
   'dao' => NULL,
   'id' => '14',
   'name' => 'Infoblocks',
   'title' => '',
   'description' => '',
   'creationDate' => NULL,
   'modificationDate' => 1700487572,
   'userOwner' => 2,
   'userModification' => 2,
   'parentClass' => 'Pimcore\\Model\\DataObject\\Banners',
   'implementsInterfaces' => '',
   'listingParentClass' => '',
   'useTraits' => '',
   'listingUseTraits' => '',
   'encryption' => false,
   'encryptedTables' => 
  array (
  ),
   'allowInherit' => false,
   'allowVariants' => false,
   'showVariants' => false,
   'layoutDefinitions' => 
  \Pimcore\Model\DataObject\ClassDefinition\Layout\Panel::__set_state(array(
     'name' => 'pimcore_root',
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
      \Pimcore\Model\DataObject\ClassDefinition\Layout\Tabpanel::__set_state(array(
         'name' => 'Картка інфоблоку',
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
          \Pimcore\Model\DataObject\ClassDefinition\Layout\Panel::__set_state(array(
             'name' => 'General Info',
             'type' => NULL,
             'region' => NULL,
             'title' => 'Основні',
             'width' => '',
             'height' => '',
             'collapsible' => false,
             'collapsed' => false,
             'bodyStyle' => '',
             'datatype' => 'layout',
             'children' => 
            array (
              0 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Checkbox::__set_state(array(
                 'name' => 'active',
                 'title' => 'Активний',
                 'tooltip' => '',
                 'mandatory' => false,
                 'noteditable' => false,
                 'index' => false,
                 'locked' => false,
                 'style' => 'float: right; margin-left:20px;',
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
              1 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Input::__set_state(array(
                 'name' => 'infoblockname',
                 'title' => 'Назва інфоблоку',
                 'tooltip' => '',
                 'mandatory' => true,
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
                 'width' => 400,
                 'defaultValueGenerator' => '',
              )),
              2 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Select::__set_state(array(
                 'name' => 'infoblocktype',
                 'title' => 'Тип інфоблоку',
                 'tooltip' => '',
                 'mandatory' => true,
                 'noteditable' => false,
                 'index' => false,
                 'locked' => false,
                 'style' => '',
                 'permissions' => NULL,
                 'fieldtype' => '',
                 'relationType' => false,
                 'invisible' => false,
                 'visibleGridView' => true,
                 'visibleSearch' => false,
                 'blockedVarsForExport' => 
                array (
                ),
                 'options' => 
                array (
                  0 => 
                  array (
                    'key' => 'Три банери',
                    'value' => '1',
                  ),
                  1 => 
                  array (
                    'key' => 'Бестселлери',
                    'value' => '2',
                  ),
                  2 => 
                  array (
                    'key' => 'Карусель персональні пропозиції',
                    'value' => '3',
                  ),
                ),
                 'defaultValue' => '',
                 'optionsProviderClass' => '',
                 'optionsProviderData' => '',
                 'columnLength' => 190,
                 'dynamicOptions' => false,
                 'defaultValueGenerator' => '',
                 'width' => 300,
              )),
              3 => 
              \Pimcore\Model\DataObject\ClassDefinition\Layout\Panel::__set_state(array(
                 'name' => 'Layout',
                 'type' => NULL,
                 'region' => NULL,
                 'title' => 'Типізція та вміст банеру',
                 'width' => '',
                 'height' => '',
                 'collapsible' => false,
                 'collapsed' => false,
                 'bodyStyle' => '',
                 'datatype' => 'layout',
                 'children' => 
                array (
                  0 => 
                  \Pimcore\Model\DataObject\ClassDefinition\Layout\Text::__set_state(array(
                     'name' => 'Layout',
                     'type' => NULL,
                     'region' => NULL,
                     'title' => '',
                     'width' => 0,
                     'height' => 0,
                     'collapsible' => false,
                     'collapsed' => false,
                     'bodyStyle' => 'padding: 10px; background-color: #d9edf7; border-color: #bce8f1 !important; color: #31708f;',
                     'datatype' => 'layout',
                     'children' => 
                    array (
                    ),
                     'locked' => false,
                     'blockedVarsForExport' => 
                    array (
                    ),
                     'fieldtype' => 'text',
                     'html' => 'Вкажіть тип інфоблоку та оберіть що саме буде відображатися при переході на цей банер.',
                     'renderingClass' => '',
                     'renderingData' => '',
                     'border' => false,
                  )),
                  1 => 
                  \Pimcore\Model\DataObject\ClassDefinition\Layout\Tabpanel::__set_state(array(
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
                      \Pimcore\Model\DataObject\ClassDefinition\Layout\Fieldset::__set_state(array(
                         'name' => 'Три банери',
                         'type' => NULL,
                         'region' => NULL,
                         'title' => 'Три банери',
                         'width' => '',
                         'height' => '',
                         'collapsible' => false,
                         'collapsed' => false,
                         'bodyStyle' => '',
                         'datatype' => 'layout',
                         'children' => 
                        array (
                          0 => 
                          \Pimcore\Model\DataObject\ClassDefinition\Data\Objectbricks::__set_state(array(
                             'name' => 'banner3',
                             'title' => 'Оберіть один із запропонованих варіантів вмісту банера',
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
                             'allowedTypes' => 
                            array (
                              0 => 'banner3category',
                              1 => 'banner3products',
                              2 => 'banner3subcategory',
                              3 => 'banner3link',
                              4 => 'banner3manufacturer',
                            ),
                             'maxItems' => 1,
                             'border' => false,
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
                      1 => 
                      \Pimcore\Model\DataObject\ClassDefinition\Layout\Fieldset::__set_state(array(
                         'name' => 'Бестселлери',
                         'type' => NULL,
                         'region' => NULL,
                         'title' => 'Бестселлери',
                         'width' => '',
                         'height' => '',
                         'collapsible' => false,
                         'collapsed' => false,
                         'bodyStyle' => '',
                         'datatype' => 'layout',
                         'children' => 
                        array (
                        ),
                         'locked' => false,
                         'blockedVarsForExport' => 
                        array (
                        ),
                         'fieldtype' => 'fieldset',
                         'labelWidth' => 100,
                         'labelAlign' => 'left',
                      )),
                      2 => 
                      \Pimcore\Model\DataObject\ClassDefinition\Layout\Fieldset::__set_state(array(
                         'name' => 'Карусель',
                         'type' => NULL,
                         'region' => NULL,
                         'title' => 'Карусель персональні пропозиції',
                         'width' => '',
                         'height' => '',
                         'collapsible' => false,
                         'collapsed' => false,
                         'bodyStyle' => '',
                         'datatype' => 'layout',
                         'children' => 
                        array (
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
                     'fieldtype' => 'tabpanel',
                     'border' => false,
                     'tabPosition' => 'top',
                  )),
                ),
                 'locked' => false,
                 'blockedVarsForExport' => 
                array (
                ),
                 'fieldtype' => 'panel',
                 'layout' => NULL,
                 'border' => false,
                 'icon' => '',
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
             'icon' => '',
             'labelWidth' => 100,
             'labelAlign' => 'left',
          )),
          1 => 
          \Pimcore\Model\DataObject\ClassDefinition\Layout\Panel::__set_state(array(
             'name' => 'Layout',
             'type' => NULL,
             'region' => NULL,
             'title' => 'Конструктор банеру',
             'width' => '',
             'height' => '',
             'collapsible' => false,
             'collapsed' => false,
             'bodyStyle' => '',
             'datatype' => 'layout',
             'children' => 
            array (
              0 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Checkbox::__set_state(array(
                 'name' => 'hidetitle',
                 'title' => 'Приховати заголовок',
                 'tooltip' => '',
                 'mandatory' => false,
                 'noteditable' => false,
                 'index' => false,
                 'locked' => false,
                 'style' => 'float:left; margin-left:20px;',
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
              1 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Checkbox::__set_state(array(
                 'name' => 'hideframe',
                 'title' => 'Приховати рамку',
                 'tooltip' => '',
                 'mandatory' => false,
                 'noteditable' => false,
                 'index' => false,
                 'locked' => false,
                 'style' => 'float:left; margin-left:20px;',
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
              2 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Select::__set_state(array(
                 'name' => 'titlecolor',
                 'title' => 'Колір заголовку',
                 'tooltip' => '',
                 'mandatory' => false,
                 'noteditable' => false,
                 'index' => false,
                 'locked' => false,
                 'style' => 'float: right; margin-left:20px;',
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
                    'key' => 'Білий',
                    'value' => '#FFFFFF',
                  ),
                  1 => 
                  array (
                    'key' => 'Чорний',
                    'value' => '#000000',
                  ),
                  2 => 
                  array (
                    'key' => 'Червоний',
                    'value' => '#FF0000',
                  ),
                  3 => 
                  array (
                    'key' => 'Блакитний',
                    'value' => '#4682B4',
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
              3 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Select::__set_state(array(
                 'name' => 'templatehtml',
                 'title' => 'Шаблон HTML',
                 'tooltip' => '',
                 'mandatory' => false,
                 'noteditable' => false,
                 'index' => false,
                 'locked' => false,
                 'style' => 'float: right; margin-left:20px;',
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
                    'key' => 'Квадрат',
                    'value' => '000000005',
                  ),
                  1 => 
                  array (
                    'key' => 'Персональні акції',
                    'value' => '000000004',
                  ),
                  2 => 
                  array (
                    'key' => 'Прямокутник',
                    'value' => '000000003',
                  ),
                  3 => 
                  array (
                    'key' => 'Прямокутник без кнопки',
                    'value' => '000000002',
                  ),
                  4 => 
                  array (
                    'key' => 'Прямокутник з написом',
                    'value' => '000000001',
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
              4 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Select::__set_state(array(
                 'name' => 'gamma',
                 'title' => 'Гамма',
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
                    'key' => 'Темна',
                    'value' => 'Темна',
                  ),
                  1 => 
                  array (
                    'key' => 'Світла',
                    'value' => 'Світла',
                  ),
                ),
                 'defaultValue' => '',
                 'optionsProviderClass' => '',
                 'optionsProviderData' => '',
                 'columnLength' => 190,
                 'dynamicOptions' => false,
                 'defaultValueGenerator' => '',
                 'width' => 300,
              )),
              5 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Select::__set_state(array(
                 'name' => 'style',
                 'title' => 'Стиль',
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
                    'key' => 'картинка зі сховища s3 (заглушка)',
                    'value' => 'картинка зі сховища s3 (заглушка)',
                  ),
                ),
                 'defaultValue' => '',
                 'optionsProviderClass' => '',
                 'optionsProviderData' => '',
                 'columnLength' => 190,
                 'dynamicOptions' => false,
                 'defaultValueGenerator' => '',
                 'width' => 300,
              )),
              6 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Select::__set_state(array(
                 'name' => 'format',
                 'title' => 'Формат',
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
                    'key' => 'Прямокутник',
                    'value' => 'Прямокутник',
                  ),
                  1 => 
                  array (
                    'key' => 'Квадрат',
                    'value' => 'Квадрат',
                  ),
                ),
                 'defaultValue' => '',
                 'optionsProviderClass' => '',
                 'optionsProviderData' => '',
                 'columnLength' => 190,
                 'dynamicOptions' => false,
                 'defaultValueGenerator' => '',
                 'width' => 300,
              )),
              7 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Select::__set_state(array(
                 'name' => 'backgroundimage',
                 'title' => 'Фонове зображення',
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
                    'key' => 'картинка зі сховища s3 (заглушка)',
                    'value' => 'картинка зі сховища s3 (заглушка)',
                  ),
                ),
                 'defaultValue' => '',
                 'optionsProviderClass' => '',
                 'optionsProviderData' => '',
                 'columnLength' => 190,
                 'dynamicOptions' => false,
                 'defaultValueGenerator' => '',
                 'width' => 300,
              )),
              8 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Select::__set_state(array(
                 'name' => 'backconversion',
                 'title' => 'Шаблон конвертації фон',
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
                    'key' => 'треба довідник форматів (заглушка)',
                    'value' => 'треба довідник форматів (заглушка)',
                  ),
                ),
                 'defaultValue' => '',
                 'optionsProviderClass' => '',
                 'optionsProviderData' => '',
                 'columnLength' => 190,
                 'dynamicOptions' => false,
                 'defaultValueGenerator' => '',
                 'width' => 300,
              )),
              9 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Select::__set_state(array(
                 'name' => 'percentageimage',
                 'title' => 'Зображення проценту',
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
                    'key' => 'картинка зі сховища s3 (заглушка)',
                    'value' => 'картинка зі сховища s3 (заглушка)',
                  ),
                ),
                 'defaultValue' => '',
                 'optionsProviderClass' => '',
                 'optionsProviderData' => '',
                 'columnLength' => 190,
                 'dynamicOptions' => false,
                 'defaultValueGenerator' => '',
                 'width' => 300,
              )),
              10 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Select::__set_state(array(
                 'name' => 'percentconversion',
                 'title' => 'Шаблон конвертації процента',
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
                    'key' => 'треба довідник форматів (заглушка)',
                    'value' => 'треба довідник форматів (заглушка)',
                  ),
                ),
                 'defaultValue' => '',
                 'optionsProviderClass' => '',
                 'optionsProviderData' => '',
                 'columnLength' => 190,
                 'dynamicOptions' => false,
                 'defaultValueGenerator' => '',
                 'width' => 300,
              )),
              11 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Select::__set_state(array(
                 'name' => 'percentlocation',
                 'title' => 'Розміщення процента',
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
                    'key' => 'По центру',
                    'value' => 'По центру',
                  ),
                  1 => 
                  array (
                    'key' => 'Праворуч',
                    'value' => 'Праворуч',
                  ),
                  2 => 
                  array (
                    'key' => 'Ліворуч',
                    'value' => 'Ліворуч',
                  ),
                ),
                 'defaultValue' => '',
                 'optionsProviderClass' => '',
                 'optionsProviderData' => '',
                 'columnLength' => 190,
                 'dynamicOptions' => false,
                 'defaultValueGenerator' => '',
                 'width' => 300,
              )),
              12 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Select::__set_state(array(
                 'name' => 'buttonlocation',
                 'title' => 'Розміщення кнопки',
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
                    'key' => 'Варіантів немає (заглушка)',
                    'value' => 'Варіантів немає (заглушка)',
                  ),
                ),
                 'defaultValue' => '',
                 'optionsProviderClass' => '',
                 'optionsProviderData' => '',
                 'columnLength' => 190,
                 'dynamicOptions' => false,
                 'defaultValueGenerator' => '',
                 'width' => 300,
              )),
            ),
             'locked' => false,
             'blockedVarsForExport' => 
            array (
            ),
             'fieldtype' => 'panel',
             'layout' => NULL,
             'border' => false,
             'icon' => '',
             'labelWidth' => 100,
             'labelAlign' => 'left',
          )),
          2 => 
          \Pimcore\Model\DataObject\ClassDefinition\Layout\Panel::__set_state(array(
             'name' => 'Media',
             'type' => NULL,
             'region' => NULL,
             'title' => 'Медіа',
             'width' => '',
             'height' => '',
             'collapsible' => false,
             'collapsed' => false,
             'bodyStyle' => '',
             'datatype' => 'layout',
             'children' => 
            array (
              0 => 
              \Pimcore\Model\DataObject\ClassDefinition\Layout\Text::__set_state(array(
                 'name' => 'Layout',
                 'type' => NULL,
                 'region' => NULL,
                 'title' => '',
                 'width' => 0,
                 'height' => 0,
                 'collapsible' => false,
                 'collapsed' => false,
                 'bodyStyle' => 'padding: 10px; background-color: #d9edf7; border-color: #bce8f1 !important; color: #31708f;',
                 'datatype' => 'layout',
                 'children' => 
                array (
                ),
                 'locked' => false,
                 'blockedVarsForExport' => 
                array (
                ),
                 'fieldtype' => 'text',
                 'html' => 'Завантажте фото або відео для банера',
                 'renderingClass' => '',
                 'renderingData' => '',
                 'border' => false,
              )),
              1 => 
              \Pimcore\Model\DataObject\ClassDefinition\Layout\Tabpanel::__set_state(array(
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
                  \Pimcore\Model\DataObject\ClassDefinition\Layout\Fieldset::__set_state(array(
                     'name' => 'Layout',
                     'type' => NULL,
                     'region' => NULL,
                     'title' => 'Додати фото',
                     'width' => '',
                     'height' => '',
                     'collapsible' => false,
                     'collapsed' => false,
                     'bodyStyle' => '',
                     'datatype' => 'layout',
                     'children' => 
                    array (
                      0 => 
                      \Pimcore\Model\DataObject\ClassDefinition\Data\Hotspotimage::__set_state(array(
                         'name' => 'fotobanner',
                         'title' => 'Додати фото',
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
                         'predefinedDataTemplates' => '',
                         'uploadPath' => '',
                         'width' => 500,
                         'height' => 350,
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
                  1 => 
                  \Pimcore\Model\DataObject\ClassDefinition\Layout\Fieldset::__set_state(array(
                     'name' => 'Layout',
                     'type' => NULL,
                     'region' => NULL,
                     'title' => 'Додати відео',
                     'width' => '',
                     'height' => '',
                     'collapsible' => false,
                     'collapsed' => false,
                     'bodyStyle' => '',
                     'datatype' => 'layout',
                     'children' => 
                    array (
                      0 => 
                      \Pimcore\Model\DataObject\ClassDefinition\Data\Video::__set_state(array(
                         'name' => 'videobanner',
                         'title' => 'Додати відео',
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
                         'uploadPath' => '',
                         'allowedTypes' => 
                        array (
                          0 => 'asset',
                          1 => 'youtube',
                          2 => 'dailymotion',
                        ),
                         'supportedTypes' => 
                        array (
                          0 => 'asset',
                          1 => 'youtube',
                          2 => 'vimeo',
                          3 => 'dailymotion',
                        ),
                         'height' => 350,
                         'width' => 500,
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
                 'fieldtype' => 'tabpanel',
                 'border' => false,
                 'tabPosition' => 'top',
              )),
            ),
             'locked' => false,
             'blockedVarsForExport' => 
            array (
            ),
             'fieldtype' => 'panel',
             'layout' => NULL,
             'border' => false,
             'icon' => '',
             'labelWidth' => 100,
             'labelAlign' => 'left',
          )),
        ),
         'locked' => false,
         'blockedVarsForExport' => 
        array (
        ),
         'fieldtype' => 'tabpanel',
         'border' => false,
         'tabPosition' => 'top',
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
   'icon' => '/bundles/pimcoreadmin/img/flat-color-icons/gift.svg',
   'group' => 'Info Вlocks',
   'showAppLoggerTab' => false,
   'linkGeneratorReference' => '',
   'previewGeneratorReference' => '',
   'compositeIndices' => 
  array (
  ),
   'showFieldLookup' => false,
   'propertyVisibility' => 
  array (
    'grid' => 
    array (
      'id' => true,
      'key' => false,
      'path' => true,
      'published' => true,
      'modificationDate' => true,
      'creationDate' => true,
    ),
    'search' => 
    array (
      'id' => true,
      'key' => false,
      'path' => true,
      'published' => true,
      'modificationDate' => true,
      'creationDate' => true,
    ),
  ),
   'enableGridLocking' => false,
   'deletedDataComponents' => 
  array (
  ),
   'blockedVarsForExport' => 
  array (
  ),
   'fieldDefinitionsCache' => 
  array (
  ),
   'activeDispatchingEvents' => 
  array (
  ),
));
