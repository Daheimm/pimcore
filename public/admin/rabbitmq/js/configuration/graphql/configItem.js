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
                    value: this.data.id,
                },
                {
                    xtype: "textfield",
                    fieldLabel: t("name"),
                    name: "text",
                    maxLength: 100,
                    allowBlank: false,
                    value: this.data.text,
                    listeners: {
                        afterrender: function (field) {
                            Ext.tip.QuickTipManager.register({
                                target: field.getId(), // Використовуємо ID поля як ціль для вспливаючої підказки
                                text: 'Буде відображатися в черзі як поле name:{}' // Текст вспливаючої підказки
                            });
                        },
                        destroy: function (field) {
                            Ext.tip.QuickTipManager.unregister(field.getId()); // Прибираємо вспливаючу підказку при знищенні поля
                        }
                    }
                },
                {
                    xtype: 'combobox',
                    fieldLabel: t("Type"),
                    name: 'type',
                    store: Ext.create('Ext.data.Store', {
                        fields: ['id', 'name', 'active'],
                        data: this.data.type // Тут передаємо дані отримані з API
                    }),
                    displayField: 'name',
                    valueField: 'id',
                    queryMode: 'local',
                    typeAhead: true,
                    allowBlank: false,
                    forceSelection: true,
                    listeners: {
                        beforerender: function (combo) {
                            var activeItem = combo.getStore().findRecord('active', true);
                            if (activeItem) {
                                combo.setValue(activeItem.get('id'));
                            }
                        },
                        afterrender: function (field) {
                            Ext.tip.QuickTipManager.register({
                                target: field.getId(), // Використовуємо ID поля як ціль для вспливаючої підказки
                                text: 'Вибираєте обьект, на котрий буде виконан запит до графа при зміни,створенні,видалені.' // Текст вспливаючої підказки
                            });
                        },
                        destroy: function (field) {
                            Ext.tip.QuickTipManager.unregister(field.getId()); // Прибираємо вспливаючу підказку при знищенні поля
                        }
                    }
                },
                {
                    xtype: 'textfield',
                    fieldLabel: t("Path"),
                    name: 'folderPath',
                    readOnly: true,
                    value: this.data.folderPath,
                    fieldCls: "pimcore_property_droptarget", // Додаємо клас для візуалізації приймача перетягування
                    listeners: {
                        afterrender: function (field) {
                            // Ініціалізація DropZone після рендеру поля
                            var dropZone = new Ext.dd.DropZone(field.bodyEl, {
                                // Вказуємо ddGroup для перетягуваних елементів
                                ddGroup: 'element',

                                // Функція для отримання цілі з події
                                getTargetFromEvent: function(e) {
                                    return field.bodyEl.dom;
                                },

                                // Подія при наведенні елемента над зоною
                                onNodeOver : function(target, dd, e, data) {
                                    return Ext.dd.DropZone.prototype.dropAllowed;
                                },

                                // Подія при скиданні елемента у зону
                                onNodeDrop : function(target, dd, e, data) {
                                    // Логіка для обробки перетягнутого об'єкта
                                    // Приклад: встановлення шляху перетягнутого об'єкта до поля
                                    if (data && data.records && data.records[0]) {
                                        var record = data.records[0];
                                        var path = record.get("path"); // Або будь-яке відповідне поле з об'єкта record
                                        field.setValue(path); // Встановлення шляху до поля
                                        return true;
                                    }
                                    return false;
                                },

                            });
                        }
                    }
                },
                {
                    xtype: "textfield",
                    fieldLabel: t("Endpoint"),
                    name: "endpoint",
                    maxLength: 200,
                    allowBlank: false,
                    value: this.data.endpoint,
                    listeners: {
                        afterrender: function (field) {
                            Ext.tip.QuickTipManager.register({
                                target: field.getId(), // Використовуємо ID поля як ціль для вспливаючої підказки
                                text: 'При створенні доступів в DataHub вам буде надано url, повнустю вставте його в цек поле, а нього будуть йти запити графа.' // Текст вспливаючої підказки
                            });
                        },
                        destroy: function (field) {
                            Ext.tip.QuickTipManager.unregister(field.getId()); // Прибираємо вспливаючу підказку при знищенні поля
                        }
                    }
                },
                {
                    xtype: "textfield",
                    fieldLabel: t("xApiKey"),
                    name: "xApiKey",
                    maxLength: 100,
                    allowBlank: false,
                    value: this.data.xApiKey,
                    listeners: {
                        afterrender: function (field) {
                            Ext.tip.QuickTipManager.register({
                                target: field.getId(), // Використовуємо ID поля як ціль для вспливаючої підказки
                                text: 'Ключ доступу до графа повинен мати всі права' // Текст вспливаючої підказки
                            });
                        },
                        destroy: function (field) {
                            Ext.tip.QuickTipManager.unregister(field.getId()); // Прибираємо вспливаючу підказку при знищенні поля
                        }
                    }
                },
                {
                    name: "query",
                    fieldLabel: t("GraphQL"),
                    xtype: "textarea",
                    height: 100,
                    allowBlank: false,
                    value: this.data.query,
                    listeners: {
                        afterrender: function (field) {
                            Ext.tip.QuickTipManager.register({
                                target: field.getId(), // Використовуємо ID поля як ціль для вспливаючої підказки
                                text: 'Перед вставкою в граф,перевірте його через постман або datahub,якщо ви використовуєте ідентифікатор для отримання, позначьте його як параметр $$id' // Текст вспливаючої підказки
                            });
                        },
                        destroy: function (field) {
                            Ext.tip.QuickTipManager.unregister(field.getId()); // Прибираємо вспливаючу підказку при знищенні поля
                        }
                    }
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
            handler: this.checkData.bind(this)
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
            form.getFields().each(function (field) {
                if (!field.isValid()) { // Якщо поле не валідне
                    errors.push(field.getFieldLabel() + ": " + field.getErrors().join(", ")); // Збираємо інформацію про помилки
                }
            });

            // Показуємо повідомлення з переліком помилок
            pimcore.helpers.showNotification(t("error"), errors.join("; "), "error");
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

    checkData: function () {
        var form = this.generalForm.getForm();
        if (!form.isValid()) {
            var errors = [];
            form.getFields().each(function (field) {
                if (!field.isValid()) {
                    errors.push(field.getFieldLabel() + ": " + field.getErrors().join(", ")); // Збираємо інформацію про помилки
                }
            });

            // Показуємо повідомлення з переліком помилок
            pimcore.helpers.showNotification(t("error"), errors.join("; "), "error");
            return;
        }
        const saveData = this.getSaveData();
        Ext.Ajax.request({
            url: '/admin-custom/inspect-queries',
            params: {
                data: saveData,
                modificationDate: this.modificationDate
            },
            method: "POST",
            success: function (response) {
                const rdata = Ext.decode(response.responseText);
                if (rdata && rdata.success) {
                    pimcore.helpers.showNotification(t("success"), t("check is success"), "success");
                }
            }.bind(this),
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
