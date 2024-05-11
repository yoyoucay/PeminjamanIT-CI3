<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">List Peminjaman</h1>
            </div>
            <!-- Content Row -->
            <div class="row">
                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-7">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 flex justify-between">
                            <div class="w-full flex gap-4 h-25">
                                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                    onclick="regisPeminjaman();">
                                    <i class="fas fa-plus fa-sm text-white-50"></i>
                                    Ajukan Peminjaman</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dtPeminjaman" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No#</th>
                                            <th>Kode Req.</th>
                                            <th>Loan Items</th>
                                            <th>Req. Qty</th>
                                            <th>Start Loan</th>
                                            <th>Finish Loan</th>
                                            <th>Approver</th>
                                            <th>Status Request</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
</div>

<?php
$this->load->view('component/modal-peminjaman'); ?>
<!-- End of Content Wrapper -->
<script>

    $(document).ready(function () {
        var table = $('#dtPeminjaman').DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": true,
            "processing": true,
            "serverSide": true,
            "searching": true,
            "ajax": {
                "url": "<?php echo base_url('dtables/getpeminjaman') ?>",
                "type": "POST",
                "data": function (data) {
                }
            },
        });

        // table.on('xhr', function () {
        //     var json = table.ajax.json();
        //     console.log(json); // Log the JSON data to the console
        // });
    });

    function regisPeminjaman() {
        var form = document.getElementById('peminjamanForm');
        form.setAttribute('onsubmit', 'submitForm(); return false;');
        $('#hModalPeminjaman').text('Pengajuan Peminjaman');
        $('#idReq').val('');
        resetForm('peminjamanForm');
        openModal('modalInputPeminjaman');
    }

    function editRow(id) {
        var table = $('#dtPeminjaman').DataTable();

        $('#dtPeminjaman tbody').on('click', 'tr', function () {
            var rowData = table.row(this).data();
            // Process rowData as needed (e.g., display in a modal, send to server, etc.)

            console.log('rowdata : ', rowData)
            $('#hModalPeminjaman').text('Update Peminjaman');
            if (rowData) {
                $('#sEmpID').val(rowData[1]);
                $('#sFullname').val(rowData[2]);
                $('#sRole').val(rowData[3]);
                $('#idUser').val(rowData[5]);

                openModal('modalInputPeminjaman');

                var form = document.getElementById('peminjamanForm');
                form.setAttribute('onsubmit', 'updateForm(); return false;');
            }
        });
    }

    function deleteRow(id) {

        var table = $('#dtPeminjaman').DataTable();

        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, proceed with deletion
                $.ajax({
                    url: '<?php echo base_url('General/delAkun'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: { id: id },
                    success: function (response) {
                        if (response.status == 'success') {
                            Swal.fire(
                                'Deleted!',
                                'Your data has been deleted.',
                                'success'
                            );
                            // Refresh the DataTable or perform other actions after deletion
                            table.draw(); // Redraw DataTable
                        } else {
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting data.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>