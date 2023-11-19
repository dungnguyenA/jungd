@extends('admin.layouts.app')
@section('content')
    <!-- BEGIN: Content -->
    <div class="content">
        <!-- BEGIN: Top Bar -->
        @include('admin.layouts.top-bar')
        <!-- END: Top Bar -->
        <h2 class="intro-y text-lg font-medium mt-10">
            Product List
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                <a href="{{ url('create-product') }}" class="btn btn-primary shadow-md mr-2">Add New Product</a>
                <div class="dropdown">
                    <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                        <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                    </button>
                </div>
                <div class="hidden md:block mx-auto text-slate-500"></div>
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-slate-500">
                        <input type="text" class="form-control w-56 box pr-10"
                        style="border:none; border:1px solid rgb(33, 33, 36); border-radius:5px" placeholder="Search...">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                    </div>
                </div>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">IMAGES</th>
                            <th class="whitespace-nowrap">PRODUCT NAME</th>
                            <th class="text-center whitespace-nowrap">PRICE</th>
                            <th class="text-center whitespace-nowrap">QUANTITY</th>
                            <th class="text-center whitespace-nowrap">DESCRIPTION</th>
                            <th class="text-center whitespace-nowrap">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_products as $item)

                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    @foreach($item->image as $images)
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="{{ $images->image_name?''.Storage::url($images->image_name):'' }}" title="Uploaded at 16 February 2021">
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <a href="#" class="font-medium whitespace-nowrap">{{ $item->product_name }}</a>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">PC &amp; Laptop</div>
                            </td>
                            <td class="text-center">{{ number_format($item->price) }}VNĐ</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="w-40">
                                <div class="flex items-center justify-center text-danger">
                                    {{ $item->description }}
                                </div>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1 mx-3">
                                        <a href="{{ url('/edit-product',$item->id) }}">
                                            <i data-lucide="edit" class="block mx-auto"></i>
                                        </a>
                                    </div>
                                    <form class="delete-form" action="{{ url('/delete-product', $item->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1">
                                            <button type="submit" class="delete-btn" data-id="{{ $item->id }}">
                                                <i data-lucide="trash-2" class="block mx-auto"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div style="display: flex;justify-content: center;width: 100%;">
                    {{ $list_products->links() }}
                </div>
            </div>

            <!-- END: Data List -->
        </div>
    </div>
    <!-- END: Content -->
    <script>
        $(function() {
            // Xử lý sự kiện click nút xóa
            $('.delete-form').on('submit', function(e) {

                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var product_id = form.data('id');

                // Hiển thị hộp thoại xác nhận
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Are you sure to delete this product?",
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
