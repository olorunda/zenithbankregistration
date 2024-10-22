<?php if($type == 'styles'): ?>

  <?php if(isset($cssPath)): ?>
    <style><?php echo file_get_contents($cssPath); ?></style>
  <?php endif; ?>

<?php elseif($type == 'scripts'): ?>

  <?php if(isset($jsPath)): ?>
    <script async>
        var laravelTelInputConfig = <?php echo json_encode(config('laravel-tel-input.options'), 15, 512) ?>;
        <?php echo file_get_contents($jsPath); ?>

    </script>
  <?php endif; ?>

<?php endif; ?><?php /**PATH C:\Users\ADMIN\PhpstormProjects\zenithbank\vendor\victorybiz\laravel-tel-input\src/../resources/views/assets.blade.php ENDPATH**/ ?>