<x-admin-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex m-2 p-2">
                        <a href="{{ route('admin.addUser') }}"
                            class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg">Add new users</a>
                    </div>
                    <h4 class="p-6">Users:</h4>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="table table-bordered users-table">
                            <thead>
                                <tr>
                                    <th>first name</th>
                                    <th>last name</th>
                                    <th>email</th>
                                    <th>phone number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.fn.dataTable.ext.errMode = 'throw';
        var table = $('.users-table').DataTable({

            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.getUsers') }}",
            columns: [{
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone_number',
                    name: 'phone_number'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
    $(document).on("click", ".delete", function() {
        var id = $(this).attr('id');
        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/deleteProduct/" + id + "/",
            dataType: "json",
            success: function(response) {
                swal("Good job!", response.result, "success");
            }
        })
    });
</script>
