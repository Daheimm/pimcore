pimcore.registerNS("pimcore.plugin.queue_custom.action.ajax");
pimcore.plugin.queue_custom.action.ajax = Class.create({

    initialize: function () {
    },

    confirm: function (request) {
        console.log('remove');
        Ext.Ajax.request({
            url: "/admin-custom/tree",
            params: {
                name: value,
            },
            success: function (response) {
                var data = Ext.decode(response.responseText);
                this.configPanel.refreshTree();

                if (!data || !data.success) {
                    pimcore.helpers.showNotification(t("error"), t("plugin_pimcore_datahub_configpanel_error_adding_config") + ': <br/>' + data.message, "error");
                } else {
                    this.openConfiguration(data.name);
                }

            }.bind(this)
        });
    }
});