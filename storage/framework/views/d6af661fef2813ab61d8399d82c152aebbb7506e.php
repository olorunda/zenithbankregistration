<?php $__env->startSection('title', 'Zenith Bank Trade Seminar::Login'); ?>
<div class="flex flex-col h-screen font-Poppins bg-gradient-to-b from-red-300 to-blue-200">
    <div class="grid place-items-center mx-2 my-20 sm:my-auto">
        <div class="w-11/12 p-12 sm:w-8/12 md:w-6/12 lg:w-5/12 2xl:w-4/12
            px-6 py-10 sm:px-10 sm:py-6
            bg-white rounded-lg shadow-md lg:shadow-lg">
            <div class="text-center mb-5">
                <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="" class="mx-auto w-24">
            </div>
            <form class="space-y-5" method="POST" wire:submit.prevent="authenticateUser">
                <?php echo e(csrf_field()); ?>

                <div>
                    <label for="username" class="block text-xs font-semibold text-gray-600 uppercase">Username</label>
                    <input id="username" type="text" wire:model.defer="username"
                        class="block w-full py-3 px-3 mt-2
                        text-gray-800 appearance-none border border-gray-300 focus:outline-none focus:border-gray-200 rounded-md"/>
                        <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 font-normal"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="password" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Password</label>
                    <input id="password" type="password" wire:model.defer="password" autocomplete="current-password"
                        class="block w-full py-3 px-3 mt-2
                        text-gray-800 appearance-none border border-gray-300 focus:outline-none focus:border-gray-200 rounded-md"/>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 font-normal"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Auth Buttton -->
                <button type="submit"
                    class="w-full py-3 mt-10 bg-red-600 rounded-md
                    font-medium text-white uppercase
                    focus:outline-none hover:shadow-none">
                    Login
                    <span wire:loading wire:target="authenticateUser">
                        <i class="fas fa-spinner fa-spin" ></i>
                    </span>
                </button>

            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\ADMIN\PhpstormProjects\zenithbank\resources\views/livewire/portal/login.blade.php ENDPATH**/ ?>