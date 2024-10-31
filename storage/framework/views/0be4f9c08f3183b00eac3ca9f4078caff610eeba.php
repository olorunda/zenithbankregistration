<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="shortcut icon" type="image/jpg" href=""/>
    <?php echo $__env->yieldContent('styles'); ?>
    <?php echo \Livewire\Livewire::styles(); ?>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js']); ?>
</head>

<body class="bg-gray-200 font-Poppins">
    <div>
        <div x-data="{ sidebarOpen: false }">
            <div class="flex h-screen font-Poppins">
                <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

                <?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="flex-1 flex flex-col overflow-hidden">
                    <?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <main class="flex-1 overflow-x-hidden overflow-y-auto">
                        <?php echo $__env->yieldContent('content'); ?>
                    </main>
                </div>
            </div>
        </div>
    </div>

    <?php echo \Livewire\Livewire::scripts(); ?>


</body>
</html>
<?php /**PATH C:\Users\ADMIN\PhpstormProjects\zenithbank\resources\views/layouts/portal/dashboard.blade.php ENDPATH**/ ?>