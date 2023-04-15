<x-layout>
    @section('css')
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/image-uploader.min.css') }}" rel="stylesheet" />

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add New Project</h3>

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
                <form action="{{ route('projectAdd') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class=" form-control-label">Project Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" placeholder="Project Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class=" form-control-label">Field *</label>
                            <select class="custom-select  @error('field_id') is-invalid @enderror" name="field_id"
                                value="{{ old('field_id') }}">
                                @foreach ($fields as $field)
                                    <option value="{{ $field->id }}">{{ $field->name }}</option>
                                @endforeach

                            </select>
                            @error('field_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class=" form-control-label">Project Start Date *</label>
                            <input class="form-control  @error('start_date') is-invalid @enderror" type="date"
                                value="{{ old('start_date') }}" name="start_date">
                            @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class=" form-control-label">Project End Date </label>
                            <input class="form-control  @error('end_date') is-invalid @enderror" type="date"
                                value="{{ old('end_date') }}" name="end_date">
                            @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class=" form-control-label">Status *</label>
                            <select class="custom-select  @error('status') is-invalid @enderror" name="status"
                                value="{{ old('status') }}">
                                <option value="On Hold">On Hold</option>
                                <option value="On Going">On Going</option>
                                <option value="Canceled">Canceled</option>
                                <option value="Finished">Finished</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class=" form-control-label">Budget</label>
                            <input class="form-control @error('budget') is-invalid @enderror" type="number"
                                value="{{ old('budget') }}" step="0.01" name="budget" placeholder="budget">
                            @error('budget')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class=" form-control-label">Progress*</label>
                            <input class="form-control @error('progress') is-invalid @enderror" type="number"
                                value="{{ old('progress') }}" step="0.01" name="progress" placeholder="progress">
                            @error('progress')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class=" form-control-label">Client Company Type</label>
                            <select id="test" class="custom-select">
                                <option value="internal">Internal</option>
                                <option value="external">External</option>
                            </select>
                        </div>
                        <div id="hidden_div" style="display: none;" class="form-group col-md-6">
                            <label class=" form-control-label">Client Company Name</label>
                            <input type="text" class="form-control @error('client_company') is-invalid @enderror"
                                name="client_company" value="{{ old('client_company') }}" placeholder="Client company">
                            @error('client_company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @can('user_show')
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="form-control-label">Work team</label>
                                <div style="padding-bottom: 4px">
                                    <span id="select-all" class="btn btn-info btn-xs" style="border-radius: 0">Select
                                        all</span>
                                    <span id="deselect-all" class="btn btn-info btn-xs" style="border-radius: 0">Deselect
                                        all</span>
                                </div>
                                <select id="select" class="js-example-basic-multiple" style="width:100%" name="users[]"
                                    multiple="multiple">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->first_name }}&nbsp{{ $user->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endcan
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class=" form-control-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" rows="4"
                                name="description" placeholder="Project description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class=" form-control-label">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror pb-5 pt-3" type="file"
                                name="image">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class=" form-control-label">Files</label>
                            <div class="input-files"></div>
                        </div>
                    </div>
                    <div class="col mt-2">
                        <button type="submit" class="btn btn-primary float-right ml-1"><i class="fa fa-check"></i>&nbsp;Add
                            project</button>
                        <a href="{{ route('projects') }}"><button type="button" class="btn btn-primary float-right"><i
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
        <script src="{{ asset('js/image-uploader.min.js') }}"></script>
        <script src="{{ asset('js/file-uploader.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
            });

        </script>
        <script>
            $('.input-files').fileUploader();

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
