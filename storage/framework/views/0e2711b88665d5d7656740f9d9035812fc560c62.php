
<input
  type="hidden"
  id="<?php echo e($id); ?>"
  name="<?php echo e($name); ?>"
  <?php if($attributes->whereStartsWith('wire:model')->first()): ?>
    <?php echo e($attributes->wire('model')); ?>

  <?php endif; ?>
  <?php if($attributes->has('value')): ?>
    value="<?php echo e($attributes->get('value')); ?>"
  <?php endif; ?>
  autocomplete="off"
>

<span wire:ignore>
  <input
    type="tel"
    class="iti--laravel-tel-input <?php echo e($attributes->get('class')); ?>"
    data-phone-input-id="<?php echo e($id); ?>"
    data-phone-input-name="<?php echo e($name); ?>"
    data-phone-input="#<?php echo e($id); ?>"
    <?php if($attributes->has('value')): ?>
      value="<?php echo e($attributes->get('value')); ?>"
    <?php endif; ?>
    <?php if($attributes->has('phone-country-input')): ?>
      data-phone-country-input="<?php echo e($attributes->get('phone-country-input')); ?>"
    <?php endif; ?>
    <?php if($attributes->has('placeholder')): ?>
      placeholder="<?php echo e($attributes->get('placeholder')); ?>"
    <?php endif; ?>
    <?php if($attributes->has('required')): ?>
      required
    <?php endif; ?>
    <?php if($attributes->has('disabled')): ?>
    disabled
    <?php endif; ?>
    autocomplete="off"
  >
</span>
<?php /**PATH C:\Users\ADMIN\PhpstormProjects\zenithbank\vendor\victorybiz\laravel-tel-input\src/../resources/views/components/laravel-tel-input.blade.php ENDPATH**/ ?>