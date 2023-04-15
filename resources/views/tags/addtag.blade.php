<x-layout>
    <!-- Default box -->
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add New Tag</h3>

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
            <form action="{{ route('tagAdd') }}" method="POST">
                @csrf
                <div class="form-group col-md-12">
                    <label class=" form-control-label">Tag Name *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" placeholder="Tag Name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!-- /.card-body -->
                <div class="col mt-2">
                    <button type="submit" class="btn btn-primary float-right ml-1"><i class="fa fa-check"></i>&nbsp;Add
                        tag</button>
                    <a href="{{ route('tags') }}"><button type="button" class="btn btn-primary float-right"><i
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
</x-layout>
