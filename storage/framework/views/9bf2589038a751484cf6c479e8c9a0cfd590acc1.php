<?php $__env->startSection('page-title', '404::'.config('laravel-error-views.title.404')); ?>

<?php $__env->startSection('title', __(config('laravel-error-views.title.404'))); ?>

<?php $__env->startSection('logo'); ?>
    <img src="<?php echo e(asset('vendor/laravel-error-views/svg/404.svg')); ?>" alt="404" class="mb-4">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('message', __(config('laravel-error-views.message.404'))); ?>
<?php echo $__env->make('errors::layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\PhpstormProjects\zenithbank\resources\views/errors/404.blade.php ENDPATH**/ ?>