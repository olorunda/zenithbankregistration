<?php $__env->startSection('title', 'Zenith Bank Trade Seminar::Dashboard'); ?>
<div class="container mx-auto px-6 py-8">
    <div class="grid grid-cols-1 lg:gap-x-8 gap-y-5 mb-4">
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-[#101010] text-base lg:text-2xl">Dashboard</h2>
            </div>
        </div>
    </div>

    <div class="p-4 bg-white rounded-lg">
        <div class='overflow-x-auto w-full'>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('tables.dashboard', [])->html();
} elseif ($_instance->childHasBeenRendered('l1141993720-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l1141993720-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l1141993720-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l1141993720-0');
} else {
    $response = \Livewire\Livewire::mount('tables.dashboard', []);
    $html = $response->html();
    $_instance->logRenderedChild('l1141993720-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
    </div>

</div>
<?php /**PATH C:\Users\ADMIN\PhpstormProjects\zenithbank\resources\views/livewire/portal/dashboard.blade.php ENDPATH**/ ?>