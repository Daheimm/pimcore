/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

pimcore.registerNS("pimcore.plugin.queue_custom.configuration.graphql.configItem");
pimcore.plugin.queue_custom.configuration.graphql.configItem = Class.create(pimcore.element.abstract, {

    saveUrl: "/admin/pimcoredatahub/config/save",

    initialize: function (data, parent) {
        this.parent = parent;
        this.data = data;
        this.modificationDate = data.modificationDate;

        this.tab = new Ext.TabPanel({
            activeTab: 0,
            title: this.data.text,
            closable: true,
            deferredRender: false,
            forceLayout: true,
            iconCls: "plugin_pimcore_datahub_icon_" + this.data.type,
            id: "plugin_pimcore_datahub_configpanel_panel_" + data.type,
            buttons: {
                componentCls: 'plugin_pimcore_datahub_statusbar',
                itemId: 'footer'
            },
            defaults: {
                renderer: Ext.util.Format.htmlEncode
            },
        });

        //create sub panels after main panel is generated - to be able to reference it in sub panels
        this.tab.add(this.getItems());
        this.tab.setActiveTab(0);

        this.tab.on("activate", this.tabactivated.bind(this));
        this.tab.on("destroy", this.tabdestroy.bind(this));

        this.parent.configPanel.editPanel.add(this.tab);
        this.parent.configPanel.editPanel.setActiveTab(this.tab);
        this.parent.configPanel.editPanel.updateLayout();

        this.setupChangeDetector();

        this.showInfo();
    },

    getItems: function() {
        return [this.getGeneral(), this.getSchema()];
    },

    openExplorer: function (callbackFn) {
        Ext.Ajax.request({
            url: '/admin/pimcoredatahub/config/get-explorer-url?name=' + this.data.general.name,

            success: function (callbackFn, response, opts) {
                let data = Ext.decode(response.responseText);
                let securityValues = this.securityForm.getForm().getFieldValues();
                let explorerUrl = window.location.origin + data.explorerUrl;
                if (securityValues && securityValues["method"] == "datahub_apikey") {
                    let apiKeys = securityValues["apikey"].split("\n");
                    explorerUrl = explorerUrl + "?apikey=" + apiKeys[0];
                }
                callbackFn(explorerUrl);
            }.bind(this, callbackFn)
        });

    },

    showInfo: function () {

        var footer = this.tab.getDockedComponent('footer');

        footer.removeAll();

        let saveButtonConfig = {
            text: t("save"),
            iconCls: "pimcore_icon_apply",
            handler: this.save.bind(this)
        };
        footer.add(saveButtonConfig);
    },

    tabactivated: function () {
        this.tabdestroyed = false;
    },

    tabdestroy: function () {
        this.tabdestroyed = true;
    },

    getGeneral: function () {


        this.generalForm = new Ext.form.FormPanel({
            bodyStyle: "padding:10px;",
            autoScroll: true,
            defaults: {
                labelWidth: 200,
                width: 600
            },
            border: false,
            title: t("plugin_pimcore_datahub_configpanel_item_general"),
            items: [
                {
                    xtype: "textfield",
                    fieldLabel: t("name"),
                    name: "text",
                    value: this.data.text
                },
                {
                    xtype: "textfield",
                    fieldLabel: t("key"),
                    name: "query",
                    value: this.data.xApiKey,
                },
                {
                    name: "query",
                    fieldLabel: t("query"),
                    xtype: "textfield",
                    height: 100,
                    value: this.data.query
                },
            ]
        });

        return this.generalForm;
    },

    getSchema: function () {
        this.schemaForm = new Ext.form.FormPanel({
            bodyStyle: "padding:10px;",
            autoScroll: true,
            defaults: {
                labelWidth: 200,
                width: 800
            },
            border: false,
            title: t("plugin_pimcore_datahub_configpanel_schema"),
            items: [
                {
                    xtype: 'fieldset',
                    title: t('plugin_pimcore_datahub_graphql_query_schema'),
                    items: [
                        this.querySchemaGrid
                    ]
                }, {
                    xtype: 'fieldset',
                    title: t('plugin_pimcore_datahub_graphql_mutation_schema'),
                    items: [
                        this.mutationSchemaGrid
                    ]
                },
                {
                    xtype: 'fieldset',
                    title: t('plugin_pimcore_datahub_graphql_special_schema'),
                    items: [
                        this.specialSchemaGrid
                    ]
                }
            ]
        });

        return this.schemaForm;
    },

    onAdd: function (type) {
        this.showEntitySelectionDialog(type);
    },

    updateData: function (data, grid) {
    },

    createSchemaStoreAndGrid: function (type) {
        var schemaToolbar = Ext.create('Ext.Toolbar', {
            cls: 'main-toolbar',
            items: [
                {
                    text: t('add'),
                    handler: this.onAdd.bind(this, type),
                    iconCls: "pimcore_icon_add"
                }
            ]
        });

        var fields = ['id', 'columnConfig'];
        if (type == "mutation") {
            fields.push("create");
            fields.push("update");
            fields.push("delete");
        }
        this[type + "SchemaStore"] = Ext.create('Ext.data.Store', {
            reader: {
                type: 'memory'
            },
            fields: fields,
            data: this.data.schema[type + "Entities"]
        });

        var columns = [
            {
                text: t("plugin_pimcore_datahub_configpanel_entity"),
                sortable: true,
                dataIndex: 'id',
                editable: false,
                filter: 'string',
                flex: 1
            }
        ];

        var additionalColumns = ["create", "update", "delete"];
        if (type == "mutation") {
            for (var i = 0; i < additionalColumns.length; i++) {
                var checkColumn = Ext.create('Ext.grid.column.Check', {
                    text: t(additionalColumns[i]),
                    dataIndex: additionalColumns[i]
                });
                columns.push(checkColumn);
            }
        }

        columns.push({
            xtype: 'actioncolumn',
            text: t('settings'),
            menuText: t('settings'),
            width: 60,
            items: [
                {
                    tooltip: t('settings'),
                    icon: "/bundles/pimcoreadmin/img/flat-color-icons/settings.svg",
                    handler: function (grid, rowIndex) {
                        var record = grid.getStore().getAt(rowIndex);

                        var classStore = pimcore.globalmanager.get("object_types_store");
                        var classIdx = classStore.findExact("text", record.data.id);
                        if (classIdx >= 0) {
                            var classRecord = classStore.getAt(classIdx);
                            classId = classRecord.data.id;
                            var columnConfig = record.get("columnConfig");

                            var dialog = new pimcore.plugin.datahub.fieldConfigDialog(type, {
                                    className: classRecord.data.text,
                                    classId: classId
                                },
                                columnConfig,
                                function (data, settings) {
                                    record.set('columnConfig', data);
                                }, null);
                        }
                    }.bind(this)
                }]
        });

        columns.push({
            xtype: 'actioncolumn',
            text: t('delete'),
            menuText: t('delete'),
            width: 60,
            items: [{
                tooltip: t('delete'),
                icon: "/bundles/pimcoreadmin/img/flat-color-icons/delete.svg",
                handler: function (grid, rowIndex) {
                    grid.getStore().removeAt(rowIndex);
                }.bind(this)
            }
            ]
        });

        var prop = type + "SchemaGrid";
        this[prop] = Ext.create('Ext.grid.Panel', {
            frame: false,
            bodyCls: "pimcore_editable_grid",
            autoScroll: true,
            store: this[type + "SchemaStore"],
            columnLines: true,
            stripeRows: true,
            columns: {
                items: columns
            },
            trackMouseOver: true,
            selModel: Ext.create('Ext.selection.RowModel', {}),
            tbar: schemaToolbar,
            viewConfig: {
                forceFit: true,
                enableTextSelection: true
            }
        });

    },

    createSpecialSettingsGrid: function () {
        var schemaToolbar = Ext.create('Ext.Toolbar', {
            cls: 'main-toolbar'
        });

        var fields = ['id', 'create', 'read', 'update', 'delete'];

        this.specialSchemaStore = Ext.create('Ext.data.Store', {
            reader: {
                type: 'memory'
            },
            fields: fields,
            data: this.data.schema.specialEntities
        });

        var columns = [
            {
                sortable: true,
                dataIndex: 'name',
                editable: false,
                filter: 'string',
                renderer: function (v) {
                    return t("plugin_pimcore_datahub_graphql_special_" + v);
                },
                flex: 1
            }
        ];

        var additionalColumns = ["create", "read", "update", "delete"];

        for (var i = 0; i < additionalColumns.length; i++) {
            var checkColumn = Ext.create('Ext.grid.column.Check', {
                text: t(additionalColumns[i]),
                dataIndex: additionalColumns[i] + 'Allowed',
                operationIndex: additionalColumns[i],
                listeners: {
                    beforecheckchange: function (checkCol, rowIndex, checked) {
                        var store = this.specialSchemaGrid.getStore();
                        var record = store.getAt(rowIndex);
                        var possibleValue = checkCol.operationIndex + 'Possible';

                        if (!record.get(possibleValue)) {
                            pimcore.helpers.showNotification(t("info"), "Operation is not implemented.");
                            return false;
                        }

                        return true;
                    }.bind(this)}
            });
            columns.push(checkColumn);
        }

        this.specialSchemaGrid = Ext.create('Ext.grid.Panel', {
            frame: false,
            bodyCls: "pimcore_editable_grid",
            autoScroll: true,
            store: this.specialSchemaStore,
            columnLines: true,
            stripeRows: true,
            columns: {
                items: columns
            },
            trackMouseOver: true,
            tbar: schemaToolbar,
            viewConfig: {
                forceFit: true,
                enableTextSelection: true
            }
        });
    },

    getSaveDataArray: function () {
        var saveData = {};
        saveData["general"] = this.generalForm.getForm().getFieldValues(false, false);
        return saveData;
    },

    getSaveData: function () {
        return Ext.encode(this.getSaveDataArray());
    },

    getSchemaData: function (type) {
        var tmData = [];

        var store = this[type + "SchemaStore"];
        var data = store.queryBy(function (record, id) {
            return true;
        });

        for (var i = 0; i < data.items.length; i++) {
            tmData.push(data.items[i].data);
        }

        return tmData;
    },

    save: function () {
        const saveData = this.getSaveData();
        Ext.Ajax.request({
            url: this.saveUrl,
            params: {
                data: saveData,
                modificationDate: this.modificationDate
            },
            method: "post",
            success: function (response) {
                const rdata = Ext.decode(response.responseText);
                if (rdata && rdata.success) {
                    this.modificationDate = rdata.modificationDate;
                    this.saveOnComplete();
                }
            }.bind(this)
        });
    },

    saveOnComplete: function () {
        this.parent.configPanel.tree.getStore().load({
            node: this.parent.configPanel.tree.getRootNode()
        });

        pimcore.helpers.showNotification(t("success"), t("plugin_pimcore_datahub_configpanel_item_save_success"), "success");

        this.resetChanges();
    },

    showEntitySelectionDialog: function (type) {

        var store = this[type + "SchemaStore"];
        this.entitySelectionDialog = new Ext.Window({
            autoHeight: true,
            title: t('plugin_pimcore_datahub_operator_select_entity'),
            closeAction: 'close',
            width: 500,
            modal: true
        });

        var entityStore = new Ext.data.JsonStore({
            proxy: {
                url: '/admin/class/get-tree',
                type: 'ajax',
                reader: {
                    type: 'json',
                    idProperty: 'text'
                }
            },
            fields: ['id'],
            autoDestroy: true,
            autoLoad: true,
            sortInfo: {field: 'id', direction: "ASC"}
        });

        var entityCombo = new Ext.form.ComboBox(
            {
                xtype: "combo",
                fieldLabel: t("plugin_pimcore_datahub_configpanel_entity"),
                store: entityStore,
                triggerAction: 'all',
                editable: false,
                width: 450
            }
        );

        var form = new Ext.form.FormPanel({
            bodyStyle: 'padding: 10px;',
            items: [entityCombo],
            bbar: [
                "->",
                {
                    xtype: "button",
                    text: t("OK"),
                    iconCls: "pimcore_icon_bool",
                    handler: function () {
                        var entity = entityCombo.getValue();
                        if (entity) {
                            var record = store.getById(entity);
                            if (!record) {
                                var newData = {
                                    id: entity,
                                    name: entity
                                };
                                if (type == "mutation") {
                                    newData["update"] = true;
                                }
                                var addedRecord = store.addSorted(newData);
                                addedRecord = addedRecord[0];
                                this[type + "SchemaGrid"].getSelectionModel().select([addedRecord]);
                            }
                        }

                        this.entitySelectionDialog.close();

                    }.bind(this)
                },
                {
                    xtype: "button",
                    text: t("cancel"),
                    iconCls: "pimcore_icon_cancel",
                    handler: function () {
                        this.entitySelectionDialog.close();
                    }.bind(this)
                }]
        });

        this.entitySelectionDialog.add(form);
        this.entitySelectionDialog.show();
    },

    _confirmDirtyClose: function () {
        Ext.MessageBox.confirm(
            t("element_has_unsaved_changes"),
            t("element_unsaved_changes_message"),
            function (buttonValue) {
                if (buttonValue === "yes") {
                    this._confirmedDirtyClose = true;

                    this.tab.fireEventedAction("close", [this.tab, {}]);
                    this.parent.configPanel.editPanel.remove(this.tab);
                }
            }.bind(this)
        );
    }
});
