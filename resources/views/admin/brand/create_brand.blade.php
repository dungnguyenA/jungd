@extends('admin.layouts.app')
@section('content')
    <!-- BEGIN: Content -->
    <div class="content">
        <!-- BEGIN: Top Bar -->
        @include('admin.layouts.top-bar')
        <!-- END: Top Bar -->
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Create Brand
            </h2>
        </div>
        <!-- Thêm div để hiển thị thông báo lỗi chung -->
        <div id="errorDiv" class="alert alert-danger" style="display: none;"></div>
        <div class=" mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <form id="ajaxForm">
                    <div class="intro-y box p-5">
                        <div>
                            <label for="crud-form-1" class="form-label">Brand Name</label>
                            <input type="text" name="name" id="name" class="clearable form-control w-full"
                                placeholder="Brand Name">
                            <div class="error-message text-danger" id="nameError"></div>
                        </div>
                        <div class="text-right mt-5">
                            <a href="{{ url('list-brand') }}" class="btn btn-success">List Brand</a>
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

                var formData = new FormData($('#ajaxForm')[0]);

                jQuery.ajax({
                    url: '/create-brand',
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
                                // Xoá thông tin trong form sau khi thêm mới
                                $('.clearable').val('');
                                $('#errorDiv').hide();
                            });
                        }
                    },
                    error: function(error) {
                        if (error.responseJSON && error.responseJSON.errors) {
                            // Nếu có lỗi từ server trả về
                            var errorMessages = [];

                            if (error.responseJSON.errors.name) {
                                errorMessages.push(error.responseJSON.errors.name);
                            }

                            if (errorMessages.length > 0) {
                                var errorDiv = $('#errorDiv');
                                errorDiv.html("<p>Có lỗi xảy ra:</p><ul>");
                                var errorList = errorDiv.find("ul");
                                for (var i = 0; i < errorMessages.length; i++) {
                                    errorList.append("<li>" + " - " + errorMessages[i] +
                                        "</li>");
                                }
                                errorDiv.show(); // Hiển thị div thông báo lỗi
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection
