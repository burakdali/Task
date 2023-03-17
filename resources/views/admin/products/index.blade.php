<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex m-2 p-2">
                        <a href="{{ route('admin.addProduct') }}"
                            class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg">Add new product</a>
                    </div>
                    <h4 class="p-6">Products:</h4>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="table table-bordered" id="productsTable">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>description</th>
                                    <th>created at</th>
                                    <th>action</th>
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
<script type="text/javascript">
    $(function() {
        var table = $('#productsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.getProducts') }}",
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            }, {
                data: 'name',
                name: 'name'
            }, {
                data: 'description',
                name: 'description'
            }, {
                data: 'created_at',
                name: 'created_at'
            }, {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            }, ]
        });
    });
</script>
<script>
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

    $(document).on("click", ".edit", function(event) {
        var id = $(this).attr('id');
        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/editProduct/" + id + "/",
            dataType: "json",
            success: function(response) {
                console.log('done' + response);
            }
        });
    });
</script>
