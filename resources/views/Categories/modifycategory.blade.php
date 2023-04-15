<x-layout>
    <!-- Default box -->
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Modidy Category</h3>

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
            @if (session()->has('Update'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('Update') }}
                </div>
            @endif
            <form action="{{ route('categoryUpdate', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group col-md-12">
                    <label class=" form-control-label">Category Name *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ $category->name }}" placeholder="Category Name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-12">
                    <label class="form-control-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" rows="3"
                        name="description" placeholder="Description">{{ $category->description }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!-- /.card-body -->
                <div class="col mt-2">
                    <button type="submit" class="btn btn-primary float-right ml-1"><i
                            class="fa fa-check"></i>&nbsp;Modify
                        category</button>
                    <a href="{{ route('categories') }}"><button type="button" class="btn btn-primary float-right"><i
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
