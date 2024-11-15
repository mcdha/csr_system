$(document).ready(function () {
    // ? Initialize datatables start
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var usersTable = $('#users-table').DataTable({
        columns: [
            {
                data: 'DT_RowIndex',
                searchable: false,
                orderable: false
            },
            {
                data: 'image_file',
                searchable: false,
                orderable: false
            },
            {
                data: 'first_name'
            },
            {
                data: 'email'
            },
            {
                data: 'role'
            },
            {
                data: 'agent_code'
            },
            {
                data: 'action',
                orderable: false,
                class: "text-nowrap",
                // visible: userRole === 'admin' // Conditionally hide the action column if the user is not admin
            },
            {
                data: 'created_at',
            },

        ],
        createdRow: function (row, data, index) {
            $(row).addClass("bg-white border-b hover:bg-gray-50");
        },
        order: {
            idx: 6,
            dir: 'desc'
        },
        searching: true,
        scrollCollapse: true,
        fixedColumns: true,
        select: true,
        serverSide: true,
        processing: true,
        ajax: usersIndexRoute,
    });
    // ? Initialize datatables end

    $('#add-user-btn').click(function () {
        window.location.href = usersCreateRoute;
    });


});
