<x-layout>
    @section('css')
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add New Invoice</h3>

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
                <form action="{{ route('invoiceAdd') }}" method="POST" name="addInvoice" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class=" form-control-label">Client Name *</label>
                            <input type="text" class="form-control @error('client_name') is-invalid @enderror"
                                name="client_name" value="{{ old('client_name') }}" placeholder="Client Name">
                            @error('client_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class=" form-control-label">Client Phone</label>
                            <input type="number" class="form-control @error('client_phone') is-invalid @enderror"
                                name="client_phone" value="{{ old('client_phone') }}" placeholder="Client Phone">
                            @error('client_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class=" form-control-label">Date *</label>
                            <input class="form-control  @error('date') is-invalid @enderror" type="date"
                                value="{{ old('date') }}" name="date">
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class=" form-control-label">Client Address</label>
                            <input type="text" class="form-control @error('client_address') is-invalid @enderror"
                                name="client_address" value="{{ old('client_address') }}" placeholder="Client Address">
                            @error('client_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label class="form-control-label">Product *</label>
                            <select id="product_id" class="custom-select @error('product_id') is-invalid @enderror"
                                name="product_id[]">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach

                            </select>
                            @error('product_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label class="form-control-label">Quantity *</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                name="quantity[]" placeholder="quantity" min="1" required>
                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div id="divAddProduct"></div>

                    <div class="">
                        <button id="newsectionbtn" onclick="addInputs()" type="button" class="btn btn-secondary mt-3 "><i
                                class="fas fa-plus"></i></button>
                    </div>
                    <div class="col mt-2">
                        <button type="submit" class="btn btn-primary float-right ml-1"><i class="fa fa-check"></i>&nbsp;Add
                            invoice</button>
                        <a href="{{ route('invoices') }}"><button type="button" class="btn btn-primary float-right"><i
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
            function addInputs() {
                var product_id = document.getElementById('product_id');
                var form_row = document.createElement('div');
                var select_col_6 = document.createElement('div');
                var quantity_col_6 = document.createElement('div');
                var select_form_control_label = document.createElement('label');
                var quantity_form_control_label = document.createElement('label');
                var custom_select = document.createElement('select');
                var input_quantity = document.createElement('input');
                var divAddProduct = document.getElementById('divAddProduct');
                for (let i = 0; i < product_id.length; i++) {
                    console.log(product_id.options[i].text);
                    var option = document.createElement('option');
                    option.setAttribute('value', product_id.options[i].value);
                    option.appendChild(document.createTextNode(product_id.options[i].text));
                    custom_select.appendChild(option);
                }

                form_row.setAttribute('class', 'form-row');
                select_col_6.setAttribute('class', 'form-group col-6');
                quantity_col_6.setAttribute('class', 'form-group col-6');
                select_form_control_label.setAttribute('class', 'form-control-label');
                quantity_form_control_label.setAttribute('class', 'form-control-label');
                custom_select.setAttribute('class', 'custom-select');
                custom_select.setAttribute('name', 'product_id[]');
                input_quantity.setAttribute('name', 'quantity[]');
                input_quantity.setAttribute('placeholder', 'quantity');
                input_quantity.setAttribute('class', 'form-control');
                select_form_control_label.appendChild(document.createTextNode('Product *'));
                select_col_6.appendChild(select_form_control_label);
                select_col_6.appendChild(custom_select);
                quantity_form_control_label.appendChild(document.createTextNode('Quantity *'));
                quantity_col_6.appendChild(quantity_form_control_label);
                quantity_col_6.appendChild(input_quantity);
                form_row.appendChild(select_col_6);
                form_row.appendChild(quantity_col_6);
                divAddProduct.appendChild(form_row);

            }

        </script>

    @endsection
</x-layout>
