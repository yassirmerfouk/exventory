<x-layout>
    @section('css')
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modify User</h3>

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
                <form action="{{ route('userUpdate', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class=" form-control-label">First Name *</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                name="first_name" value="{{ $user->first_name }}" placeholder="First Name">
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class=" form-control-label">Last Name *</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                name="last_name" value="{{ $user->last_name }}" placeholder="Last Name">
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class=" form-control-label">Email *</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ $user->email }}" placeholder="Email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class=" form-control-label">Password *</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" value="{{ old('password') }}" placeholder="password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="form-control-label">Roles *</label>
                            <div style="padding-bottom: 4px">
                                <span id="select-all" class="btn btn-info btn-xs" style="border-radius: 0">Select
                                    all</span>
                                <span id="deselect-all" class="btn btn-info btn-xs" style="border-radius: 0">Deselect
                                    all</span>
                            </div>
                            <select id="select" class="js-example-basic-multiple @error('roles') is-invalid @enderror"
                                style="width:100%" name="roles[]" multiple="multiple">
                                @foreach ($user->roles as $role)
                                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                @endforeach
                                @foreach ($roles as $role)
                                    @if (!in_array($role, $user->roles->toArray()))
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('roles')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col mt-2">
                        <button type="submit" class="btn btn-primary float-right ml-1"><i
                                class="fa fa-check"></i>&nbsp;Modify
                            user</button>
                        <a href="{{ route('users') }}"><button type="button" class="btn btn-primary float-right"><i
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
        <script>
            document.getElementById('test').addEventListener('change', function() {
                var style = this.value == "external" ? 'block' : 'none';
                document.getElementById('hidden_div').style.display = style;
            });

        </script>
    @endsection
</x-layout>
