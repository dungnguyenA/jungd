@extends('admin.layouts.app')
@section('content')
    <!-- BEGIN: Content -->
    <div class="content">
        <!-- BEGIN: Top Bar -->
        @include('admin.layouts.top-bar')
        <!-- END: Top Bar -->
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Create Category
            </h2>
        </div>
        <div class=" mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <form id="ajaxForm">
                    <div class="intro-y box p-5">
                        <div>
                            <label for="crud-form-1" class="form-label">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control w-full"
                            style="border:none; border:1px solid rgb(33, 33, 36); border-radius:5px"
                                placeholder="CategoryName">
                            <span id="nameError" class="text-light" error-messages></span>
                        </div>
                        <div class="text-right mt-5">
                            <button type="button" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                            <a href="{{ url('list-category') }}" class="btn btn-success">List Category</a>
                            <button type="button" class="btn btn-primary w-24" id="saveBtn">Save</button>
                        </div>
                    </div>

                </form>
                <!-- END: Form Layout -->
            </div>
        </div>
    </div>
    <!-- END: Content -->
    <script>
        $(function() {
            $('#saveBtn').on('click', function() {

                $('.error-messages').html('');

                var formData = new FormData($('#ajaxForm')[0]);
                
                jQuery.ajax({
                    url: '/create-category',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
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
                                // Khi bạn ấn OK, thì mới reload lại trang
                                $('#name').val('');
                            });
                        } else {
                            // Hiển thị thông báo lỗi (nếu có) hoặc thực hiện các hành động khác
                        }
                    },
                    error: function(error) {
                        if (error.responseJSON && error.responseJSON.errors) {
                            // Nếu có lỗi từ server trả về
                            if (error.responseJSON.errors.name) {
                                $('#nameError').html(error.responseJSON.errors.name);
                            } else {
                                $('#nameError').html('');
                            }
                        }
                    }
                });
            });
            $('#name').on('input', function() {
                // Ẩn thông báo lỗi khi trường có dữ liệu
                $('#nameError').hide();
            });
        });
    </script>
@endsection
