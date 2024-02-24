pimcore.registerNS("pimcore.plugin.CustomMenu.settings");

pimcore.plugin.CustomMenu.settings = Class.create({

    activate: function () {
        var tabPanel = Ext.getCmp('pimcore_panel_tabs');

        if (tabPanel.items.keys.indexOf("custommenu_settings") > -1) {
            tabPanel.setActiveItem('custommenu_settings');
        } else {
            throw "need to reload";
        }
    },

    initialize: function () {
        this.getData();
    },

    getData: function () {
        Ext.Ajax.request({
            url: '/admin/setting-queries',
            success: function (response) {
                this.data = Ext.decode(response.responseText).data;
                this.getTabPanel();
            }.bind(this)
        });
    },

    getTabPanel: function () {
        if (!this.panel) {
            var self = this;

            this.panel = Ext.create('Ext.panel.Panel', {
                id: 'custommenu_settings',
                title: t('Custom Settings'),
                iconCls: 'pimcore_icon_system',
                border: false,
                layout: 'fit',
                closable: true
            });

            var tabPanel = Ext.getCmp('pimcore_panel_tabs');
            tabPanel.add(this.panel);
            tabPanel.setActiveItem('custommenu_settings');

            var mm2AwgModel = Ext.create('Ext.data.Model', {
                fields: [
                    {name: 'mm2', type: 'string'},
                    {name: 'awg', type: 'string'},
                ]
            });

            var mm2AwgValues = new Ext.create('Ext.data.Store', {
                id: 'storeId',
                model: mm2AwgModel,
                data: this.data.mm2AwgValues
            });

            var mm2AwgGrid = Ext.create('Ext.grid.Panel', {
                store: mm2AwgValues,
                id: 'mm2AwgGrid',
                actions: {
                    delete: {
                        iconCls: 'pimcore_icon_delete',
                        tooltip: "Delete",
                        handler: function (obj, row, rowIndex) {
                            self.deleteRow(rowIndex);
                        }.bind(self, this)
                    }
                },
                columns: [
                    {
                        text: 'Mm2',
                        dataIndex: 'mm2',
                        xtype: 'gridcolumn',
                        editor: {
                            xtype: 'numberfield'
                        }
                    },
                    {
                        text: 'Awg',
                        dataIndex: 'awg',
                        xtype: 'gridcolumn',
                        editor: {
                            xtype: 'textfield'
                        }
                    },
                    {
                        width: 70,
                        sortable: false,
                        menuDisabled: true,
                        xtype: 'actioncolumn',
                        items: ['@delete']
                    }
                ],
                height: 800,
                width: 500,
                selModel: 'cellmodel',
                plugins: {
                    ptype: 'cellediting',
                    clicksToEdit: 1
                },
                renderTo: Ext.getBody()
            });

            var mm2AwgPanel = Ext.create('Ext.form.Panel', {
                title: t('MM2-AWG Conversion'),
                autoScroll: true,
                forceLayout: true,
                defaults: {
                    forceLayout: true,
                    listeners: {
                        render: function (el) {
                            me.checkForInheritance(el);
                        }
                    }
                },
                fieldDefaults: {
                    labelWidth: 250
                },
                items: []
            });

            var button = Ext.create('Ext.Button', {
                text: 'Create Row',
                renderTo: Ext.getBody(),
                handler: function (obj) {
                    self.createRow(this);
                    grid.reconfigure(store)
                }.bind(self, this)
            });

            mm2AwgPanel.items.add(mm2AwgGrid);
            mm2AwgPanel.items.add(button);

            this.layout = Ext.create('Ext.tab.Panel', {
                bodyStyle: 'padding:20px 5px 20px 5px;',
                border: true,
                autoScroll: true,
                forceLayout: true,
                defaults: {
                    forceLayout: true
                },
                fieldDefaults: {
                    labelWidth: 500
                },
                buttons: [
                    {
                        text: t('save'),
                        handler: this.save.bind(this),
                        iconCls: 'pimcore_icon_apply'
                    }
                ]
            });


            self.mm2AwgGrid = mm2AwgGrid;
            this.layout.add(mm2AwgPanel);

            this.panel.add(this.layout);
            this.layout.setActiveItem(0);

            pimcore.layout.refresh();
        }

        return this.panel;
    }
});