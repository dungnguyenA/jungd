@extends('admin.layouts.app')
@section('content')
    <!-- BEGIN: Content -->
    <div class="content">
        <!-- BEGIN: Top Bar -->
        @include('admin.layouts.top-bar')
        <!-- END: Top Bar -->
        <!-- BEGIN: Striped Rows -->
        <h2 class="intro-y text-lg font-medium mt-10">
            User List
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">

                <div class="hidden xl:block mx-auto text-slate-500"></div>
                <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                    <div class="w-56 relative text-slate-500">
                        <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                    </div>
                </div>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class=" whitespace-nowrap">ID</th>
                            <th class=" whitespace-nowrap">USER NAME</th>
                            <th class=" whitespace-nowrap">ADDRESS</th>
                            <th class=" whitespace-nowrap">EMAIL</th>
                            <th class=" whitespace-nowrap">PHONE</th>
                            <th class=" whitespace-nowrap">POSITION</th>
                            <th class=" whitespace-nowrap"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataUser as $user)
                            <tr class="intro-x">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->address }} </td>
                                <td>{{ $user->email }} </td>
                                <td>{{ $user->phone }} </td>
                                <form action="{{ url('/update-position',$user->id )}}" method="POST">
                                    @csrf
                                    <td>
                                        <select name="role_id" class="form-select" style="border-radius:5px">
                                            <option value="1" {{ $user->role_id == '1' ? 'selected' : '' }}>Admin</option>
                                            <option value="2" {{ $user->role_id == '2' ? 'selected' : '' }}>User</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button  type="submit" class="btn">Save</button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END: Data List -->
            <!-- BEGIN: Pagination -->

            <!-- END: Pagination -->
        </div>
    </div>
    <!-- END: Content -->
@endsection
