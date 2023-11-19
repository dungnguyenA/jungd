@extends('admin.layouts.app')
@section('content')
    <!-- BEGIN: Content -->
    <div class="content">
        <!-- BEGIN: Top Bar -->
        @include('admin.layouts.top-bar')
        <!-- END: Top Bar -->
        <!-- BEGIN: Striped Rows -->
        <h2 class="intro-y text-lg font-medium mt-10">
            List Order
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                <div class="hidden md:block mx-auto text-slate-500"></div>
                <form action="{{ url('/search') }}" method="GET">
                    @csrf
                    <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                        <div class="w-56 relative text-slate-500">
                            <input type="text" class="form-control w-56 box pr-10" name="search" placeholder="Search...">
                            <button type="submit"class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0"><i
                                    data-lucide="search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- BEGIN: Data List -->
            <div id="categories-list-container" class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="">USER NAME</th>
                            <th class="">PAY</th>
                            <th class="">STATUS</th>
                            <th class="">TIME ORDER</th>
                            <th class="">TOTAL</th>
                            <th class="">ORDER DETAILS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_order as $item)
                            <tr class="intro-x">
                                <td>
                                    {{ $item->user_name }}
                                </td>
                                <td>
                                    {{ $item->payment_status }}
                                </td>
                                <form id="ajaxForm" action="{{ url('/update-status', ['id' => $item->id]) }}" method="POST">
                                    <td>
                                        @csrf
                                        @if($item->status === 'cancelled')
                                            <select name="status" class="form-select" style="border-radius:5px">
                                                <option value="Delivered successfully" {{ $item->status === 'cancelled' ?  : '' }}>Cancelled</option>
                                            </select>
                                        @else
                                            <select name="status" class="form-select" style="border-radius:5px">
                                                <option value="Processing" {{ $item->status === 'Processing' ? 'selected' : '' }}>Processing</option>
                                                <option value="In transit" {{ $item->status === 'In transit' ? 'selected' : '' }}>In transit</option>
                                                <option value="Delivered successfully" {{ $item->status === 'Delivered successfully' ? 'selected' : '' }}>Delivered successfully</option>
                                            </select>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->created_at}}
                                    </td>
                                    <td>
                                        <span>{{ number_format($item->total)}}vnđ</span>
                                    </td>
                                    <td class="flex">
                                        <a href="{{ url('order-detail',$item->id) }}" class="btn btn-primary mr-3" href="">View</a>
                                        <button id="saveBtn" type="submit" class="btn">Save</button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="display: flex;justify-content: center;width: 100%;">
                    {{ $list_order->links() }}
                </div>
            </div>
            <!-- END: Data List -->
        </div>
        <!-- END: Striped Rows -->
    </div>
    <!-- END: Content -->
    {{-- <script>
        $(document).ready(function() {
            $('#saveBtn').on('click', function() {
                var orderId = "{{ $item->id }}";
                var status = $('select[name="status"]').val();

                jQuery.ajax({
                    url: "/update-status/" + orderId,
                    type: 'POST',
                    data: { _token: "{{ csrf_token() }}", status: status },
                    success: function(response) {
                        // Xử lý khi nhận được phản hồi thành công, nếu cần.
                        // Ví dụ: hiển thị thông báo thành công hoặc cập nhật giao diện.
                        console.log(response);
                    },
                    error: function(xhr) {
                        // Xử lý khi có lỗi, nếu cần.
                        // Ví dụ: hiển thị thông báo lỗi hoặc thông báo cho người dùng.
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script> --}}
@endsection
