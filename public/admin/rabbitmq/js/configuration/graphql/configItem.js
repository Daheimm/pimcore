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
    getItems: function() {
        return [this.getGeneral()];
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
});
