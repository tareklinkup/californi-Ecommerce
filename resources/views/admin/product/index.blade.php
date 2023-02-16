@extends('admin.admin_master')

@push('css')
    <link rel="stylesheet" href="{{ asset('/public/assets/admin/') }}/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline">Products</h4>
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm float-right">Add New</a>
            </div>
            <div class="card-body">

                @if (session('message'))
                    {!! session('message') !!}
                @endif

                <table id="bootstrap-data-table" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Thumbnail</th>
                            <th>Status</th>
                            {{-- <th>Is Featured</th> --}}
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $pk => $product)
                        <tr>
                            <td>{{ ++$pk }}</td>
                            <td>{{ $product->product_code }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                @if (file_exists($product->thumbnail))
                                    <img src="{{ asset($product->thumbnail) }}" height="50" alt="">
                                @else
                                    <span class="text-danger">---</span>
                                @endif
                            </td>
                            <td>
                                @if ($product->status)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-warning">Inactive</span>
                                @endif
                            </td>
                            {{-- <td>
                                @if ($product->is_featured)
                                    <span class="badge badge-success">Yes</span>
                                @else
                                    <span class="badge badge-warning">No</span>
                                @endif
                            </td> --}}
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.product.show', $product->id) }}" class="btn btn-dark btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.product.destroy', $product->id) }}" method="post" class="delete_form">
                                        @csrf
                                        @method('DELETE')

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
