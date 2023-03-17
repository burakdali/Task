<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="border border-gray-300" method="POST" action="{{ route('admin.saveProduct') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <h1 class="px-4 py-4">add new product:</h1>
                        <div class="grid gap-8 mb-6 md:grid-cols-2">
                            <div class="px-2 py-2">
                                <label
                                    for="name"class="block mb-2 text-sm font-medium text-black-500 dark:text-black">
                                    Name:</label>
                                <input type="text" id="name" name="name"
                                    class="bg-white-50 w-full border border-gray-300 text-black-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-200 dark:placeholder-black-500 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Name" required>
                            </div>
                        </div>
                        <div class="grid gap-8 mb-6 md:grid-cols-2">
                            <div class="px-2 py-2">
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-black-500 dark:text-black">Description</label>
                                <textarea id="message" rows="4" name="description"
                                    class="bg-white-50 w-full border border-gray-300 text-black-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-200 dark:placeholder-black-500 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Write your thoughts here..."></textarea>

                            </div>
                        </div>
                        <div class="grid gap-8 mb-6 md:grid-cols-2">
                            <div class="px-2 py-2">

                                <label class="block mb-2 text-sm font-medium text-black-500 dark:text-black"
                                    for="file_input">Upload Product Image</label>
                                <input name="image"
                                    class="bg-white-50 w-full border border-gray-300 text-black-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-200 dark:placeholder-black-500 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    id="file_input" type="file">

                            </div>
                        </div>
                        <div class="flex m-2 p-2">
                            <button type="submit">Save Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
