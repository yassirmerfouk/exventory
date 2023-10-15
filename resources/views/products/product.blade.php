<x-layout>
    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <?php $product_images = $product->getMedia('images'); ?>
                    <div class="col-11 d-flex justify-content-center">
                        @if (!empty($product_images->toArray()))
                            <img src="{{ $product_images[0]->getUrl() }}" class="product-image" alt="Product Image">
                        @endif
                    </div>
                    <div class="col-12 product-image-thumbs d-flex justify-content-center">
                        @foreach ($product_images as $image)
                            <div class="product-image-thumb active">
                                <img src="{{ $image->getUrl() }}" alt="Product Image">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <h4 class="my-3">{{ $product->name }}</h4>
                    <p>{{ $product->description }}</p>

                    <hr>

                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    Name
                                </th>
                                <td>
                                    {{ $product->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Category
                                </th>
                                <td>
                                    {{ $product->getCategory->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Quantity
                                </th>
                                <td>
                                    {{ $product->stocks[0]->pivot->quantity }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Price
                                </th>
                                <td>
                                    {{ $product->price }} DHS
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Shopping Date
                                </th>
                                <td>
                                    {{ $product->date }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Location
                                </th>
                                <td>
                                    {{ $product->stocks[0]->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Shop Address
                                </th>
                                <td>
                                    {{ $product->shop_address }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Tags
                                </th>
                                <td>
                                    @foreach ($product->tags as $tag)
                                        {{ $tag->name }} ,
                                    @endforeach
                                </td>
                            </tr>
                            <?php $product_files = $product->getMedia('files'); ?>
                            @foreach ($product_files as $file)
                                <tr>
                                    <th>
                                        File {{ $loop->iteration }}
                                    </th>
                                    <td>
                                        <a target="_blank" href="{{ $file->getUrl() }}"><span
                                                class="btn btn-info btn-xs" style="border-radius: 5">Show
                                                file</span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @section('script')
        <script>
            $(document).ready(function() {
                $('.product-image-thumb').on('click', function() {
                    var $image_element = $(this).find('img')
                    $('.product-image').prop('src', $image_element.attr('src'))
                    $('.product-image-thumb.active').removeClass('active')
                    $(this).addClass('active')
                })
            })

        </script>
    @endsection
</x-layout>
