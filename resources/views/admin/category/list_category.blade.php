@extends('admin.layouts.app')
@section('content')
    <!-- BEGIN: Content -->
    <div class="content">
        <!-- BEGIN: Top Bar -->
        @include('admin.layouts.top-bar')
        <!-- END: Top Bar -->
        <!-- BEGIN: Striped Rows -->
        <h2 class="intro-y text-lg font-medium mt-10">
            List Category
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                <a href="{{ url('create-category') }}" class="btn btn-primary shadow-md mr-2">Add New Category</a>
                <div class="dropdown">
                    <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                        <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i>
                        </span>
                    </button>
                </div>
                <div class="hidden md:block mx-auto text-slate-500"></div>
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-slate-500">
                        <input type="text" class="form-control w-56 box pr-10"
                        style="border:none; border:1px solid rgb(33, 33, 36); border-radius:5px"
                         placeholder="Search...">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                    </div>
                </div>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">ID</th>
                            <th class="whitespace-nowrap">CATEGORY NAME</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_category as $item)
                            <tr class="intro-x">
                                <td>
                                    {{ $item->id }}
                                </td>
                                <td>
                                    {{ $item->category_name }}
                                </td>
                                <td class="flex">
                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1 mx-3">
                                        <a href="{{ url('/edit-category', $item->id) }}" data-id="{{ $item->id }}">
                                            <i data-lucide="edit" class="block mx-auto"></i>
                                        </a>
                                    </div>
                                    <form class="delete-form" action="{{ url('/delete-category', $item->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                            <button type="submit" class="delete-btn" data-id="{{ $item->id }}">
                                                <i data-lucide="trash-2" class="block mx-auto"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END: Data List -->
        </div>
        <!-- END: Striped Rows -->
    </div>
    <!-- END: Content -->
    <script>
        $(function() {
            // Xử lý sự kiện click nút xóa
            $('.delete-form').on('submit', function(e) {

                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var category_id = form.data('id');

                // Hiển thị hộp thoại xác nhận
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Are you sure to delete this category?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Nếu xác nhận xoá, thực hiện Ajax request
                        jQuery.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                _method: 'DELETE',
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Successfully',
                                        text: response.success,
                                        icon: 'success',
                                    }).then(() => {
                                        // Khi bạn ấn OK, thì xoá phần tử vừa xoá khỏi list
                                        form.closest('tr').remove();
                                    });
                                }
                            },
                            error: function(error) {
                                alert('Error deleting item.');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
