@section('title', '34th Zenith Bank::Registration')
<main class="flex-grow p-4 lg:max-w-3xl lg:mx-auto w-full">
    <div class="bg-[#111010] bg-opacity-50 backdrop-filter backdrop-blur-md rounded-lg">
        <div class="px-4 py-8 lg:px-4 lg:py-16 mb-4 lg:mb-12">
            <div class="px-4 lg:px-16 w-full h-[150px] lg:h-[200px]">
                <img src="{{ asset('assets/images/logo_white.png') }}" alt=""
                     class="h-[150px] lg:h-[200px] w-full">
            </div>
            @if ($step_one)
                <div class="py-4 px-4 lg:py-4 lg:px-16">
                    <form method="POST" wire:submit.prevent="createBooking" class="space-y-4 w-full">
                        <div class="w-full">
                            <div class="relative h-14 flex items-center gap-2">
                                <!-- Input Field -->
                                <div class="relative h-full w-full">
                                    <input id="ran" type="text" wire:model.defer="ran"
                                           class="block px-3 pb-2.5 pt-4 w-full text-white bg-transparent rounded-lg appearance-none focus:outline-none peer peer-focus:outline-none focus:ring-0 border-0 focus:border-0 text-xs lg:text-sm"
                                           placeholder=""/>
                                    <label for="ran"
                                           class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] left-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-focus:scale-75 peer-focus:-translate-y-4 peer-focus:text-white peer-placeholder-shown:top-1/2 peer-focus:top-2 px-2 peer-focus:px-2 peer-[:not(:placeholder-shown)]:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-4 peer-[:not(:placeholder-shown)]:text-white peer-[:not(:placeholder-shown)]:top-2">RAN Code*</label>

                                    <!-- Corner & border divs (unchanged) -->
                                    <div class="absolute bottom-0 left-2 right-2 h-[1px] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white"></div>
                                    <div class="absolute bottom-2 left-0 w-[1px] h-[calc(100%-15px)] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white"></div>
                                    <div class="absolute bottom-2 right-0 w-[1px] h-[calc(100%-15px)] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white"></div>
                                    <div class="absolute top-0 left-[5px] peer-focus:left-[78px] peer-[:not(:placeholder-shown)]:left-[78px] right-[5px] h-[1px] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white"></div>
                                    <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-tl-lg"></div>
                                    <div class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-tr-lg"></div>
                                    <div class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-bl-lg"></div>
                                    <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-br-lg"></div>
                                </div>

                                <!-- Validate Button Inline -->
                                <button type="button"
                                        wire:click="validateRan"
                                        class="h-full bg-red-600 text-white px-4 lg:px-6 rounded-md uppercase font-semibold whitespace-nowrap">
                                    Validate
                                    <span wire:loading wire:target="validateRan">
                                        <i class="fas fa-spinner fa-spin"></i>
                                    </span>
                                </button>
                            </div>

                            @if($ran_error_message)
                            <p class="text-red-600 font-semibold text-xs mt-1">{{ $ran_error_message }}</p>
                            @endif
                        </div>

                    @if($validated_ran)
                        <div class="lg:flex lg:justify-between lg:items-center lg:space-x-5 space-y-5 lg:space-y-0 w-full mb-2">
                            <div class="w-full">
                                <div class="relative h-14">
                                    <input id="firstname" type="text" wire:model.defer="firstname"
                                           class="block px-3 pb-2.5 pt-4 w-full text-white bg-transparent rounded-lg appearance-none focus:outline-none peer peer-focus:outline-none focus:ring-0 border-0 focus:border-0 text-xs lg:text-sm"
                                           placeholder=" "/>
                                    <label for="firstname"
                                           class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] left-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-focus:scale-75 peer-focus:-translate-y-4 peer-focus:text-white peer-placeholder-shown:top-1/2 peer-focus:top-2 px-2 peer-focus:px-2 peer-[:not(:placeholder-shown)]:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-4 peer-[:not(:placeholder-shown)]:text-white peer-[:not(:placeholder-shown)]:top-2">First
                                        Name*</label>
                                    <div
                                            class="absolute bottom-0 left-2 right-2 h-[1px] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white">
                                    </div>
                                    <div
                                            class="absolute bottom-2 left-0 w-[1px] h-[calc(100%-15px)] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white">
                                    </div>
                                    <div
                                            class="absolute bottom-2 right-0 w-[1px] h-[calc(100%-15px)] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white">
                                    </div>
                                    <div
                                            class="absolute top-0 left-[5px] peer-focus:left-[78px] peer-[:not(:placeholder-shown)]:left-[78px] right-[5px] h-[1px] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white">
                                    </div>
                                    <div
                                            class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-tl-lg">
                                    </div>
                                    <div
                                            class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-tr-lg">
                                    </div>
                                    <div
                                            class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-bl-lg">
                                    </div>
                                    <div
                                            class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-br-lg">
                                    </div>
                                </div>

                                @error('firstname')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="w-full">
                                <div class="relative h-14">
                                    <input id="lastname" type="text" wire:model.defer="lastname"
                                           class="block px-3 pb-2.5 pt-4 w-full text-white bg-transparent rounded-lg appearance-none focus:outline-none peer peer-focus:outline-none focus:ring-0 border-0 focus:border-0 text-xs lg:text-sm"
                                           placeholder=" "/>
                                    <label for="lastname"
                                           class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] left-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-focus:scale-75 peer-focus:-translate-y-4 peer-focus:text-white peer-placeholder-shown:top-1/2 peer-focus:top-2 px-2 peer-focus:px-2 peer-[:not(:placeholder-shown)]:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-4 peer-[:not(:placeholder-shown)]:text-white peer-[:not(:placeholder-shown)]:top-2">Last
                                        Name*</label>
                                    <div
                                            class="absolute bottom-0 left-2 right-2 h-[1px] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white">
                                    </div>
                                    <div
                                            class="absolute bottom-2 left-0 w-[1px] h-[calc(100%-15px)] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white">
                                    </div>
                                    <div
                                            class="absolute bottom-2 right-0 w-[1px] h-[calc(100%-15px)] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white">
                                    </div>
                                    <div
                                            class="absolute top-0 left-[5px] peer-focus:left-[78px] peer-[:not(:placeholder-shown)]:left-[78px] right-[5px] h-[1px] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white">
                                    </div>
                                    <div
                                            class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-tl-lg">
                                    </div>
                                    <div
                                            class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-tr-lg">
                                    </div>
                                    <div
                                            class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-bl-lg">
                                    </div>
                                    <div
                                            class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-br-lg">
                                    </div>
                                </div>

                                @error('lastname')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="lg:flex lg:items-center lg:space-x-5 space-y-5 lg:space-y-0 w-full mb-2">
                            <div class="w-full">
                                <div class="relative h-14">
                                    <input id="email" type="text" wire:model.defer="email"
                                           class="block px-3 pb-2.5 pt-4 w-full text-white bg-transparent rounded-lg appearance-none focus:outline-none peer peer-focus:outline-none focus:ring-0 border-0 focus:border-0 text-xs lg:text-sm"
                                           placeholder=" "/>
                                    <label for="email"
                                           class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] left-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-focus:scale-75 peer-focus:-translate-y-4 peer-focus:text-white peer-placeholder-shown:top-1/2 peer-focus:top-2 px-2 peer-focus:px-2 peer-[:not(:placeholder-shown)]:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-4 peer-[:not(:placeholder-shown)]:text-white peer-[:not(:placeholder-shown)]:top-2">Email
                                        *</label>
                                    <div
                                            class="absolute bottom-0 left-2 right-2 h-[1px] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white">
                                    </div>
                                    <div
                                            class="absolute bottom-2 left-0 w-[1px] h-[calc(100%-15px)] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white">
                                    </div>
                                    <div
                                            class="absolute bottom-2 right-0 w-[1px] h-[calc(100%-15px)] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white">
                                    </div>
                                    <div
                                            class="absolute top-0 left-[5px] peer-focus:left-[60px] peer-[:not(:placeholder-shown)]:left-[60px] right-[5px] h-[1px] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white">
                                    </div>
                                    <div
                                            class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-tl-lg">
                                    </div>
                                    <div
                                            class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-tr-lg">
                                    </div>
                                    <div
                                            class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-bl-lg">
                                    </div>
                                    <div
                                            class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-br-lg">
                                    </div>
                                </div>

                                @error('email')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="w-full">
                                <div class="relative h-14">
                                    <input id="phone" type="text" wire:model.defer="phone"
                                           class="block px-3 pb-2.5 pt-4 w-full text-white bg-transparent rounded-lg appearance-none focus:outline-none peer peer-focus:outline-none focus:ring-0 border-0 focus:border-0 text-xs lg:text-sm"
                                           placeholder=" "/>
                                    <label for="phone"
                                           class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] left-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-focus:scale-75 peer-focus:-translate-y-4 peer-focus:text-white peer-placeholder-shown:top-1/2 peer-focus:top-2 px-2 peer-focus:px-2 peer-[:not(:placeholder-shown)]:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-4 peer-[:not(:placeholder-shown)]:text-white peer-[:not(:placeholder-shown)]:top-2">Phone Number
                                        *</label>
                                    <div
                                            class="absolute bottom-0 left-2 right-2 h-[1px] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white">
                                    </div>
                                    <div
                                            class="absolute bottom-2 left-0 w-[1px] h-[calc(100%-15px)] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white">
                                    </div>
                                    <div
                                            class="absolute bottom-2 right-0 w-[1px] h-[calc(100%-15px)] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white">
                                    </div>
                                    <div
                                            class="absolute top-0 left-[5px] peer-focus:left-[110px] peer-[:not(:placeholder-shown)]:left-[110px] right-[5px] h-[1px] bg-white peer-focus:bg-white peer-[:not(:placeholder-shown)]:bg-white">
                                    </div>
                                    <div
                                            class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-tl-lg">
                                    </div>
                                    <div
                                            class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-tr-lg">
                                    </div>
                                    <div
                                            class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-bl-lg">
                                    </div>
                                    <div
                                            class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-white peer-focus:border-white peer-[:not(:placeholder-shown)]:border-white rounded-br-lg">
                                    </div>
                                </div>

                                @error('phone')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center mb-0">

                            @if($error_message)
                                <p class="text-red-600 font-semibold  text-lg">{{ $error_message }}</p>
                                @enderror
                                <button type="submit"
                                        class="bg-red-600 text-white px-8 py-3 rounded-md w-full uppercase font-semibold">
                                    Submit
                                    <span wire:loading wire:target="createBooking">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </span>
                                </button>

                        </div>
                    </form>
                </div>
            @endif
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
                                    you for registering for the Zenith Bank Tech Fair Future Forward 4.0.
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
        </div>
    </div>

    @if ($show_consent)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50"
             x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" id="consentModal">
            <div class="bg-white rounded-lg p-4 lg:p-6 w-4/5 lg:w-1/2">
                <header class="text-left py-4 px-2">
                    <h2 class="font-semibold text-xl text-[#222222] text-center">Privacy Policy</h2>
                    <p class="text-xs text-gray-500 font-light"></p>
                </header>
                <main class="p-3">
                    <div class="grid grid-cols-1 text-center space-y-5">
                        <div class="space-y-5 mb-2">
                            <p>{{env('APP_NAME')}} is committed to protecting your privacy.
                                The information you provide will be used exclusively to process your registration for
                                the Zenith Tech Fair, to send you related updates about the event and to inform you
                                about our products and service offerings.
                                You can opt out of these communications at any time by clicking the unsubscribe
                                option on the emails.
                            </p>

                            <p> Please confirm your consent to the collection of your personal information and receiving
                                these messages by clicking the <b>Yes</b> option below.
                            </p>
                        </div>

                        <div
                                class="block lg:flex lg:justify-around lg:space-x-5 space-y-5 lg:space-y-0 lg:items-center">
                            <button type="button" wire:click="attestConsent"
                                    class="bg-white border border-red-600 text-red-600 py-2 px-6 font-semibold rounded-md w-full lg:w-1/2">
                                Yes
                                <span wire:loading wire:target="attestConsent">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </span>
                            </button>

                            {{--                            <button type="button" wire:click="rejectConsent"--}}
                            {{--                                    class="bg-red-600 text-white py-2 px-6 font-semibold rounded-md w-full lg:w-1/2">--}}
                            {{--                                No--}}
                            {{--                                <span wire:loading wire:target="rejectConsent">--}}
                            {{--                                    <i class="fas fa-spinner fa-spin"></i>--}}
                            {{--                                </span>--}}
                            {{--                            </button>--}}
                        </div>
                    </div>
                </main>
            </div>
        </div>
    @endif

    <div class="w-full">
        <p class="text-white text-center mx-auto text-xs lg:text-sm">November 21, 2024.</p>
    </div>
</main>
