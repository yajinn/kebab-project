/**
 * roleManager Application RoleManagerStoryGrid class
 *
 * @category    Kebab (kebab-reloaded)
 * @package     Applications
 * @namespace   KebabOS.applications.roleManager.application.views
 * @author      Yunus ÖZCAN <yunus.ozcan@lab2023.com>
 * @copyright   Copyright (c) 2010-2011 lab2023 - internet technologies TURKEY Inc. (http://www.lab2023.com)
 * @license     http://www.kebab-project.com/licensing
 */
KebabOS.applications.roleManager.application.views.RoleManagerStoryGrid = Ext.extend(Ext.grid.EditorGridPanel, {

    // Application bootstrap
    bootstrap: null,
    border:false,
    
    initComponent: function() {

        // json data store
        this.store = new KebabOS.applications.roleManager.application.models.RoleManagerStoryDataStore({
            bootstrap:this.bootstrap,
                        listeners: {
                load: function(store, records) {
                    //var userId = this.user;
                    var sm = this.getSelectionModel();
                    Ext.each(records, function(record) {
                        //console.log(record);
                        if (record.id == this.userId) {

                            Ext.each(record.data.Roles, function(role) {
                                sm.selectRow(role.id - 1);

                            }, this);
                        }

                    }, this);
                },
                scope: this
            }
        });

        // grid config

        var config = {
            enableColumnResize: false,
            enableColumnHide:false,
            sortable:true,
            loadMask: true,
            viewConfig: {
                // To be equal to the width of columns
                forceFit: true
            }
        }




this.sm = new Ext.grid.CheckboxSelectionModel();
        this.columns = [
            this.sm,
            {
                header   : 'Title',
                width:50,
                dataIndex: 'title'

            },
            {
                header   : 'Description',
                dataIndex: 'description'
            }
        ];

        Ext.apply(this, config);

        KebabOS.applications.roleManager.application.views.RoleManagerStoryGrid.superclass.initComponent.apply(this, arguments);
    },

    listeners: {
        afterRender: function() {
            this.store.load();
        }
    }
});
