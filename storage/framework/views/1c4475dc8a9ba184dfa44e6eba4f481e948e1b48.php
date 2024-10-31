<div>
    <?php if ($__env->exists($beforeTableSlot)) echo $__env->make($beforeTableSlot, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="relative">
        <div class="flex items-center justify-between mb-1">
            <div class="flex items-center h-10">
                <?php if($this->searchableColumns()->count()): ?>
                    <div class="flex rounded-lg w-96 shadow-sm">
                        <div class="relative flex-grow focus-within:z-10">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" stroke="currentColor" fill="none">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input wire:model.debounce.500ms="search" class="block w-full py-3 pl-10 text-sm border-gray-300 leading-4 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 focus:outline-none" placeholder="<?php echo e(__('Search in')); ?> <?php echo e($this->searchableColumns()->map->label->join(', ')); ?>" type="text" />
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2">
                                <button wire:click="$set('search', null)" class="text-gray-300 hover:text-red-600 focus:outline-none">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'icons::x-circle','data' => ['class' => 'w-5 h-5 stroke-current']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('icons.x-circle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 stroke-current']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if($this->activeFilters): ?>
                <span class="text-xl text-blue-400 uppercase"><?php echo app('translator')->get('Filter active'); ?></span>
            <?php endif; ?>

            <div class="flex flex-wrap items-center space-x-1">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'icons::cog','data' => ['wire:loading' => true,'class' => 'text-gray-400 h-9 w-9 animate-spin']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('icons.cog'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:loading' => true,'class' => 'text-gray-400 h-9 w-9 animate-spin']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                <?php if($this->activeFilters): ?>
                    <button wire:click="clearAllFilters" class="flex items-center px-3 text-xs font-medium tracking-wider text-red-500 uppercase bg-white border border-red-400 space-x-2 rounded-md leading-4 hover:bg-red-200 focus:outline-none"><span><?php echo e(__('Reset')); ?></span>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'icons::x-circle','data' => ['class' => 'm-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('icons.x-circle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'm-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </button>
                <?php endif; ?>

                <?php if(count($this->massActionsOptions)): ?>
                    <div class="flex items-center justify-center space-x-1">
                        <label for="datatables_mass_actions"><?php echo e(__('With selected')); ?>:</label>
                        <select wire:model="massActionOption" class="px-3 text-xs font-medium tracking-wider uppercase bg-white border border-green-400 space-x-2 rounded-md leading-4 focus:outline-none" id="datatables_mass_actions">
                            <option value=""><?php echo e(__('Choose...')); ?></option>
                            <?php $__currentLoopData = $this->massActionsOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!$group): ?>
                                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item['value']); ?>"><?php echo e($item['label']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <optgroup label="<?php echo e($group); ?>">
                                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item['value']); ?>"><?php echo e($item['label']); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </optgroup>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <button
                            wire:click="massActionOptionHandler"
                            class="flex items-center px-4 py-2 text-xs font-medium tracking-wider text-green-500 uppercase bg-white border border-green-400 rounded-md leading-4 hover:bg-green-200 focus:outline-none" type="submit" title="Submit"
                        >Go</button>
                    </div>
                <?php endif; ?>

                <?php if($exportable): ?>
                    <div x-data="{ init() {
                        window.livewire.on('startDownload', link => window.open(link, '_blank'))
                        } }" x-init="init">
                        <button wire:click="export" class="flex items-center px-3 text-xs font-medium tracking-wider text-red-500 uppercase bg-white border border-red-400 space-x-2 rounded-md leading-4 hover:bg-red-200 focus:outline-none"><span><?php echo e(__('Export')); ?></span>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'icons::excel','data' => ['class' => 'm-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('icons.excel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'm-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?></button>
                    </div>
                <?php endif; ?>

                <?php if($hideable === 'select'): ?>
                    <?php echo $__env->make('datatables::hide-column-multiselect', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>

                <?php $__currentLoopData = $columnGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button wire:click="toggleGroup('<?php echo e($name); ?>')"
                            class="px-3 py-2 text-xs font-medium tracking-wider text-green-500 uppercase bg-white border border-green-400 rounded-md leading-4 hover:bg-green-200 focus:outline-none">
                        <span class="flex items-center h-5"><?php echo e(isset($this->groupLabels[$name]) ? __($this->groupLabels[$name]) : __('Toggle :group', ['group' => $name])); ?></span>
                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if ($__env->exists($buttonsSlot)) echo $__env->make($buttonsSlot, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>

        <?php if($hideable === 'buttons'): ?>
            <div class="p-2 grid grid-cols-8 gap-2">
                <?php $__currentLoopData = $this->columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($column['hideable']): ?>
                        <button wire:click.prefetch="toggle('<?php echo e($index); ?>')" class="px-3 py-2 rounded text-white text-xs focus:outline-none
                        <?php echo e($column['hidden'] ? 'bg-blue-100 hover:bg-blue-300 text-blue-600' : 'bg-blue-500 hover:bg-blue-800'); ?>">
                            <?php echo e($column['label']); ?>

                        </button>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <div wire:loading.class="opacity-50" class="rounded-lg <?php if (! ($complex || $this->hidePagination)): ?> rounded-b-none <?php endif; ?> shadow-lg bg-white max-w-screen overflow-x-scroll border-2 <?php if($this->activeFilters): ?> border-blue-500 <?php else: ?> border-transparent <?php endif; ?> <?php if($complex): ?> rounded-b-none border-b-0 <?php endif; ?>">
            <div>
                <div class="table min-w-full align-middle">
                    <?php if (! ($this->hideHeader)): ?>
                        <div class="table-row divide-x divide-gray-200">
                            <?php $__currentLoopData = $this->columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($hideable === 'inline'): ?>
                                    <?php echo $__env->make('datatables::header-inline-hide', ['column' => $column, 'sort' => $sort], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php elseif($column['type'] === 'checkbox'): ?>
                                    <?php if (! ($column['hidden'])): ?>
                                        <div class="flex justify-center table-cell w-32 h-12 px-6 py-4 overflow-hidden text-xs font-medium tracking-wider text-left text-gray-500 uppercase align-top border-b border-gray-200 bg-gray-50 leading-4 focus:outline-none">
                                            <div class="px-3 py-1 rounded <?php if(count($selected)): ?> bg-orange-400 <?php else: ?> bg-gray-200 <?php endif; ?> text-white text-center">
                                                <?php echo e(count($visibleSelected)); ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php echo $__env->make('datatables::header-no-hide', ['column' => $column, 'sort' => $sort], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="table-row bg-blue-100 divide-x divide-blue-200">
                        <?php $__currentLoopData = $this->columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($column['hidden']): ?>
                                <?php if($hideable === 'inline'): ?>
                                    <div class="table-cell w-5 overflow-hidden align-top bg-blue-100"></div>
                                <?php endif; ?>
                            <?php elseif($column['type'] === 'checkbox'): ?>
                                <?php echo $__env->make('datatables::filters.checkbox', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php elseif($column['type'] === 'label'): ?>
                                <div class="table-cell overflow-hidden align-top">
                                    <?php echo e($column['label'] ?? ''); ?>

                                </div>
                            <?php else: ?>
                                <div class="table-cell overflow-hidden align-top">
                                    <?php if(isset($column['filterable'])): ?>
                                        <?php if( is_iterable($column['filterable']) ): ?>
                                            <div wire:key="<?php echo e($index); ?>">
                                                <?php echo $__env->make('datatables::filters.select', ['index' => $index, 'name' => $column['label'], 'options' => $column['filterable']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </div>
                                        <?php else: ?>
                                            <div wire:key="<?php echo e($index); ?>">
                                                <?php echo $__env->make('datatables::filters.' . ($column['filterView'] ?? $column['type']), ['index' => $index, 'name' => $column['label']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php $__currentLoopData = $this->results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="table-row p-1 <?php echo e($this->rowClasses($row, $loop)); ?>">
                            <?php $__currentLoopData = $this->columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($column['hidden']): ?>
                                    <?php if($hideable === 'inline'): ?>
                                        <div class="table-cell w-5 <?php if (! ($column['wrappable'])): ?> whitespace-nowrap truncate <?php endif; ?> overflow-hidden align-top"></div>
                                    <?php endif; ?>
                                <?php elseif($column['type'] === 'checkbox'): ?>
                                    <?php echo $__env->make('datatables::checkbox', ['value' => $row->checkbox_attribute], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php elseif($column['type'] === 'label'): ?>
                                    <?php echo $__env->make('datatables::label', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php else: ?>

                                    <div class="table-cell px-6 py-2 <?php if (! ($column['wrappable'])): ?> whitespace-nowrap truncate <?php endif; ?> <?php if($column['contentAlign'] === 'right'): ?> text-right <?php elseif($column['contentAlign'] === 'center'): ?> text-center <?php else: ?> text-left <?php endif; ?> <?php echo e($this->cellClasses($row, $column)); ?>">
                                        <?php echo $row->{$column['name']}; ?>

                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if($this->hasSummaryRow()): ?>
                        <div class="table-row p-1">
                            <?php $__currentLoopData = $this->columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if (! ($column['hidden'])): ?>
                                    <?php if($column['summary']): ?>
                                        <div class="table-cell px-6 py-2 <?php if (! ($column['wrappable'])): ?> whitespace-nowrap truncate <?php endif; ?> <?php if($column['contentAlign'] === 'right'): ?> text-right <?php elseif($column['contentAlign'] === 'center'): ?> text-center <?php else: ?> text-left <?php endif; ?> <?php echo e($this->cellClasses($row, $column)); ?>">
                                            <?php echo e($this->summarize($column['name'])); ?>

                                        </div>
                                    <?php else: ?>
                                        <div class="table-cell"></div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if($this->results->isEmpty()): ?>
                <p class="p-3 text-lg text-center">
                    <?php echo e(__("There's Nothing to show at the moment")); ?>

                </p>
            <?php endif; ?>
        </div>

        <?php if (! ($this->hidePagination)): ?>
            <div class="max-w-screen bg-white <?php if (! ($complex)): ?> rounded-b-lg <?php endif; ?> border-4 border-t-0 border-b-0 <?php if($this->activeFilters): ?> border-blue-500 <?php else: ?> border-transparent <?php endif; ?>">
                <div class="items-center justify-between p-2 sm:flex">
                    
                    <?php if(count($this->results)): ?>
                        <div class="flex items-center my-2 sm:my-0">
                            <select name="perPage" class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 form-select leading-6 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5" wire:model="perPage">
                                <?php $__currentLoopData = config('livewire-datatables.per_page_options', [ 10, 25, 50, 100 ]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $per_page_option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($per_page_option); ?>"><?php echo e($per_page_option); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <option value="99999999"><?php echo e(__('All')); ?></option>
                            </select>
                        </div>

                        <div class="my-4 sm:my-0">
                            <div class="lg:hidden">
                                <span class="space-x-2"><?php echo e($this->results->links('datatables::tailwind-simple-pagination')); ?></span>
                            </div>

                            <div class="justify-center hidden lg:flex">
                                <span><?php echo e($this->results->links('datatables::tailwind-pagination')); ?></span>
                            </div>
                        </div>

                        <div class="flex justify-end text-gray-600">
                            <?php echo e(__('Results')); ?> <?php echo e($this->results->firstItem()); ?> - <?php echo e($this->results->lastItem()); ?> <?php echo e(__('of')); ?>

                            <?php echo e($this->results->total()); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if($complex): ?>
        <div class="bg-gray-50 px-4 py-4 rounded-b-lg rounded-t-none shadow-lg border-2 <?php if($this->activeFilters): ?> border-blue-500 <?php else: ?> border-transparent <?php endif; ?> <?php if($complex): ?> border-t-0 <?php endif; ?>">
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('complex-query', ['columns' => $this->complexColumns,'persistKey' => $this->persistKey,'savedQueries' => method_exists($this, 'getSavedQueries') ? $this->getSavedQueries() : null])->html();
} elseif ($_instance->childHasBeenRendered('l1158189048-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l1158189048-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l1158189048-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l1158189048-0');
} else {
    $response = \Livewire\Livewire::mount('complex-query', ['columns' => $this->complexColumns,'persistKey' => $this->persistKey,'savedQueries' => method_exists($this, 'getSavedQueries') ? $this->getSavedQueries() : null]);
    $html = $response->html();
    $_instance->logRenderedChild('l1158189048-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
    <?php endif; ?>

    <?php if ($__env->exists($afterTableSlot)) echo $__env->make($afterTableSlot, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <span class="hidden text-sm text-left text-center text-right text-gray-900 bg-gray-100 bg-yellow-100 leading-5 bg-gray-50"></span>
</div>
<?php /**PATH C:\Users\ADMIN\PhpstormProjects\zenithbank\resources\views/livewire/datatables/datatable.blade.php ENDPATH**/ ?>