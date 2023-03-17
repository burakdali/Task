<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My products') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mt-5">
                        <div class="row mt-5" id="rowDiv">
                            @foreach ($products as $i)
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="{{ Storage::url($i['image']) }}"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $i['name']; ?></h5>
                                        <p class="card-text"><?php echo $i['description']; ?></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
