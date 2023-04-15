<x-layout>
    @section('css')
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    @endsection
    <!-- Default box -->
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add New Role</h3>

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
            <form action="{{ route('roleAdd') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class=" form-control-label">Role Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" placeholder="Tag Name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="form-control-label">Permissions *</label>
                        <div style="padding-bottom: 4px">
                            <span id="select-all" class="btn btn-info btn-xs" style="border-radius: 0">Select
                                all</span>
                            <span id="deselect-all" class="btn btn-info btn-xs" style="border-radius: 0">Deselect
                                all</span>
                        </div>
                        <select id="select" class="js-example-basic-multiple @error('permissions') is-invalid @enderror"
                            style="width:100%" name="permissions[]" multiple="multiple">
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        @error('permissions')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="col mt-2">
                    <button type="submit" class="btn btn-primary float-right ml-1"><i class="fa fa-check"></i>&nbsp;Add
                        role</button>
                    <a href="{{ route('roles') }}"><button type="button" class="btn btn-primary float-right"><i
                                class="fa fa-undo"></i>&nbsp;Cancel</button></a>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            ExVentory
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
    @section('script')
        <script src="{{ asset('js/select2.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
            });

        </script>
        <script>
            $("#select-all").click(function() {
                $('#select').select2('destroy').find('option').prop('selected', 'selected').end().select2();
            });
            $("#deselect-all").click(function() {
                $('#select').select2('destroy').find('option').prop('selected', false).end().select2();
            });

        </script>
    @endsection
</x-layout>
