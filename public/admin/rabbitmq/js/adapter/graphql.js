pimcore.registerNS("pimcore.plugin.queue_custom.adapter.graphql");
pimcore.plugin.queue_custom.adapter.graphql = Class.create({

    initialize: function (configPanel) {
        this.configPanel = configPanel;
    },

    addConfiguration: function (type) {
        Ext.MessageBox.prompt(t('plugin_pimcore_queue_custom_configpanel_enterkey_title'), t('plugin_pimcore_queue_custom_configpanel_enterkey_prompt'), this.addConfigurationComplete.bind(this, type), null, null, "");
    },

    addConfigurationComplete: function (type, button, value, object) {
        var regresult = value.match(/[a-zA-Z0-9_\-]+/);
        if (button == "ok" && value.length > 2 && value.length <= 80 && regresult == value) {
            Ext.Ajax.request({
                url: "/admin/pimcoredatahub/config/add",
                params: {
                    name: value,
                    type: type
                },
                success: function (response) {
                    var data = Ext.decode(response.responseText);
                    this.configPanel.refreshTree();

                    if (!data || !data.success) {
                        pimcore.helpers.showNotification(t("error"), t("plugin_pimcore_queue_custom_configpanel_error_adding_config") + ': <br/>' + data.message, "error");
                    } else {
                        this.openConfiguration(data.name);
                    }

                }.bind(this)
            });
        } else if (button == "cancel") {
            return;
        } else {
            Ext.Msg.alert(t("plugin_pimcore_queue_custom_configpanel"), value.length <= 80 ? t("plugin_pimcore_queue_custom_configpanel_invalid_name") : t("plugin_pimcore_queue_custom_configpanel_invalid_length"));
        }
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
