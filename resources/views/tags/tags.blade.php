<x-layout>
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @endsection
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tags list</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row" style="margin-bottom: 10px;">
                <div class="col">
                    @can('tag_add')
                        <a href="{{ route('tagAddPage') }}"><button type="button"
                                class="btn btn-outline-primary float-right" data-toggle="modal"
                                data-target="#modal-default">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                </svg>
                                Add New Tag
                            </button></a>
                    @endcan
                </div>
            </div>
            <div class="table-responsive-mobile">
                <table id="myTable" class="table table-striped border">
                    <thead>
                        <tr>
                            <th class="text-center">#ID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $tag->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('tagUpdatePage', $tag->id) }}"><button
                                            class="btn btn-warning btn-sm mb-1" type="button" data-toggle="tooltip"
                                            data-placement="top" title="" data-original-title="Edit"><i
                                                class="fa fa-edit"></i></button></a>
                                    <form action="{{ route('tagDelete', $tag->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure ?')" type="submit"
                                            class="btn btn-danger btn-sm mb-1" type="button" data-toggle="tooltip"
                                            data-placement="top" title="" data-original-title="Delete"><i
                                                class="fa fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            ExVentory
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
    @section('script')

        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });

        </script>
        <script src="{{ asset('js/sweetalert.min.js') }}"></script>

        @if (session()->has('Add'))
            <script>
                swal("Tag Add", "{!! session()->get('Add') !!}", "success", {})

            </script>
        @endif
        @if (session()->has('Update'))
            <script>
                swal("Tag Update", "{!! session()->get('Update') !!}", "success", {})

            </script>
        @endif
        @if (session()->has('Delete'))
            <script>
                swal("Tag Delete", "{!! session()->get('Delete') !!}", "success", {})

            </script>
        @endif
    @endsection
</x-layout>
