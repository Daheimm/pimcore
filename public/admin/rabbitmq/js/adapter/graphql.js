pimcore.registerNS("pimcore.plugin.queue_custom.adapter.graphql");
pimcore.plugin.queue_custom.adapter.graphql = Class.create({

    initialize: function (configPanel) {
        this.configPanel = configPanel;
    },

    setContext: function (context) {
        this.configPanel = context;
    },

    openConfiguration: function (id) {
        var existingPanel = Ext.getCmp("plugin_pimcore_queue_custom_configpanel_panel_" + id);

        if (existingPanel) {
            this.configPanel.editPanel.setActiveTab(existingPanel);
            return;
        }

        Ext.Ajax.request({
            url: "/admin-custom/setting-queries/show",
            params: {
                id: id
            },
            success: function (response) {

                var data = Ext.decode(response.responseText);
                console.log(data.data);
                let fieldPanel = new pimcore.plugin.queue_custom.configuration.graphql.configItem(data.data, this);
                pimcore.layout.refresh();
            }.bind(this)
        });
    },

    deleteConfiguration: function (tree, record, callback) {
        Ext.Msg.confirm(t('delete'), t('delete_message'), function (btn) {
            if (btn == 'yes') {
                Ext.Ajax.request({
                    url: "/admin-custom/tree",
                    method: "DELETE",
                    params: {
                        id: record.data.id
                    },
                    success: function() {
                        this.configPanel.refreshTree();
                    }.bind(this),
                });
                this.configPanel.getEditPanel().removeAll();


            }
        }.bind(this));
    },

});
