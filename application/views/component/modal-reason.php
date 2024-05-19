<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div id="modalInputReason" tabindex="-1" aria-hidden="true"
    class="hidden flex overflow-y-auto overflow-x-hidden fixed z-50 bg-blue-50 flex justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto items-center">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 id="hModalReason" class="text-lg font-semibold text-gray-900 dark:text-white">
                    Reason for Reject
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    onclick="closeModal('modalInputReason'); resetForm('reasonForm');">
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
            <form id="reasonForm" onsubmit="submitForm(); return false;">
                <input type="hidden" value="" id="idRequest" name="id">
                <input type="hidden" value="0" id="iStatus" name="status">
                <div class="grid gap-4 mb-4 sm:grid-cols-1">
                    <div>
                        <label for="sReason" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reason :</label>
                        <input type="text" name="sReason" id="sReason"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Tulis Alasan.." required>
                    </div>
                </div>
                <div class='flex justify-between'>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-primary hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Submit
                    </button>
                    <button type="button" onclick="closeModal('modalInputReason'); resetForm('reasonForm');" class=" text-white inline-flex items-center bg-danger hover:bg-danger-200 focus:ring-4
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
    function submitForm() {
        var table = $('#dtPengajuan').DataTable();
        const formData = new FormData(document.getElementById('reasonForm'));
        var idrequest = $('#idRequest').val();
        var sReason = $('#sReason').val();
        var iStatus =  $('#iStatus').val();

        fetch('<?php echo base_url('request/action'); ?>', {
            method: 'POST',
            body: formData,
            data: { id: idrequest, status: iStatus, reason: sReason },
        }).then(response =>
            response.json()
        ).then(data => {
            console.log('data : ', data);
            if (data.success) {
                const msg = 'Penolakan permintaan berhasil!'
                notifAlert('success', msg);
                closeModal('modalInputReason');
                table.draw(); // Reload DataTables after updating status
            } else {
                const msg = 'Penolakan permintaan gagal! Hubungi IT'
                notifAlert('error', msg);
            }
        }).catch(error => {
            console.error('Error:', error);
            alert('Error updating data!');
        });
    }
</script>
</script>