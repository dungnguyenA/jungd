@extends('admin.layouts.app')
@section('content')
    <!-- BEGIN: Content -->
    <div class="content">
        <!-- BEGIN: Top Bar -->
        @include('admin.layouts.top-bar')
        <!-- END: Top Bar -->
        <!-- BEGIN: Striped Rows -->
        <h2 class="intro-y text-lg font-medium mt-10">
            Reviews
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
                <div class="flex w-full sm:w-auto">
                    <div class="w-48 relative text-slate-500">
                        <input type="text" class="form-control w-48 box pr-10" placeholder="Search by name...">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                    </div>
                </div>
                <div class="hidden xl:block mx-auto text-slate-500"></div>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">PRODUCT</th>
                            <th class="whitespace-nowrap">NAME</th>
                            <th class="whitespace-nowrap">Content</th>
                            <th class="text-center whitespace-nowrap">POSTED TIME</th>
                            <th class="text-center whitespace-nowrap">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_comment as $comment)
                            <tr class="intro-x">
                                <td class="!py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img class="rounded-lg border-1 border-white shadow-md tooltip" src="{{ $comment->image_name ? '' .Storage::url($comment->image_name) : '' }}">
                                        </div>
                                        <a href="#" class="font-medium whitespace-nowrap ml-4">{{ $comment->product_name }}</a>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap"> <a class="flex items-center underline decoration-dotted" href="javascript:;">{{ $comment->name }}</a> </td>
                                <td class="text-center">
                                    <div class="flex items-center">
                                        {{ $comment->content }}
                                    </div>
                                </td>
                                <td class="text-center whitespace-nowrap">{{ $comment->created_at }}</td>
                                <td class="text-center whitespace-nowrap">
                                    <button type="submit" class="delete-btn" data-id="{{ $comment->id }}">
                                        <i data-lucide="trash-2" class="block mx-auto"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END: Data List -->
            <!-- BEGIN: Pagination -->
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                    {{ $list_comment->links() }}
            </div>
            <!-- END: Pagination -->
        </div>
        <!-- BEGIN: Delete Confirmation Modal -->
        <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="p-5 text-center">
                            <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                            <div class="text-3xl mt-5">Are you sure?</div>
                            <div class="text-slate-500 mt-2">
                                Do you really want to delete these records?
                                <br>
                                This process cannot be undone.
                            </div>
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                            <button type="button" class="btn btn-danger w-24">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Striped Rows -->
    </div>
    <!-- END: Content -->
@endsection
