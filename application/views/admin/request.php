<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">List Pengajuan</h1>
            </div>
            <!-- Content Row -->
            <div class="row">
                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-7">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 flex justify-between">
                            <div class="w-full flex gap-4 h-25">
                                <h6 class="m-0 font-weight-bold text-primary">List Pengajuan</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dtPengajuan" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No#</th>
                                            <th>Kode Req.</th>
                                            <th>Loan Items</th>
                                            <th>Req. Qty</th>
                                            <th>Start Loan</th>
                                            <th>Finish Loan</th>
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

<?php $this->load->view('component/modal-peminjaman'); ?>

<?php $this->load->view('component/modal-reason'); ?>
<!-- End of Content Wrapper -->
<script>
    $(document).ready(function () {
        var table = $('#dtPengajuan').DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": true,
            "processing": true,
            "serverSide": true,
            "searching": true,
            "ajax": {
                "url": "<?php echo base_url('dtables/getpengajuan') ?>",
                "type": "POST",
                "data": function (data) {
                }
            },
        });
    });
    $('#dtPengajuan').on('click', '.change-status', function () {
        var table = $('#dtPengajuan').DataTable();
        var data = table.row($(this).parents('tr')).data();
        var id = data[8];
        var newStatus = $(this).data('status');

        if (newStatus == 0) {
            showReasonModal(id);
            return;
        }

        $.ajax({
            url: '<?php echo base_url("request/action"); ?>',
            method: 'POST',
            data: { id: id, status: newStatus },
            success: function (response) {
                // Handle success response
                Swal.fire(
                    'Success!',
                    response.message,
                    'success'
                );
                table.draw(); // Reload DataTables after updating status
            },
            error: function (xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    });

    function showReasonModal(idReq) {
        var form = document.getElementById('reasonForm');
        form.setAttribute('onsubmit', 'submitForm(); return false;');
        $('#hModalReason').text('Reject Reason');
        $('#idRequest').val(idReq);
        resetForm('reasonForm');
        openModal('modalInputReason');
    }

</script>