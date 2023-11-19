@if (Session::has('success'))
    {{-- <div class="alert alert-success">
        <strong>{{ Session::get('success') }}</strong>
    </div> --}}
    <script>
        Swal.fire(
            '{{ Session::get('success') }}',
            'You clicked the button!',
            'success'
        )
    </script>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger" role="alert">
        <strong>{{ Session::get('error') }}</strong>
    </div>
@endif

@if ($errors->any())

    <div class="alert alert-danger">
        <ul>

            @foreach ($errors->all() as $error)
                <ul>
                    <li> - {{ $error }}</li>
                </ul>
            @endforeach

        </ul>

    </div>

@endif
