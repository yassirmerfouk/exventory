<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />

    <link href='{{ asset('css/pdf/bootstrap.min.css') }}' rel="stylesheet">
    <title>Invoice PDF</title>

    <style>
        .card {
            margin-bottom: 1.5rem
        }

        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #c8ced3;
            border-radius: .25rem
        }

        .card-header:first-child {
            border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0
        }

        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: #f0f3f5;
            border-bottom: 1px solid #c8ced3
        }

    </style>
</head>

<body>
    <div class="col-9 container-fluid mt-5">
        <div id="ui-view" data-select2-id="ui-view">
            <div>
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <img src="{{ asset('img/temp_logo.png') }}">
                            </div>
                            <div class="col-sm-4">
                                <h6 class="mb-3">From:</h6>
                                <div>
                                    <strong>ExVentory</strong>
                                </div>
                                <div>Centre commercial Ibn Rochd</div>
                                <div>Sidi Bouzid - Safi</div>
                                <div>Email: exventoryadmin@gmail.com</div>
                                <div>Phone: +212 808 500 940</div>
                            </div>
                            <div class="col-sm-4">
                                <h6 class="mb-3">To:</h6>
                                <div><strong>{{ $invoice->client_name }}</strong></div>
                                <div>{{ $invoice->client_address }}</div>
                                <div>O{{ $invoice->client_phone }}</div>
                            </div>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Product</th>
                                        <th>Description</th>
                                        <th class="center">Quantity</th>
                                        <th class="right">Unit Cost</th>
                                        <th class="right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0; ?>
                                    @foreach ($invoice->products as $product)
                                        <tr>
                                            <?php $price_by_quantity = 0; ?>
                                            <td class="center">{{ $loop->iteration }}</td>
                                            <td class="left">{{ $product->name }}</td>
                                            <td class="left">Apple iphoe 10 with extended warranty</td>
                                            <td class="center">{{ $product->pivot->quantity }}</td>
                                            <td class="right">{{ $product->price }} Dh</td>
                                            <?php
                                            $price_by_quantity = $product->price * $product->pivot->quantity;
                                            $total += $price_by_quantity;
                                            ?>
                                            <td class="right">{{ $price_by_quantity }} Dh
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        {{-- <tr>
                                            <td class="left">
                                                <strong>Subtotal</strong>
                                            </td>
                                            <td class="right">$8.497,00</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong>Discount (20%)</strong>
                                            </td>
                                            <td class="right">$1,699,40</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong>VAT (10%)</strong>
                                            </td>
                                            <td class="right">$679,76</td>
                                        </tr> --}}
                                        <tr>
                                            <td class="left">
                                                <strong>Total</strong>
                                            </td>
                                            <td class="right">
                                                <strong>{{ $total }} Dh</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
