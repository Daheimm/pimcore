pimcore.registerNS("pimcore.plugin.queue_custom.configuration.graphql.configItem");

pimcore.plugin.queue_custom.configuration.graphql.configItem = Class.create(pimcore.element.abstract, {

    saveUrl: "/admin-custom/setting-queries",

    initialize: function (data, parent) {
        console.log(parent);
        this.parent = parent;
        this.data = data;
        this.modificationDate = data.modificationDate;

        this.tab = new Ext.TabPanel({
            activeTab: 0,
            title: this.data.text,
            closable: true,
            deferredRender: false,
            forceLayout: true,
            iconCls: "plugin_pimcore_queue_custom_icon_" + this.data.type,
            id: "plugin_pimcore_queue_custom_configpanel_panel_" + this.data.id,
            buttons: {
                componentCls: 'plugin_pimcore_queue_custom_statusbar',
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
            title: t("Settings Queue"),
            items: [
                {
                    xtype: "numberfield",
                    fieldLabel: t("id"),
                    name: "id",
                    readOnly: true,
                    value: this.data.id
                },
                {
                    xtype: "textfield",
                    fieldLabel: t("name"),
                    name: "text",
                    maxLength: 100,
                    allowBlank: false,
                    value: this.data.text
                },
                {
                    xtype: "textfield",
                    fieldLabel: t("Type"),
                    name: "type",
                    maxLength: 100,
                    allowBlank: false,
                    value: this.data.type
                },
                {
                    xtype: "textfield",
                    fieldLabel: t("xApiKey"),
                    name: "xApiKey",
                    maxLength: 100,
                    allowBlank: false,
                    value: this.data.xApiKey,
                },
                {
                    name: "query",
                    fieldLabel: t("GraphQL"),
                    xtype: "textarea",
                    height: 100,
                    allowBlank: false,
                    value: this.data.query
                },
            ]
        });

        return this.generalForm;
    },
    getItems: function () {
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

        let checkButtonConfig = {
            text: t("check"),
            iconCls: "pimcore_icon_inspect",
            handler: function() {
                this.checkData();
            }.bind(this) // Пам'ятайте правильно зв'язати контекст `this`
        };

        footer.add(checkButtonConfig);
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
        saveData = this.generalForm.getForm().getFieldValues(false, false);
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

        var form = this.generalForm.getForm(); // Отримуємо форму
        if (!form.isValid()) { // Перевіряємо валідність
            var errors = [];
            form.getFields().each(function(field) {
                if (!field.isValid()) { // Якщо поле не валідне
                    errors.push(field.getFieldLabel() + ": " + field.getErrors().join(", ")); // Збираємо інформацію про помилки
                }
            });

            // Показуємо повідомлення з переліком помилок
            pimcore.helpers.showNotification(t("error"),  errors.join("; "), "error");
            return;
        }

        const saveData = this.getSaveData();
        Ext.Ajax.request({
            url: this.saveUrl,
            params: {
                data: saveData,
                modificationDate: this.modificationDate
            },
            method: "PUT",
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

        pimcore.helpers.showNotification(t("success"), t("saved"), "success");

        this.resetChanges();
    },
});
