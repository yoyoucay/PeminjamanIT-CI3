<script>
  $(document).ready(function() {
    <?php if($this->session->flashdata('success')): ?>
        Swal.fire({
            title: 'Success',
            icon: 'success',
            html: '<?= $this->session->flashdata('success'); ?>',
            showConfirmButton: false,
            timer: 1500,
        });
    <?php elseif($this->session->flashdata('info')): ?>
        Swal.fire({
            title: 'Information',
            icon: 'info',
            html: '<?= $this->session->flashdata('info'); ?>',
            showConfirmButton: true,
            timer: 2000,
        });
    <?php elseif($this->session->flashdata('warning')): ?>
        Swal.fire({
            title: 'Warning',
            icon: 'warning',
            html: '<?= $this->session->flashdata('warning'); ?>',
            showConfirmButton: true,
            timer: 3000,
        });
    <?php elseif($this->session->flashdata('error')): ?>
        Swal.fire({
            title: 'Oops!',
            icon: 'error',
            html: '<?= $this->session->flashdata('error'); ?>',
            showConfirmButton: true,
            timer: 4000,
        });
    <?php elseif($this->session->flashdata('emailSent')): ?>
        Swal.fire({
            title: 'Successfully sent!',
            icon: 'success',
            html: '<?= $this->session->flashdata('emailSent'); ?>',
            showConfirmButton: true,
            timer: 4000,
        });
    <?php endif; ?>
   });
</script>