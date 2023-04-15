<x-layout>
    @section('css')
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/image-uploader.min.css') }}" rel="stylesheet" />
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Modify Product</h3>

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
            <form action="{{ route('productUpdate', $product->id) }}" method="POST" name="productForm"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class=" form-control-label">Product Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $product->name }}" placeholder="Product Name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label class=" form-control-label">Category *</label>
                        <select class="custom-select  @error('category_id') is-invalid @enderror" name="category_id">
                            <option value="{{ $product->category_id }}">{{ $product->getCategory->name }}</option>
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
                            value="{{ $product->stocks[0]->pivot->quantity }}" name="quantity"
                            placeholder="quantity">
                        @error('quantity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label class=" form-control-label">Price *</label>
                        <input class="form-control @error('price') is-invalid @enderror" type="number"
                            value="{{ $product->price }}" step="0.01" name="price" placeholder="price">
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
                            value="{{ $product->date }}" name="date">
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
                            value="{{ $product->shop_address }}" name="shop_address" placeholder="Shop Address">
                        @error('shop_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label class=" form-control-label">Link</label>
                        <input class="form-control @error('link') is-invalid @enderror" type="text"
                            value="{{ $product->link }}" name="link" placeholder="Link">
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
                            name="description" placeholder="Description">{{ $product->description }}</textarea>
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
                            @foreach ($product->tags as $tag)
                                <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                            @endforeach
                            @foreach ($tags as $tag)
                                @if (!in_array($tag, $product->tags->toArray()))
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="form-control-label">Images</label>
                        <div class="input-images @error('images') is-invalid @enderror"></div>
                        @error('images')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col">
                        <?php $product_images = $product->getMedia('images'); ?>
                        @if (!empty($product_images->toArray()))
                            <div class="row">
                                <div class="col border p-1 mr-2 ml-2 mb-3">
                                    @foreach ($product_images as $image)
                                        <img src="{{ $image->getUrl() }}" width="150px" height="150px">
                                    @endforeach
                                </div>
                            </div>
                        @endif
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
                    <div class="col">
                        <?php $product_files = $product->getMedia('files'); ?>
                        @if (!empty($product_files->toArray()))
                            <div class="col p-2">
                                @foreach ($product_files as $file)
                                    <div>
                                        <a target="_blank" href="{{ $file->getUrl() }}">
                                            <span class="btn btn-info btn-xs show-file" id="{{ $file->id }}"
                                                style="border-radius: 5">Show
                                                file</span>
                                        </a>
                                        <span class="btn btn-sm btn-danger delete-file" style="padding: 1px 4px;"
                                            id=""><i class="fa fa-trash"></i></span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col mt-2">
                    <button type="submit" class="btn btn-primary float-right ml-1"><i
                            class="fa fa-check"></i>&nbsp;Modify
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
            $('.input-images').imageUploader();
            $('.input-files').fileUploader();

        </script>
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
            var delete_file = document.getElementsByClassName('delete-file');
            var show_file = document.getElementsByClassName('show-file');
            for (let i = 0; i < delete_file.length; i++) {
                delete_file[i].onclick = function() {
                    show_file[i].style.display = 'none';
                    delete_file[i].style.display = 'none';
                    var hiddenElement = document.createElement("input");
                    hiddenElement.setAttribute("type", "hidden");
                    hiddenElement.setAttribute("name", "deletefiles[]");
                    hiddenElement.setAttribute("id", "hiddenElement");
                    hiddenElement.setAttribute("value", show_file[i].getAttribute('id'));
                    document.productForm.appendChild(hiddenElement);
                }
            }

        </script>
    @endsection
</x-layout>
