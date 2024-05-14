<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div id="modalInputPeminjaman" tabindex="-1" aria-hidden="true"
    class="hidden flex overflow-y-auto overflow-x-hidden fixed z-50 bg-blue-50 flex justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto items-center">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 id="hModalPeminjaman" class="text-lg font-semibold text-gray-900 dark:text-white">
                    Pengajuan Peminjaman
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    onclick="closeModal('modalInputPeminjaman'); resetForm('peminjamanForm');">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="peminjamanForm" onsubmit="submitForm(); return false;">
                <input type="hidden" value="" id="idReq" name="idReq">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="sEmpID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Emp ID.
                        </label>
                        <select id="sEmpID" name="sEmpID"
                            class="select2 appearance-none bg-white border border-gray-300 rounded-md py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-gray-500 dark:focus:bg-gray-700"
                            style="width: 100%;">
                        </select>
                    </div>
                    <div>
                        <label for="sKdBrg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Kode Barang
                        </label>
                        <select id="sKdBrg" name="sKdBrg"
                            class="select2 appearance-none bg-white border border-gray-300 rounded-md py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-gray-500 dark:focus:bg-gray-700"
                            style="width: 100%;">
                        </select>
                    </div>

                    <div>
                        <label for="dtReqStart" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Mulai Peminjaman dari :
                        </label>
                        <input type="date" id="dtReqStart" name="dtReqStart"
                            class="w-full appearance-none bg-gray border border-black-300 rounded-md py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-gray-500 dark:focus:bg-gray-700">
                    </div>

                    <div>
                        <label for="dtReqStart" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Peminjaman sampai :
                        </label>
                        <input type="date" id="dtReqEnd" name="dtReqEnd"
                            class="w-full appearance-none bg-gray border border-black-300 rounded-md py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-gray-500 dark:focus:bg-gray-700">
                    </div>

                    <div>
                        <label for="decReqQty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Req.
                            Qty</label>
                        <input type="number" name="decReqQty" id="decReqQty"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="1" min="1" required>
                    </div>
                </div>
                <div class='flex justify-between'>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-primary hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Submit
                    </button>
                    <button type="button" onclick="closeModal('modalInputPeminjaman'); resetForm('peminjamanForm');"
                        class=" text-white inline-flex items-center bg-danger hover:bg-danger-200 focus:ring-4
                    focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center
                    dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    flatpickr("#dtReqStart", {
        dateFormat: "d-m-Y",
        minDate: "today"
    });

    flatpickr("#dtReqEnd", {
        dateFormat: "d-m-Y",
        minDate: "today"
    });

    $('#sEmpID').select2({
        ajax: {
            url: '<?= base_url('General/getUsers') ?>',
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.sEmpID,
                            text: item.sEmpID + ' - ' + item.sFullname
                        };
                    })
                };
            }
        } 
    });
    // Set default value based on session data
    $('#sEmpID').append('<option value="<?= $this->session->userdata('sEmpID') ?>" selected="selected"><?= $this->session->userdata('sEmpID') ?> - <?= $this->session->userdata('sFullName') ?></option>');
    $('#sEmpID').trigger('change');
    $('#sEmpID').prop('disabled', true);

    $('#sKdBrg').select2({
        ajax: {
            url: '<?= base_url('General/getBarangs') ?>',
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.sKode,
                            text: item.sKode + ' - ' + item.sName
                        };
                    })
                };
            }
        }
    });

    function submitForm() {
        var table = $('#dtPeminjaman').DataTable();
        const formData = new FormData(document.getElementById('peminjamanForm'));
        fetch('<?php echo base_url('General/insPeminjaman'); ?>', {
            method: 'POST',
            body: formData
        }).then(response =>
            response.json()
        ).then(data => {
            console.log('data : ', data);
            if (data.success) {
                const msg = 'Peminjaman telah berhasil diajukan!'
                notifAlert('success', msg);
                closeModal('modalInputPeminjaman');
                table.draw();
                // You can reload or update your view here as needed
            } else {
                const msg = 'Pengajuan Peminjaman Gagal! Hubungi IT'
                notifAlert('error', msg);
            }
        }).catch(error => {
            console.error('Error:', error);
            alert('Error inserting data!');
        });
    }

    function updateForm() {
        var table = $('#dtAkun').DataTable();

        const formData = new FormData(document.getElementById('akunForm'));
        fetch('<?php echo base_url('Admin/updAkun'); ?>', {
            method: 'POST',
            body: formData
        }).then(response =>
            response.json()
        ).then(data => {
            if (data.success) {
                const msg = 'Ubah Data Akun berhasil!'
                notifAlert('success', msg);
                closeModal('modalInputAkun');

                table.draw();
                // You can reload or update your view here as needed
            } else {
                const msg = 'Ubah Data Akun gagal! Hubungi IT'
                notifAlert('error', msg);
            }
        }).catch(error => {
            console.error('Error:', error);
            alert('Error Updating data!');
        });
    }
</script>
</script>