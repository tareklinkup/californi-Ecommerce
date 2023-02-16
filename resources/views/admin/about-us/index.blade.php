@extends('admin.admin_master')

@push('css')
    <link rel="stylesheet" href="{{ asset('/public/assets/admin/') }}/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline">About Us</h4>
                <a href="{{ route('admin.about.us.create') }}" class="btn btn-primary btn-sm float-right">Add New</a>
            </div>
            <div class="card-body">

                @if (session('message'))
                    {!! session('message') !!}
                @endif

                <table id="bootstrap-data-table" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Heading</th>
                            <th>Description</th>
                            <th>Banner</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($about_us as $auk => $about)
                        <tr>
                            <td>{{ ++$auk }}</td>
                            <td>{{ $about->heading }}</td>
                            <td class="text-left">{!! Str::limit($about->description, 150, '...') !!}</td>
                            <td>
                                @if (file_exists($about->banner))
                                    <img src="{{ asset($about->banner) }}" height="50" alt="">
                                @else
                                    <span class="text-danger">---</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.about.us.edit', $about->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.about.us.delete') }}" method="post" class="delete_form">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $about->id }}">
                                        <button type="submit" class="delete_button btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('/public/assets/admin/') }}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/public/assets/admin/') }}/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('/public/assets/admin/assets/') }}/js/sweetalert2@9.js"></script>

    <script>
        (function ($) {
            $('#bootstrap-data-table').DataTable();

            $(document).on('click', '.delete_button', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $(this).closest('form').submit();
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
