$(document).ready(function () {

//  load datatable on initial load of the dashboard page

    var baseurl = $('#body').attr("data-Base_url");

    if (window.location.href == baseurl + '/dashboard' || window.location.href == baseurl + '/') {

        $.ajax({
            url: baseurl + "/getDetails",
            type: "GET",
            serverSide: true,
            destroy: true,
            processing: true,
            dataType: "json",
            success: function (fdata) {
                $("#tableone").dataTable({
                    // searching:false,
                    searchDelay: 1000,
                    data: fdata,
                    columnDefs: [
                        {className: "dt-center", "targets": 0},
                        {className: "dt-center", "targets": 1},
                        {className: "dt-center", "targets": 2},
                        {className: "dt-center", "targets": 3},
                        {className: "dt-center", "targets": 4}
                    ],

                    columns: [
                        {'data': 'cron_id', "sortable": false},
                        {'data': 'cron_label', "sortable": false},
//                    {'data': 'reccurance', "sortable": false},
                        {data: "reccurance",
                                    render: function (data, type, fdata) {
                                            return fdata.reccured + fdata.seperator + fdata.reccurance;
                                    }
                        },
                        {'data': 'cron_url'},
                        {'data': null,
                            'render': function (data) {
                                return `<a href="/edit/${data['cron_id']}"  class="edit" style="padding: 5px; border-radius: 10px; color: #fff; background-color: #198754; text-decoration: none;" >Edit</a><button type="button" data-delete='${data['cron_id']}' name="delete" class="delete" style="padding: 5px; border-radius: 10px; color: #fff; background-color: #dc3545; text-decoration: none;" >Delete</button>`;
                            },
                            "sortable": false
                        }
                    ]
                });
            }
        });
    }




//  insert data to database while clicking create cron button

    $('#create_cron').click(function () {

        var base_url = $(this).attr("data-Base_url");
        var cron_label = $('#cron_label').val();
        var hour = $('#hour').val();
        var minute = $('#minute').val();
        var day_of_week = $('#day_of_week').val();
        var days = $('#days').val();
        var months = $('#months').val();
        var reccurance = $('#reccurance').val();
        var cron_url = $('#cronURL').val();

        $.ajax({
            method: "POST",
            url: base_url + "/createcron_function",
            data: {
                "cron_label": cron_label,
                "cron_url": cron_url,
                "minute": minute,
                "day_of_week": day_of_week,
                "days": days,
                "months": months,
                "reccurance": reccurance,
                'hour': hour
            },
            success: function (d) {
                window.location.href = base_url + '/dashboard';
            }
        })
    });

//  update data to database while clicking create cron button

    $('#update_cron').click(function () {

        var base_url = $(this).attr("data-Base_url");
        var cron_label = $('#cron_label').val();
        var hour = $('#hour').val();
        var minute = $('#minute').val();
        var day_of_week = $('#day_of_week').val();
        var days = $('#days').val();
        var months = $('#months').val();
        var reccurance = $('#reccurance').val();
        var cron_url = $('#cronURL').val();
        var cron_id = $(this).attr("data-update");

        $.ajax({
            method: "POST",
            url: base_url + "/updateCron",
            data: {
                "cron_label": cron_label,
                "cron_id": cron_id,
                "cron_url": cron_url,
                "minute": minute,
                "day_of_week": day_of_week,
                "days": days,
                "months": months,
                "reccurance": reccurance,
                'hour': hour
            },
            success: function (d) {
                console.log(d);
                window.location.href = base_url + '/dashboard';
            }
        })
    });


//  while clicking edit button make an ajax call and redirect it to append and update on success

//    $(document).on("click", ".edit", function () {
//
//        var cron_id = $(this).attr("data-edit");
//        var base_url = $(this).attr("data-Base_url");
//
//        $.ajax({
//            method: "POST",
//            url: "/get_edit_cron_list",
//            data: {
//                "cron_id": cron_id
//            },
//            success: function (d) {
//                console.log(d);
//            }
//        });
//    });

//    when clicking delete button make an ajax call to delete that particular data to be removed from the database

    $(document).on("click", ".delete", function () {

        var cron_id = $(this).attr("data-delete");
        var base_url = $(this).attr("data-Base_url");


//                to remove the particular cron from the crontab

        $.ajax({
            method: 'POST',
            url: "/deleteCronTab",
            data: {
                "cron_id": cron_id
            },
            success: function (data) {
                alert('cron tab successfully removed !!!');


                $.ajax({
                    method: "POST",
                    url: "/deleteCron",
                    data: {
                        "cron_id": cron_id
                    },
                    success: function (d) {
                        $.ajax({
                            url: "/getDetails",
                            type: "GET",
                            success: function (response) {
                                var table = $("#tableone").DataTable();
                                table.clear();
                                table.rows.add(response);
                                table.draw();
                            }
                        });

                    }
                });
            }
        })

    });


});