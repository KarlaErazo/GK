<x-app-layout>
    <div class="py-12">

        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:post/>
            </div>
        </div>
    </div>
</x-app-layout>
