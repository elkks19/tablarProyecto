<div id="product-list">
    <div class="form-group">
        <label>{{ $field['label'] }}</label>
        <div class="input-group mb-3">
            <select class="custom-select" id="product-select">
                @foreach($field['products'] as $product)
                    <option value="{{ $product->id }}">{{ $product->nombre }}</option>
                @endforeach
            </select>
            <input type="number" class="form-control" id="quantity" value="1" min="1">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="button" id="add-product">Añadir</button>
            </div>
        </div>
    </div>

    <ul id="selected-products" class="list-group">
        <!-- Selected products will be added here -->
    </ul>

    <input type="hidden" id="products-data" name="products_data">
</div>

@push('after_scripts')
<script>
    @if (isset($entry))
        var selectedProducts = {!! json_encode($entry->productos->mapWithKeys(function($product) {
            return [
                $product->id => [
                    'name' => $product->nombre,
                    'quantity' => $product->pivot->cantidad
                ]
            ];
        })) !!};
    @else
        var selectedProducts = {};
    @endif

    function updateSelectedProducts() {
        $('#selected-products').empty();
        for (var productId in selectedProducts) {
            $('#selected-products').append('<li class="list-group-item d-flex justify-content-between align-items-center">' +
                '<span class="product-name">' + selectedProducts[productId].name + '</span>' +
                '<div class="quantity">' +
                '<button type="button" class="btn btn-primary btn-sm decrease-quantity">-</button>' +
                '<span class="badge badge-primary badge-pill">' + selectedProducts[productId].quantity + '</span>' +
                '<button type="button" class="btn btn-primary btn-sm increase-quantity">+</button>' +
                '</div>' +
                '<button type="button" class="btn btn-danger btn-sm remove-product" data-id="' + productId + '">Eliminar</button>' +
                '</li>');
        }
        $('#products-data').val(JSON.stringify(selectedProducts));
    }

    $(document).ready(function () {
        updateSelectedProducts();

        $('#add-product').click(function () {
            var productId = $('#product-select').val();
            var productName = $('#product-select option:selected').text();
            var quantity = parseInt($('#quantity').val());

            if (selectedProducts[productId]) {
                selectedProducts[productId].quantity += quantity;
            } else {
                selectedProducts[productId] = {
                    name: productName,
                    quantity: quantity
                };
            }

            updateSelectedProducts();
        });

        $(document).on('click', '.increase-quantity', function () {
            var productId = $(this).closest('li').find('.remove-product').data('id');
            selectedProducts[productId].quantity++;
            updateSelectedProducts();
        });

        $(document).on('click', '.decrease-quantity', function () {
            var productId = $(this).closest('li').find('.remove-product').data('id');
            if (selectedProducts[productId].quantity > 1) {
                selectedProducts[productId].quantity--;
                updateSelectedProducts();
            }
        });

        $(document).on('click', '.remove-product', function () {
            var productId = $(this).data('id');
            delete selectedProducts[productId];
            updateSelectedProducts();
        });
    });
</script>
@endpush
