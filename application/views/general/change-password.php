<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">\
            <!-- Content Row -->
            <div class="row">
                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-7">
                    <!-- DataTales Example -->
                    <div class="w-full">
                                <div class="max-w-md mx-auto bg-white p-5 rounded-md shadow-sm">
                                    <h2 class="text-2xl font-bold mb-5 text-center">Ganti Password</h2>
                                    <?php if ($this->session->flashdata('message')): ?>
                                        <p class="text-green-500 mb-4 text-center">
                                            <?php echo $this->session->flashdata('message'); ?></p>
                                    <?php endif; ?>
                                    <?php if ($this->session->flashdata('error')): ?>
                                        <p class="text-red-500 mb-4 text-center">
                                            <?php echo $this->session->flashdata('error'); ?></p>
                                    <?php endif; ?>
                                    <?php echo validation_errors('<p class="text-red-500 mb-4 text-center">', '</p>'); ?>
                                    <?php echo form_open('password', ['class' => 'space-y-4']); ?>
                                    <div>
                                        <label for="current_password"
                                            class="block text-sm font-medium text-gray-700">Password saat ini</label>
                                        <input type="password" name="current_password" id="current_password"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            required>
                                    </div>

                                    <div>
                                        <label for="new_password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                                        <input type="password" name="new_password" id="new_password"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            required>
                                    </div>

                                    <div>
                                        <label for="confirm_password"
                                            class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                                        <input type="password" name="confirm_password" id="confirm_password"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            required>
                                    </div>

                                    <div>
                                        <button type="submit"
                                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Change
                                            Password</button>
                                    </div>
                                    <?php echo form_close(); ?>
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
<!-- End of Content Wrapper -->
<script>

    $(document).ready(function () {
        var table = $('#dtPeminjaman').DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": true,
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

    function rejectRow(id) {

        var table = $('#dtPeminjaman').DataTable();

        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, proceed with deletion
                $.ajax({
                    url: '<?php echo base_url('General/cancelPeminjaman'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: { id: id },
                    success: function (response) {
                        if (response.status == 'success') {
                            Swal.fire(
                                'Canceled!',
                                response.message,
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