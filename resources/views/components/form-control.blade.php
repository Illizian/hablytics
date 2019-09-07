<label class="block">
    @if(empty($labelFirst) || $labelFirst)
        <span class="@if($errors->has($key)) text-red-500 @else text-gray-700 @endif">{{ __($label) }}</span>
    @endif

    {{ $slot }}

    @if(!empty($labelFirst) && labelFirst)
        <span class="@if($errors->has($key)) text-red-500 @else text-gray-700 @endif">{{ __($label) }}</span>
    @endif

    @error($key)
        <span class="border-l-8 border-red-500" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</label>
