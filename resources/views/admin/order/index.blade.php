@extends('admin.admin_master')

@push('css')
    <link rel="stylesheet" href="{{ asset('/public/assets/admin/') }}/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline">Orders</h4>
            </div>
            <div class="card-body">

                @if (session('message'))
                    {!! session('message') !!}
                @endif

                <table id="bootstrap-data-table" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Number</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $ok => $order)
                        <tr>
                            <td>{{ ++$ok }}</td>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ optional($order->user)->name }}</td>
                            <td>{{ optional($order->user)->phone ?? $order->shipping_phone }}</td>
                            <td>{{ date('D d F, Y', strtotime($order->created_at)) }}</td>
                            <td>
                                @if ($order->status == 0)
                                    <span class="badge badge-warning">Pending</span>
                                @elseif ($order->status == 1)
                                    <span class="badge badge-info">Processing</span>
                                @elseif ($order->status == 2)
                                    <span class="badge badge-success">Delivered</span>
                                @elseif ($order->status == 3)
                                    <span class="badge badge-danger">Canceled</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.order.invoice', $order->id) }}" class="btn btn-dark btn-sm">
                                        <i class="fa fa-file"></i>
                                    </a>
                                    <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
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
                    title: 'Are you sure to cancel this order?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    if (result.value) {
                        $(this).closest('form').submit();
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
