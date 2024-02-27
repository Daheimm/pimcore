pimcore.registerNS("pimcore.plugin.queue_custom.modals.type");
pimcore.plugin.queue_custom.modals.type = Class.create({

    initialize: function () {
    },

    createRow: function (callback) {
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
            items: [
                {
                    xtype: 'form',
                    id: 'create-new-row-form',
                    bodyPadding: 5,
                    items: [
                        {
                            xtype: 'textfield',
                            name: "nameType",
                            id: "TypeIdCustom",
                            fieldLabel: 'Type',
                            maxLength: 100,
                            enforceMaxLength: true,
                            validator: function (value) {
                                if (value.length < 1) {
                                    return "Це поле не може бути пустим.";
                                }
                                return true;
                            }
                        }
                    ],
                    buttons: [
                        {
                            text: t('Confirm'),
                            handler: function () {
                                console.log('popopo');
                                var form = Ext.getCmp('create-new-row-form').getForm(); // Отримання форми за ID
                                if (form.isValid()) { // Перевірка валідності форми
                                    form.submit({
                                        url: '/admin-custom/tree', // URL для відправки форми
                                        success: function (form, action) {
                                            // Обробник успішної відправки
                                            var data = action.result;
                                            callback(data.data.id);
                                            win.close();
                                        },
                                        failure: function (form, action) {
                                            // Обробник помилки відправки
                                            Ext.Msg.alert('Failed', action.result ? action.result.message : 'No response');
                                        }
                                    });
                                }
                            }
                        }
                    ]
                }
            ],
        });
        win.show(Ext.getBody());
    },

});