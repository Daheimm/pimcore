<?php

/**
 * Inheritance: yes
 * Variants: no
 *
 * Fields Summary:
 * - sabotagecatalogrelation [manyToManyRelation]
 * - localizedfields [localizedfields]
 * -- sabotagecategoryname [input]
 */

return \Pimcore\Model\DataObject\ClassDefinition::__set_state(array(
   'dao' => NULL,
   'id' => '11',
   'name' => 'SabotageCategory',
   'title' => '',
   'description' => '',
   'creationDate' => NULL,
   'modificationDate' => 1703124343,
   'userOwner' => 2,
   'userModification' => 2,
   'parentClass' => '',
   'implementsInterfaces' => '',
   'listingParentClass' => '',
   'useTraits' => '',
   'listingUseTraits' => '',
   'encryption' => false,
   'encryptedTables' => 
  array (
  ),
   'allowInherit' => true,
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
         'name' => 'Опції',
         'type' => NULL,
         'region' => NULL,
         'title' => 'Опції',
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
             'name' => 'General Data',
             'type' => NULL,
             'region' => NULL,
             'title' => 'Опис',
             'width' => '',
             'height' => '',
             'collapsible' => false,
             'collapsed' => false,
             'bodyStyle' => '',
             'datatype' => 'layout',
             'children' => 
            array (
              0 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToManyRelation::__set_state(array(
                 'name' => 'sabotagecatalogrelation',
                 'title' => 'Категорія Sabotage (1 рівень)',
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
                 'visibleGridView' => true,
                 'visibleSearch' => true,
                 'blockedVarsForExport' => 
                array (
                ),
                 'classes' => 
                array (
                  0 => 
                  array (
                    'classes' => 'SabotageCatalog',
                  ),
                ),
                 'displayMode' => NULL,
                 'pathFormatterClass' => '',
                 'maxItems' => NULL,
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
                 'enableTextSelection' => false,
                 'width' => '',
                 'height' => '',
              )),
              1 => 
              \Pimcore\Model\DataObject\ClassDefinition\Data\Localizedfields::__set_state(array(
                 'name' => 'localizedfields',
                 'title' => 'Назва',
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
                     'name' => 'sabotagecategoryname',
                     'title' => 'Категорія Саботаж (2 рівень)',
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
                     'width' => 400,
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
            ),
             'locked' => false,
             'blockedVarsForExport' => 
            array (
            ),
             'fieldtype' => 'panel',
             'layout' => '',
             'border' => false,
             'icon' => '',
             'labelWidth' => 150,
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
   'icon' => '/bundles/pimcoreadmin/img/flat-color-icons/parallel_tasks.svg',
   'group' => 'Sabotage',
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
