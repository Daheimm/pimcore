pimcore.registerNS("pimcore.plugin.CustomMenu.settings");

pimcore.plugin.CustomMenu.settings = Class.create({


    initialize: function () {
        this.getTabPanel();
    },

    activate: function () {
        var tabPanel = Ext.getCmp('pimcore_panel_tabs');

        if (tabPanel.items.keys.indexOf("custommenu_settings") > -1) {
            tabPanel.setActiveItem('custommenu_settings');
        } else {
            throw "need to reload";
        }
    },


    createRow: function () {
        var win = Ext.getCmp('create-new-row');

        if (win !== undefined) {
            win.destroy();
        }

        win = new Ext.Window({
            modal: false,
            title: t("Create New Type"),
            id: 'create-new-row',
            layout: 'fit',
            width: "25%",
            height: "150px",
            closeAction: 'close',
            buttonAlign: 'center',
            overflowY: 'auto',
            autoscroll: true,
            minimizable: false,
            animShow: function () {
                this.el.slideIn('t', {
                    duration: 1, callback: function () {
                        this.afterShow(true);
                    }, scope: this
                });
            },
            listeners: {
                minimize: function (win, obj) {
                    if (win.collapsed === false) {
                        win.collapse();
                    } else {
                        win.expand();
                    }
                }
            },
            items: [
                {
                    xtype: 'form',
                    controller: 'createnewrow-controller',
                    bodyPadding: 5,
                    flex: 1,
                    items: [
                        {
                            xtype: 'textfield',
                            name: "Name Type",
                            id: "TypeIdCustom",
                            fieldLabel: 'Type'
                        }
                    ],
                    buttons: [
                        {
                            text: t('Confirm'),
                            id: 'confirmBtn',
                            name: "confirmBtn",
                            handler: 'onConfirm',
                            object: this,
                        }
                    ]
                }
            ],
        });
        win.show(Ext.getBody());
    },

    getTabPanel: function () {
        if (!this.panel) {
            this.panel = new Ext.Panel({
                id: 'custommenu_settings',
                title: t('Custom Settings'),
                iconCls: 'pimcore_icon_system',
                border: false,
                layout: "border",
                closable: true,
                items: [this.getTree(), this.getEditPanel()]
            });

            var tabPanel = Ext.getCmp("pimcore_panel_tabs");
            tabPanel.add(this.panel);
            tabPanel.setActiveItem("pimcore_plugin_queue_custom_config_tab");

            this.panel.on("destroy", function () {
                pimcore.globalmanager.remove("plugin_pimcore_queue_custom_config");
            }.bind(this));

            pimcore.layout.refresh();
        }

        return this.panel;
    },

    userIsAllowedToCreate: function (adapter) {
        let user = pimcore.globalmanager.get("user");

        //everything is allowed for admins
        if (user.admin || user.isAllowed('plugin_queue_custom_admin')) {
            return true;
        }

        return user.isAllowed("plugin_queue_custom_adapter_" + adapter);
    },


    getTree: function () {
        if (!this.tree) {


            var store = Ext.create('Ext.data.TreeStore', {
                autoLoad: false,
                autoSync: true,
                proxy: {
                    type: 'ajax',
                    url: '/admin-custom/tree-list',
                    reader: {
                        type: 'json',
                        rootProperty: 'data',
                    },
                },
            });


            let firstHandler = function () {
                this.createRow(); // Виклик функції createRow обгорнуто у анонімну функцію
            };


            var addConfigButton = new Ext.SplitButton({
                text: t("Create"),
                iconCls: "pimcore_icon_add",
                handler: firstHandler.bind(this),
                disabled: !firstHandler,
            });


            this.tree = new Ext.tree.TreePanel({
                store: store,
                region: "west",
                autoScroll: true,
                animate: true,
                containerScroll: true,
                border: true,
                width: 200,
                split: true,
                root: {
                    id: '0',
                    expanded: true,
                    iconCls: "pimcore_icon_thumbnails"
                },
                rootVisible: false,
                tbar: {
                    items: [
                        addConfigButton
                    ]
                },
                listeners: {
                    itemclick: this.onTreeNodeClick.bind(this),
                    itemcontextmenu: this.onTreeNodeContextmenu.bind(this),
                    render: function () {
                        this.getRootNode().expand()
                    }
                },
            });
        }

        return this.tree;
    },

    getEditPanel: function () {
        if (!this.editPanel) {
            this.editPanel = new Ext.TabPanel({
                region: "center"
            });
        }

        return this.editPanel;
    },


    onTreeNodeClick: function (tree, record, item, index, e, eOpts) {
        if (!record.isLeaf()) {
            return;
        }

        let adapterType = record.data.adapter;
        let adapterImpl = new pimcore.plugin.queue_custom.adapter[adapterType](this);
        adapterImpl.openConfiguration(record.id);
    },


    onTreeNodeContextmenu: function (tree, record, item, index, e, eOpts) {
        if (!record.isLeaf()) {
            return;
        }

        e.stopEvent();

        tree.select();

        var menu = new Ext.menu.Menu();
        menu.add(new Ext.menu.Item({
            text: t('delete'),
            iconCls: "pimcore_icon_delete",
            handler: this.deleteConfiguration.bind(this, tree, record)
        }));

        menu.showAt(e.pageX, e.pageY);
    },

    cloneConfiguration: function (tree, record) {
        let adapterType = record.data.adapter;
        let adapterImpl = new pimcore.plugin.queue_custom.adapter[adapterType](this);
        adapterImpl.cloneConfiguration(tree, record);
    },

    deleteConfiguration: function (tree, record) {
        let adapterType = record.data.adapter;
        let adapterImpl = new pimcore.plugin.queue_custom.adapter[adapterType](this);
        adapterImpl.deleteConfiguration(tree, record);
    },

    refreshTree: function () {
        this.tree.getStore().load({
            node: this.tree.getRootNode()
        });
    }

});