$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var queriesTable = $('#queries-table').DataTable({
        scrollX: true,
        autoWidth: false,
        pageLength: 3, // Display 5 rows per page
        columns: [
            // { data: 'DT_RowIndex', searchable: false, orderable: false, width: '40px' },
            { data: 'name', width: '150px' },
            { data: 'contact_no', width: '120px' },
            { data: 'email', width: '200px' },
            { data: 'department', width: '120px' },
            { data: 'concern', width: '150px' },
            {
                data: 'urgency',
                width: '100px',
                render: function(data) {
                    return data.charAt(0).toUpperCase() + data.slice(1).toLowerCase();
                }
            },
            { data: 'status', width: '100px' },
            { data: 'ticket_number', width: '150px' },
            { data: 'action', orderable: false, class: "text-nowrap", width: '200px' },
            {
                data: 'created_at',
                width: '150px',
                render: function(data) {
                    return data ? moment(data).format('MMM D, YYYY h:mm A') : '';
                }
            },
            {
                data: 'resolved_at',
                width: '150px',
                render: function(data) {
                    return data ? moment(data).format('MMM D, YYYY h:mm A') : '';
                }
            },
        ],
        createdRow: function (row, data, index) {
            $(row).addClass("bg-white border-b hover:bg-gray-50");
        },
        aaSorting: [[9, 'desc']],
        searching: true,
        scrollCollapse: true,
        select: true,
        serverSide: true,
        processing: true,
        ajax: indexQueryRoute,
        drawCallback: function() {
            $(window).trigger('resize');
        }
    });

    // Handle window resize
    $(window).on('resize', function() {
        queriesTable.columns.adjust();
    });
});
