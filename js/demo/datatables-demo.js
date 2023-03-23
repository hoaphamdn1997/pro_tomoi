// Call the dataTables jQuery plugin
$(document).ready(function() {
        $('#dataTable').DataTable();
        $('#dataTableCam').DataTable( {
            columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]]         
        } );
});
