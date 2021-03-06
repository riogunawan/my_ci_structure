$(document).ready(function() {

    $(".form-filter").on('click', '.btn-reset', function(event) {
        event.preventDefault();

        $(".form-filter").find("input").val("");

        refreshTable();
    });

    $(".dataTable").DataTable({
        "ajax": {
            "url"    :"<?php echo base_url("basic_form/input_password/data") ?>",
            "method" :"POST",
            "data"   : function ( d ) {
                d.input_password = $(".input_password").val();
            }
        },

        "columns": [
            {"data": "no"},
            {
                "class": "table-button-aksi",
                "data": "aksi",
            },
            {"data": "input_password"},
        ],

        // "responsive": true,
        // "pageLength"  : 100,
        "deferRender" : true,
        "serverSide"  : true,
        "processing"  : true,
        "filter"      : false,
        "ordering"    : true,
        "bLengthChange": true,

        "order": [[ 0, "asc" ]],

        "columnDefs": [
            {
                "targets": 0,
                "orderable": false
            },
            {
                "targets": 1,
                "orderable": false
            },
        ],

        "language": {
            "sProcessing"   : "Sedang memproses...",
            "sLengthMenu"   : "Tampilkan _MENU_ entri",
            "sZeroRecords"  : "Tidak ditemukan data",
            "sInfo"         : "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty"    : "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered" : "(difilter dari _MAX_ entri keseluruhan)",
            "sInfoPostFix"  : "",
            "sUrl"          : "",
            "oPaginate"     : {
                "sFirst"        : "Pertama",
                "sPrevious"     : "Sebelumnya",
                "sNext"         : "Selanjutnya",
                "sLast"         : "Terakhir"
            }
        },
    });

    $(".form-filter").validate({
        submitHandler : function(form) {
            refreshTable();
            return false;
        }
    });

    $(".dataTable").on("click", ".btn-delete", function(event) {
        var id = $(this).data("id");
        swal({
            title: "Konfirmasi",
            text: "Anda yakin akan menghapus data ini?",
            type: "warning",
            // animation: "slide-from-top",
            showCancelButton: true,
            confirmButtonColor: "#fb483a",
            cencelButtonColor: "#D9534F",
            confirmButtonText: "Hapus Data",
            cancelButtonText: "Batalkan",
            showLoaderOnConfirm: true,
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "<?php echo base_url("basic_form/input_password/delete_proses") ?>",
                    type: "post",
                    dataType: "json",
                    data: { id: id },
                    success: function (json) {
                        if (json.stat) {
                            refreshTable();
                            swal(
                                'Deleted!',
                                'Data telah dihapus.',
                                'success'
                            );
                        } else {
                            swal(
                                'Gagal!',
                                'Data gagal dihapus.',
                                'error'
                            )
                        }
                    }
                });
            }
        });
    });
});

function refreshTable () {
    var dtable = $(".dataTable").DataTable();
    dtable.draw();
}