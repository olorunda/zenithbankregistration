<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <?php echo \Victorybiz\LaravelTelInput\LaravelTelInputAssetLoader::outputStyles(); ?>
    <?php echo \Livewire\Livewire::styles(); ?>


    <link rel="manifest" href="<?php echo e(asset('manifest.json')); ?>">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js']); ?>
    <script>
        if (typeof navigator.serviceWorker !== 'undefined') {
            navigator.serviceWorker.register('<?php echo e(asset('sw.js')); ?>')
        }
    </script>

</head>

<body class="bg-[url('/assets/images/bg.png')] flex flex-col font-Poppins bg-no-repeat min-h-screen" style="background-size: 100% 100%">

    <nav class="flex items-center w-full justify-end">
        <div class="py-4 px-2 lg:px-8 lg:py-8">
            <a href="<?php echo e(route('welcome')); ?>" class="">
                <img src="/assets/images/logo.svg" alt="" class="w-12 lg:w-24 mx-auto">
            </a>
        </div>
    </nav>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo \Livewire\Livewire::scripts(); ?>

    <?php echo \Victorybiz\LaravelTelInput\LaravelTelInputAssetLoader::outputScripts(); ?>
    <script>
        Livewire.on('hideOtherClasses', hide_or_show_masterclasses => {
            alert('A post was added with the id of: ' + hide_or_show_masterclasses);
        })
    </script>
</body>

</html>
<?php /**PATH C:\Users\ADMIN\PhpstormProjects\zenithbank\resources\views/layouts/app.blade.php ENDPATH**/ ?>