$(document).ready(function() {
    $(".mn-agenda").addClass("active");

	$(".table").DataTable({
		"ajax": {
        	"url"    :"<?php echo base_url("agenda/data") ?>",
        	"method" :"POST",
        	"data"   : function ( d ) {
                
            }
        },
        "dom": "<'row'<'col-sm-12'<'pull-right'<'toolbarindex'>><'pull-left'l>r<'clearfix'>>><''t><'row'<'col-sm-6'<'pull-left'<'toolbar'> i>><'col-sm-6'<'pull-right'p>><'clearfix'>>",
        "columns": [
            {"data": "no"},
            {"data": "aksi"},
            {"data": "title"},
            {"data": "date_agenda"},
            {"data": "cover"},
            {"data": "city"},
            {"data": "publish"},
        ],
        
        "pageLength"  : 100,
        "deferRender" : true,
        "serverSide"  : true,
        "processing"  : false,
		"filter"      : false,
		"ordering"    : true,
        "bLengthChange": false,
        
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
            // "sProcessing"   : "Sedang memproses...",
			// "sLengthMenu"   : "Tampilkan _MENU_ entri",
			// "sZeroRecords"  : "Tidak ditemukan data",
			// "sInfo"         : "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
			// "sInfoEmpty"    : "Menampilkan 0 sampai 0 dari 0 entri",
			// "sInfoFiltered" : "(difilter dari _MAX_ entri keseluruhan)",
			"sInfoPostFix"  : "",
			"sUrl"          : "",
			"oPaginate"     : {
				// "sFirst"   		: "Pertama",
				// "sPrevious"		: "Sebelumnya",
				// "sNext"    		: "Selanjutnya",
				// "sLast"    		: "Terakhir"
			}
        },
	});

    $(".table").on('click', '#btn-delete', function(event) {
        event.preventDefault();
        var id = $(this).data('id');

        swal({
            title: 'DELETE',
            type: 'question',
            html: 'Are you sure?',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: '<i class="fa fa-trash"></i> Delete Data!',
            confirmButtonAriaLabel: 'Thumbs up, great!',
            cancelButtonText: 'Cancel',
            cancelButtonAriaLabel: 'Thumbs down',
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return new Promise(function (resolve) {
                    $.ajax({
                        url: '<?php echo base_url('agenda/delete_proses') ?>',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function (json) {
                            draw_table();
                            swal(
                                'Deleted!',
                                'Your data has been deleted.',
                                'success'
                            )
                        }
                    });
                    
                })
            }
        });

    });
});

function draw_table () {
    var dtable = $(".table").DataTable();
    dtable.draw();
}