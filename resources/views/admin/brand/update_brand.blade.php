@extends('admin.layouts.app')
@section('content')
    <!-- BEGIN: Content -->
    <div class="content">
        <!-- BEGIN: Top Bar -->
        @include('admin.layouts.top-bar')
        <!-- END: Top Bar -->
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Update Brand
            </h2>
        </div>
        <div class=" mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Form Layout -->
                <form id="ajaxForm" method="POST">
                    <div class="intro-y box p-5">
                        <div>
                            <label for="crud-form-1" class="form-label">Brand Name</label>
                            <input type="text" name="name" id="name" class="form-control w-full"
                                value="{{ $edit_brand->brand_name }}" placeholder="BrandName">
                            <span id="nameError" class="text-light" error-messages></span>
                        </div>
                        <div class="text-right mt-5">
                            <button type="button" class="btn btn-primary w-24" id="saveBtn">Save</button>
                            <a href="{{ url('list-brand') }}" class="btn btn-success">List Brand</a>
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
                    url: '/edit-brand/{{ $edit_brand->id }}',
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
                                // $('#name').val('');
                            });
                        }
                    },
                    error: function(error) {
                        if (error.responseJSON.errors.name) {
                            $('#nameError').html(error.responseJSON.errors.name);
                        } else {
                            $('#nameError').html('');
                        }
                    }
                });
            });
        });
    </script>
@endsection
