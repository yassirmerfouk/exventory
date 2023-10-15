<x-layout>
    @section('css')
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/image-uploader.min.css') }}" rel="stylesheet" />
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add New Product</h3>

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
            <form action="{{ route('productAdd') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class=" form-control-label">Product Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" placeholder="Product Name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label class=" form-control-label">Category *</label>
                        <select class="custom-select  @error('category_id') is-invalid @enderror" name="category_id"
                            value="{{ old('category_id') }}">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach

                        </select>
                        @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class=" form-control-label">Quantity*</label>
                        <input class="form-control @error('quantity') is-invalid @enderror" type="number"
                            value="{{ old('quantity') }}" name="quantity" placeholder="quantity">
                        @error('quantity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label class=" form-control-label">Price *</label>
                        <input class="form-control @error('price') is-invalid @enderror" type="number"
                            value="{{ old('price') }}" step="0.01" name="price" placeholder="price" min="0">
                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class=" form-control-label">Shopping Date *</label>
                        <input class="form-control  @error('date') is-invalid @enderror" type="date"
                            value="{{ old('date') }}" name="date">
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-control-label">Stock *</label>
                        <select class="custom-select  @error('stock_id') is-invalid @enderror" name="stock_id"
                            value="{{ old('stock_id') }}">
                            @foreach ($stocks as $stock)
                                <option value="{{ $stock->id }}">{{ $stock->name }}</option>
                            @endforeach
                        </select>
                        @error('stock_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class=" form-control-label">Shop Address</label>
                        <input class="form-control @error('shop_address') is-invalid @enderror" type="text"
                            value="{{ old('shop_address') }}" name="shop_address" placeholder="Shop Address">
                        @error('shop_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label class=" form-control-label">Link</label>
                        <input class="form-control @error('link') is-invalid @enderror" type="text"
                            value="{{ old('link') }}" name="link" placeholder="Link">
                        @error('link')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class=" form-control-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" rows="4"
                            name="description" placeholder="Product description">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="form-control-label">Tags</label>
                        <div style="padding-bottom: 4px">
                            <span id="select-all" class="btn btn-info btn-xs" style="border-radius: 0">Select
                                all</span>
                            <span id="deselect-all" class="btn btn-info btn-xs" style="border-radius: 0">Deselect
                                all</span>
                        </div>
                        <select id="select" class="js-example-basic-multiple" style="width:100%" name="tags[]"
                            multiple="multiple">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class=" form-control-label">Images *</label>
                        <div class="input-images @error('images') is-invalid @enderror"></div>
                        @error('images')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class=" form-control-label">Files</label>
                        <div class="input-files @error('files') is-invalid @enderror"></div>
                        @error('files')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col mt-2">
                    <button type="submit" class="btn btn-primary float-right ml-1"><i class="fa fa-check"></i>&nbsp;Add
                        product</button>
                    <a href="{{ route('products') }}"><button type="button" class="btn btn-primary float-right"><i
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
            $("#select-all").click(function() {
                $('#select').select2('destroy').find('option').prop('selected', 'selected').end().select2();
            });
            $("#deselect-all").click(function() {
                $('#select').select2('destroy').find('option').prop('selected', false).end().select2();
            });

        </script>
        <script>
            $('.input-images').imageUploader();
            $('.input-files').fileUploader();

        </script>
    @endsection
</x-layout>
