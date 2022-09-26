@if (session()->has('success'))

<div x-data="{show:true}" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="absolute z-40 left-80 top-12 -translate-y-6
 bg-success rounded text-black px-48 py-3 shadow-2xl shadow-success">

    <p>{{session('success')}}</p>

</div>

@endif