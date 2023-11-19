@extends('admin.layouts.app')
@section('content')
    <!-- BEGIN: Content -->
    <div class="content">
        <!-- BEGIN: Top Bar -->
        @include('admin.layouts.top-bar')
        <!-- END: Top Bar -->
        <!-- BEGIN: Striped Rows -->
        <h2 class="intro-y text-lg font-medium mt-10">
            Order Detail
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <!-- BEGIN: Users Layout -->
            @foreach ($orderDetail as $order)
                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                    <div class="box">
                        <div class="p-5">
                                <div class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t">
                                    <img alt="Midone - HTML Admin Template" class="rounded-md" src="{{ $order->image_name ?''.Storage::url($order->image_name):'' }}">
                                </div>
                            <div class="text-slate-600 dark:text-slate-500 mt-5">
                                <div class="flex items-center"> <i data-lucide="link" class="w-4 h-4 mr-2"></i> Price: {{ number_format($order->price)  }} vnđ</div>
                                <div class="flex items-center mt-2"> <i data-lucide="layers" class="w-4 h-4 mr-2"></i> Quantity: {{$order->quantity }} </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- END: Users Layout -->
            <!-- BEGIN: Pagination -->

            <!-- END: Pagination -->
        </div>
        <!-- END: Striped Rows -->
    </div>
    <!-- END: Content -->
    {{-- <script>
          $(function() {
            $('#saveBtn').on('click', function() {

                var formData = new FormData($('#ajaxForm')[0]);

                jQuery.ajax({
                    url: '/update-status/{{ $item->id }}',
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
                            position: 'top-end',
                            icon: 'success',
                            title: response.success,
                            showConfirmButton: false,
                            timer: 1500
                            })
                        }
                    },
                    error: function(error) {

                    }
                });
            });
        });
    </script> --}}
@endsection
