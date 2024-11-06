<?php $__env->startSection('title', 'Zenith Bank Tech Fair 4.0::Details'); ?>
<div class="container mx-auto px-6 py-8">
    <div class="grid grid-cols-1 lg:gap-x-8 gap-y-5 mb-4">
        <div class="flex items-left">
            <h2 class="font-bold text-[#101010] text-base lg:text-2xl">Registration Details</h2>
           <div>
            <?php if(is_null($details->date_used)): ?>
                <a href="#" wire:click.prevent="markPresent"
                   class="text-sm border-4 bg-green-600 text-white py-2 px-6 rounded-md">
                    Mark Present
                    <span wire:loading wire:target="markPresent">
                        <i class="fas fa-spinner fa-spin"></i>
                    </span>
                </a>
            <?php endif; ?>

            <?php if($details->registration->attending_masterclass=='yes' && is_null($details->date_used_master_class)): ?>
                <a href="#" wire:click.prevent="markPresentMasterClass"
                   class="text-sm  border-4 bg-red-400 text-white py-2 px-6 rounded-md">
                    Mark Present (<?php echo e($details->registration->master_classes); ?>)
                    <span wire:loading wire:target="markPresentMasterClass">
                        <i class="fas fa-spinner fa-spin"></i>
                    </span>
                </a>
            <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="p-4 bg-white">
        <div class="text-center">
            <div class="mb-4">
                <img src="<?php echo e($details->url); ?>" alt="" srcset=""
                     class="h-36 w-36 rounded-md border-2 border-gray-700 object-cover mx-auto">
            </div>
            <div class="text-center">
                <h6 class="font-semibold"><?php echo e($details->registration->name); ?>

                </h6>
                <p class="text-xs text-[#544837] mb-8"><?php echo e($details->registration->email); ?></p>

                <div class="grid grid-cols-1 lg:grid-cols-3 mb-4 border-b-2 border-gray-300 pb-4">
                    <div class="text-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-center mx-auto" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <h6 class="font-semibold text-[#544837] mt-2"><?php echo e($details->registration->phone); ?></h6>
                    </div>

                    <div class="text-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="h-6 w-6 text-center mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z"/>
                        </svg>

                        <h6 class="font-semibold text-[#544837] mt-2"><?php echo e($details->registration->company); ?></h6>
                    </div>

                    <div class="text-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-center mx-auto" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <h6 class="font-semibold text-[#544837] mt-2">
                            <?php echo e($details->attendance ? \Carbon\Carbon::parse($details->attendance->date_admitted)->format('j F, Y H:i a') : 'N/A'); ?>

                        </h6>

                    </div>
                </div>

                <?php if($details->registration->attending_masterclass=='yes' ): ?>
                    <div class="border-b-2 border-gray-300 pb-4 mb-4">

                        <h6 class="text-left text-[#544837] font-semibold mb-2">Date Admitted for
                            : <?php echo e($details->registration->master_classes); ?> </h6>
                        <div class="text-left">
                            <?php echo e($details->attendance ? \Carbon\Carbon::parse($details->attendance->date_admitted_master_class)->format('j F, Y H:i a') : 'N/A'); ?>

                        </div>

                    </div>
                <?php endif; ?>

                <div class="border-b-2 border-gray-300 pb-4 mb-4">
                    <h6 class="text-left text-[#544837] font-semibold mb-2">Consent:</h6>
                    <div class="text-left">
                        <?php echo e($details->registration->consent); ?>

                    </div>
                </div>

                <div class="border-b-2 border-gray-300 pb-4 mb-4">
                    <h6 class="text-left text-[#544837] font-semibold mb-2">Is Zenith Customer:</h6>
                    <div class="text-left">
                        <?php echo e($details->registration->is_zenith_customer); ?>

                    </div>
                </div>

                <div class="border-b-2 border-gray-300 pb-4 mb-4">
                    <h6 class="text-left text-[#544837] font-semibold mb-2">Date Registered:</h6>
                    <div class="text-left">
                        <?php echo e(\Carbon\Carbon::parse($details->registration->created_at)->format('j F, Y H:i a')); ?>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
<?php /**PATH C:\Users\ADMIN\PhpstormProjects\zenithbank\resources\views/livewire/portal/view-details.blade.php ENDPATH**/ ?>
