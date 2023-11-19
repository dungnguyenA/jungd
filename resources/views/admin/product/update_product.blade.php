@extends('admin.layouts.app')
@section('content')
    <!-- BEGIN: Content -->
    <div class="content">
        <!-- BEGIN: Top Bar -->
        @include('admin.layouts.top-bar')
        <!-- END: Top Bar -->
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Update Product
            </h2>
        </div> <br>
        <div id="errorDiv" class="alert alert-danger" style="display: none;"></div>
        <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
            <div class="intro-y col-span-11 2xl:col-span-9">
                <!-- BEGIN: Uplaod Product -->
                <div class="intro-y box p-5">
                    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                        <form id="ajaxForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div
                                class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                <i data-lucide="chevron-down" class="w-4 h-4 mr-2"></i> Update Product
                            </div>
                            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="form-label xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">Product Name</div>
                                            <div
                                                class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                Required
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-3 xl:mt-0 flex-1">
                                    <input type="text" id="name" name="name" class="clearable form-control"
                                        style="border:none; border:1px solid rgb(33, 33, 36); border-radius:5px"
                                        placeholder="Product name" value="{{ $product->product_name }}">
                                    <div class="error-message text-danger" id="nameError"></div>
                                    <div class="form-help text-right">Maximum character 0/70</div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="form-inline items-start flex-col xl:flex-row mt-10">
                                    <div class="form-label w-full xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">Product Photos</div>
                                                <div
                                                    class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                    Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="w-full mt-3 xl:mt-0 flex-1 border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                        <div class="grid grid-cols-10 gap-5 pl-4 pr-5" id="imageContainer">
                                            @foreach ($images as $image)
                                                <div
                                                    class="col-span-5 md:col-span-2 h-28 relative image-fit cursor-pointer zoom-in">
                                                    <img class="rounded-md" alt="Midone - HTML Admin Template"
                                                        src="{{ $image->image_name ? '' . Storage::url($image->image_name) : '' }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div
                                            class="px-4 pb-4 mt-5 flex items-center justify-center cursor-pointer relative">
                                            <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span
                                                class="text-primary mr-1">Upload a file</span> or drag and drop
                                            <input id="imageInput" type="file" name="image[]" multiple
                                                class="w-full h-full top-0 left-0 absolute opacity-0">
                                        </div>
                                        <div class="error-message" id="imageError"></div>
                                    </div>
                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">Category</div>
                                                <div
                                                    class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                    Required
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <select id="category" name="category_id" class="form-select"
                                            style="border:none; border:1px solid rgb(33, 33, 36); border-radius:5px">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="error-message" id="categoryError"></div>
                                    </div>
                                </div>
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">Brand</div>
                                                <div
                                                    class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                    Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <select id="brand" name="brand_id" class="form-select"
                                            style="border:none; border:1px solid rgb(33, 33, 36); border-radius:5px">
                                            <option value="">Tất cả</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->brand_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="error-message" id="brandError"></div>
                                    </div>
                                </div>
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">Price</div>
                                                <div
                                                    class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                    Required
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <input id="price" min="1" type="number" name="price"
                                            class="clearable form-control"
                                            style="border:none; border:1px solid rgb(33, 33, 36); border-radius:5px"
                                            placeholder="Price" value="{{ $product->price }}">
                                        <div class="error-message" id="priceError"></div>
                                    </div>
                                </div>
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">Discount Price</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <input id="discount_price" min="1" type="number" name="discount_price"
                                            class="clearable form-control"
                                            style="border:none; border:1px solid rgb(33, 33, 36); border-radius:5px"
                                            placeholder="Discount Price" value="{{ $product->discount_price }}">
                                    </div>
                                </div>
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">Quantity</div>
                                                <div
                                                    class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                    Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <input id="quantity" min="1" type="number" name="quantity"
                                            class="clearable form-control"
                                            style="border:none; border:1px solid rgb(33, 33, 36); border-radius:5px"
                                            placeholder="Quantity" value="{{$product->quantity}}">
                                        <div class="error-message" id="quantityError"></div>
                                    </div>
                                </div>
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">Product Description</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <textarea class="clearable form-control" name="description" cols="30" rows="10">{{$product->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- END: Uplaod Product -->
                <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                    <button type="button" id="saveBtn"
                        class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52 ">
                        Save & Update Product</button>
                    <a href="{{ url('list-product') }}" class="btn py-3 btn-primary w-full md:w-52">List Product</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END: Content -->
    <script>
        $(function() {
            $('#saveBtn').on('click', function() {

                var formData = new FormData($('#ajaxForm')[0]);

                var images = $('#imageInput')[0].files;

                // Check each selected image for validation (e.g., image type and size)
                for (var i = 0; i < images.length; i++) {
                    if (!isValidImage(images[i])) {
                        Swal.fire({
                            title: 'Warning!',
                            text: 'Định dạng hoặc kích thước hình ảnh không hợp lệ. Các định dạng được phép: jpeg, png, jpg. Kích thước tối đa: 2MB.',
                            imageUrl: 'https://unsplash.it/400/200',
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: 'Custom image',
                        })
                        return;
                    }
                }

                jQuery.ajax({
                    url: '/edit-product/{{ $product->id }}',
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
                                $('#errorDiv').hide();

                                // Thêm hình ảnh mới vào container hình ảnh
                                var imageContainer = jQuery('#imageContainer');

                                imageContainer.empty(); // Xoá dữ liệu cũ

                                var newImages = response.newImages;
                                newImages.forEach(function(image) {
                                    var imageUrl = '{{ Storage::url('') }}' +
                                        image.image_name;
                                    var newImageElement =
                                        '<div class="col-span-5 md:col-span-2 h-28 relative image-fit cursor-pointer zoom-in">' +
                                        '<img class="rounded-md" alt="Midone - HTML Admin Template" src="' +
                                        imageUrl + '">' +
                                        '</div>';
                                    imageContainer.append(newImageElement);
                                });
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
                            if (error.responseJSON.errors.image) {
                                errorMessages.push(error.responseJSON.errors.image);
                            }
                            if (error.responseJSON.errors.price) {
                                errorMessages.push(error.responseJSON.errors.price);
                            }
                            if (error.responseJSON.errors.brand_id) {
                                errorMessages.push(error.responseJSON.errors.brand_id);
                            }
                            if (error.responseJSON.errors.category_id) {
                                errorMessages.push(error.responseJSON.errors.category_id);
                            }
                            if (error.responseJSON.errors.quantity) {
                                errorMessages.push(error.responseJSON.errors.quantity);
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

            // Function to validate individual images
            function isValidImage(image) {
                const allowedFormats = ["image/jpeg", "image/png", "image/jpg"];
                const maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

                // Check image format
                if (!allowedFormats.includes(image.type)) {
                    return false;
                }

                // Check image size
                if (image.size > maxFileSize) {
                    return false;
                }

                return true;
            }
        });
    </script>
@endsection
