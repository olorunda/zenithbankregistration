<?php $__env->startSection('title', 'Zenith Bank Trade Seminar::Attendance'); ?>
<div class="container mx-auto px-6 py-8">
    <div class="grid grid-cols-1 lg:gap-x-8 gap-y-5 mb-4">
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-[#101010] text-base lg:text-2xl">Attendance</h2>
            </div>
        </div>
    </div>

    <div class="p-4 bg-white rounded-lg">
        <div class='overflow-x-auto w-full'>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('tables.admissions', [])->html();
} elseif ($_instance->childHasBeenRendered('l600336044-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l600336044-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l600336044-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l600336044-0');
} else {
    $response = \Livewire\Livewire::mount('tables.admissions', []);
    $html = $response->html();
    $_instance->logRenderedChild('l600336044-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
    </div>

</div>
<?php /**PATH C:\Users\ADMIN\PhpstormProjects\zenithbank\resources\views/livewire/portal/attendances.blade.php ENDPATH**/ ?>