
<div id="scansTable" class="my-3 card p-0"></div>
<script>
    $(document).ready(function(){

        // Initialize the Select2 plugin
        $('#id-field').select2({
            theme: 'bootstrap-5',
            width: '100%',
            dropdownAutoWidth: true,
            placeholder: 'Select a Scan',
            allowClear: true
        });

        // Const for records
        const Records = JSON.parse('<?= json_encode($this->Return['scans'],JSON_UNESCAPED_SLASHES); ?>');

        // Component
        const Table = builder.Component(
            "table",
            "#scansTable",
            {
                class: {
                    buttons: "px-4 pt-4",
                    table: "border-top",
                    footer: "px-4 pt-2 pb-4",
                },
                showButtonsLabel: true,
                selectTools:false,
                exportTools:true,
                actions:{},
                datatable:{
                    columnDefs:[
                        { target: 0, visible: true, responsivePriority: 1, title: 'Target', name: 'target', data: 'target' },
                        { target: 1, visible: true, responsivePriority: 2, title: 'Port', name: 'port', data: 'port' },
                        { target: 2, visible: true, responsivePriority: 3, title: 'Type', name: 'type', data: 'type' },
                        { target: 3, visible: true, responsivePriority: 4, title: 'Status', name: 'status', data: 'status', render: function(data, type, row, meta){
                            if(data){
                                return '<button class="btn btn-sm btn-success" data-id="'+row.id+'" data-action="disable">Active</button>';
                            } else {
                                return '<button class="btn btn-sm btn-danger" data-id="'+row.id+'" data-action="enable">Inactive</button>';
                            }
                        }},
                        { target: 4, visible: true, responsivePriority: 5, title: 'Action', name: 'delete', data: 'delete', render: function(data, type, row, meta){
                            return '<button class="btn btn-sm btn-danger" data-id="'+data+'" data-action="delete">Delete</button>';
                        }},
                    ],
                    buttons:[
                        {
                            text: '<i class="bi-plus-lg"></i>',
                            action:function(e, dt, node, config){
                                console.log(e, dt, node, config);
                                dt.row.add(Records[builder.Helper.randomNumber(0,9)]).draw();
                            },
                        }
                    ],
                },
            },
            function(table,component){

                // Add the records
                for(const [key, record] of Object.entries(Records)){
                    table.add(record);
                }

                // Handle actions
                $('#scansTable').on('click','button',function(){
                    const action = $(this).data('action');
                    const id = $(this).data('id');
                    const label = action.charAt(0).toUpperCase() + action.slice(1);
                    var color = 'danger';
                    switch(action){
                        case 'enable':
                            color = 'success';
                            break;
                    }
                    var modal = builder.Component(
                        "modal",
                        $(this),
                        {
                            callback: {
                                submit: function(element,modal){
                                    window.location.href = element.footer.submit.attr('href');
                                },
                            },
                            onEnter: true,
                            close:false,
                            fullscreen:true,
                            destroy:true,
                            icon: "info-circle",
                            title: "Are you sure?",
                            body: "Are you sure you want to continue?",
                            static: false,
                            cancel: true,
                            submit: true,
                            center: true,
                            size: "none",
                        },
                        function(modal,component){
                            component.footer.submit
                                .addClass('text-bg-'+color+' rounded-start')
                                .attr('style','border-top-left-radius: 0px!important;')
                                .attr('href','?id='+id+'&action='+action)
                                .text(label);
                        },
                    );
                    modal.show();
                });
            },
        );
    });
</script>
