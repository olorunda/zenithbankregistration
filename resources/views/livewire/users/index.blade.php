@section('title', 'Zenith Tech Fair 2024 4.0::Registration')
@section('title', 'Zenith Tech Fair 2024 4.0::Registration')
<div class="relative z-10 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-xl w-full">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">34TH ZENITH BANK</h1>
            <h2 class="text-3xl font-bold text-red-600">ANNUAL GENERAL MEETING</h2>
        </div>

        @if($step_one)
        <!-- Form Card -->
        <div class="bg-red-50/80 rounded-lg p-8">
            <form class="space-y-6" method="POST" wire:submit.prevent="createBooking">
                <!-- RAN Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        RAN*
                    </label>
                    <div class="flex gap-2">
                        <input
                                wire:model.defer="ran"
                                id="ran"
                                type="text"
                                class="flex-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-red-500"
                                placeholder="Enter RAN"
                        />
                        <button   wire:click="validateRan"
                                type="button"
                                class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition-colors"
                        >
                            Verify
                            <span wire:loading wire:target="validateRan">
                                        <i class="fas fa-spinner fa-spin"></i>
                                    </span>
                        </button>

                    </div>
                    @if($ran_error_message)
                        <p class="text-red-600 font-semibold text-xs mt-1">{{ $ran_error_message }}</p>
                    @endif
                </div>

                <!-- Name Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Name*
                    </label>
                    <input wire:model.defer="name"
                            type="text" readonly
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-red-500"
                            placeholder="Enter Name"
                    />
                </div>
                @error('name')
                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                @enderror
                <!-- Email Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Email*
                    </label>
                    <input wire:model.defer="email"
                            type="email" readonly
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-red-500"
                            placeholder="Enter Email"
                    />
                    @error('email')
                    <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Checkbox -->
                <div class="flex items-center">
                    <input wire:model.defer="consent" wire:value="yes"
                            type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500"
                    />
                    <label class="ml-2 block text-sm text-gray-700">
                        I confirm I have read Privacy Policy and I agree to the use of my data
                    </label>

                </div>
                @if($error_message)
                    <p class="text-red-600 font-semibold text-xs mt-1">{{ $error_message }}</p>
                @endif
                <!-- Submit Button -->
                <button
                        type="submit"
                        class="w-full bg-red-600 text-white rounded py-3 px-4 hover:bg-red-700 transition-colors font-medium"
                >
                    Submit
                    <span wire:loading wire:target="createBooking">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </span>
                </button>
            </form>
        </div>
    </div>
</div>
@endif

@if ($final_step)
    <div class="">
        <div class="grid grid-cols-1 place-items-center w-full my-auto px-4 lg:px-16 py-4">
            <div class="bg-white border border-gray-100 shadow-lg py-2 rounded-2xl mb-8">
                <div class="text-center mb-4">
                    <h6 class="text-sm lg:text-lg mb-2 font-semibold">Registration Successful</h6>
                </div>
                <div class="text-center mb-4">
                    <img src="{{ $qr_code_url }}" alt="" srcset="" class="mx-auto w-1/4">
                </div>
                <div class="text-center mb-4">
                    <p>
                        <strong> Access Code:</strong> {{$this->token_show}}
                    </p>
                </div>
                <div class="text-center px-6 lg:px-8">
                    <p class="text-[#4F596A] font-medium mb-2 text-sm">Hey
                        <strong>{{ $lastname }}</strong>,
                        thank
                        you for registering for the 34th Zenith Bank Annual General Meeting
                    </p>
                </div>
            </div>
            <p class="text-white text-sm font-medium text-center">Kindly come along with the QR code to the
                venue for
                Entrance.</p>

            <p class="text-white text-sm font-medium text-center">
                <button onclick="window.location.reload()" type="button"
                        class="bg-red-600 text-white px-8 py-3 rounded-md w-full uppercase font-semibold">
                    Done
                </button>
            </p>
        </div>

    </div>
@endif

