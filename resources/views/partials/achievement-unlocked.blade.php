@if(Session::has('achievement'))
    <div id="achievement-modal" class="fixed inset-0 z-50 flex flex-col justify-center content-center bg-black-t-30 p-4">
        <div class="relative shadow-md rounded-xl p-8 bg-white" data-confetti>
            <span class="absolute top-0 right-0 m-2 h-8 w-8" data-closer="#achievement-modal">
                @svg('icons/cross')
            </span>
            <div class="mb-4 p-4">
                @svg('achievement-trophy', 'w-full h-auto')
            </div>

            <div class="text-center">
                <h3 class="font-bold text-xl">
                    Achievement Unlocked
                </h3>

                <h4 class="font-bold">
                    {{ Session::get('achievement')->name }}
                </h4>

                <p>
                    {{ Session::get('achievement')->description }}
                </p>
            </div>
        </div>
    </div>
@endif
