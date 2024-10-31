<?php if (! ($column['hidden'])): ?>
    <div
        <?php if(isset($column['tooltip']['text'])): ?> title="<?php echo e($column['tooltip']['text']); ?>" <?php endif; ?>
                                                class="relative table-cell h-12 overflow-hidden align-top" <?php echo $__env->make('datatables::style-width', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>>
        <?php if($column['sortable']): ?>
            <button wire:click="sort('<?php echo e($index); ?>')" class="w-full h-full px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider flex items-center focus:outline-none <?php if($column['headerAlign'] === 'right'): ?> justify-end <?php elseif($column['headerAlign'] === 'center'): ?> justify-center <?php endif; ?>">
                <span class="inline "><?php echo e(str_replace('_', ' ', $column['label'])); ?></span>
                <span class="inline text-xs text-blue-400">
                    <?php if($sort === $index): ?>
                        <?php if($direction): ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'icons::chevron-up','data' => ['wire:loading.remove' => true,'class' => 'w-6 h-6 text-green-600 stroke-current']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('icons.chevron-up'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:loading.remove' => true,'class' => 'w-6 h-6 text-green-600 stroke-current']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php else: ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'icons::chevron-down','data' => ['wire:loading.remove' => true,'class' => 'w-6 h-6 text-green-600 stroke-current']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('icons.chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:loading.remove' => true,'class' => 'w-6 h-6 text-green-600 stroke-current']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </span>
            </button>
        <?php else: ?>
            <div class="w-full h-full px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider flex items-center focus:outline-none <?php if($column['headerAlign'] === 'right'): ?> justify-end <?php elseif($column['headerAlign'] === 'center'): ?> justify-center <?php endif; ?>">
                <span class="inline "><?php echo e(str_replace('_', ' ', $column['label'])); ?></span>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\ADMIN\PhpstormProjects\zenithbank\resources\views/livewire/datatables/header-no-hide.blade.php ENDPATH**/ ?>