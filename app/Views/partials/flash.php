<script>
const notyf = new Notyf({
  duration: 6000,
  ripple: true,
  dismissible: true,
  position: { x: 'right', y: 'bottom' }
});

<?php if ($msg = session()->getFlashdata('success')): ?>
  notyf.success("<?= esc($msg) ?>");
<?php elseif ($msg = session()->getFlashdata('error')): ?>
  notyf.error("<?= esc($msg) ?>");
<?php endif; ?>
</script>

