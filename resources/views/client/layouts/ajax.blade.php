<script>
    function formatCurrency(amount) {
        const formattedAmount = amount.toLocaleString('vi-VN', {
            style: 'currency',
            currency: 'VND',
            minimumFractionDigits: 0,
        });

        const currencySymbol = "vnđ";
        const replacedSymbol = formattedAmount.replace(/\./g, ',').replace("₫", currencySymbol);

        return replacedSymbol;
    }

    // Add to Cart
    function addToCart(productId) {
        $.ajax({
            type: 'POST',
            url: '/add-to-cart',
            data: {
                productId: productId,
                quantity: 1
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                var vnd = formatCurrency(response.totalPrice);
                document.getElementById("number-cart").innerHTML = response.cartCount;
                document.getElementById("number-items").innerHTML = "(" + (response.cartCount) + ")" +
                    " ITEMS ";
                document.getElementById("cart-total").innerHTML = "Subtotal: " + vnd;

                $('#mini-cart-items').empty();

                var cartArray = Object.values(response.cartItems);

                cartArray.forEach(c => {
                    var cartItemHtml =
                        `
                        <li>
                            <div class="thumb">
                                <img src="{{ asset('storage/${c.image}') }}" alt="">
                            </div>
                            <div class="info">
                                <h4 class="product-name"><a href="#">${c.product_name}</a></h4>
                                <span class="price">${c.quantity}x${ formatCurrency(c.price)}</span>
                                <a class="remove-item" href="#" data-delete-cart-id="${c.id}">
                                    <i class="fa fa-close"></i>
                                </a>
                            </div>
                        </li>
                    `;

                    $('#mini-cart-items').append(cartItemHtml);
                });

                $('.remove-item').on('click', function(e) {
                    e.preventDefault();
                    var productId = $(this).data('delete-cart-id');

                    removeCartItem(productId);
                });
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                })
            },
            error: function(xhr) {

            }
        });
    }

    function updateCart() {

        var formData = $('#updateCartForm').serialize();

        $.ajax({
            type: 'POST',
            url: '{{ route('update_cart') }}',
            data: formData,
            dataType: 'json',
            success: function(response) {

                document.getElementById("total").innerHTML = formatCurrency(response.totalPrice);
                document.getElementById("totals").innerHTML = formatCurrency(response.totalPrice);

                var cartItems = response.cartItems;

                for (var key in cartItems) {
                    if (cartItems.hasOwnProperty(key)) {
                        var item = cartItems[key];
                        var productId = item.id;
                        var quantityElement = document.getElementById('quantity_' + productId);
                        var totalElement = document.getElementById('totalPrice_' + productId);

                        if (quantityElement && totalElement) {
                            quantityElement.value = item.quantity;
                            totalElement.innerText = formatCurrency(item.total_price);
                        }
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }


    // Xoá sản phầm khỏi giỏ hàng
    function removeCartItem(productId) {
        $.ajax({
            type: 'POST',
            url: '{{ route('delete_cart') }}',
            data: {
                productId: productId,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                var vnd = formatCurrency(response.totalPrice);
                document.getElementById("number-cart").innerHTML = response.cartCount;
                document.getElementById("number-items").innerHTML = "(" + (response.cartCount) + ")" +" ITEMS ";
                document.getElementById("cart-total").innerHTML = "Subtotal: " + vnd;

                ;

                $('#mini-cart-items').empty();

                var cartArray = Object.values(response.cartItems);

                // Tính tổng tiền của tất cả sản phẩm trong giỏ hàng
                cartArray.forEach(c => {
                    var cartItemHtml =
                        `
                        <li>
                            <div class="thumb">
                                <img src="{{ asset('storage/${c.image}') }}" alt="">
                            </div>
                            <div class="info">
                                <h4 class="product-name"><a href="#">${c.product_name}</a></h4>
                                <span class="price">${c.quantity}x${ formatCurrency(c.price)}</span>
                                <a class="remove-item" href="#" data-delete-cart-id="${c.id}">
                                    <i class="fa fa-close"></i>
                                </a>
                            </div>
                        </li>
                    `;

                    $('#mini-cart-items').append(cartItemHtml);
                });


                $('.remove-item').on('click', function(e) {
                    e.preventDefault();
                    var productId = $(this).data('delete-cart-id');

                    removeCartItem(productId);
                });
            },
            error: function(xhr) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
            }
        });
    }

    // Filter Category or Brand
    function filterProduct(categoryId, brandId) {

        $.ajax({
            url: '{{ route('filter_product') }}',
            type: 'GET',
            data: {
                category_id: categoryId,
                brand_id: brandId
            },
            success: function(response) {
                $('#shopList').empty();

                var shopArray = Object.values(response.products);
                console.log(shopArray);

                shopArray.forEach(c => {
                    var shopItemHtml =
                        `
                        <li class="product-item col-sm-6 col-md-4">
                            <div class="product-inner">
                                <div class="product-thumb has-back-image">
                                    ${c.image.length > 0 ? `
                                        <a href="/product-detail/${c.id}">
                                            <img src="${c.image[0].image_name ? '/storage/' + c.image[0].image_name : ''}" alt="">
                                        </a>
                                    ` : ''}
                                    ${c.image.length > 1 ? `
                                        <a class="back-image" href="/product-detail/${c.id}">
                                            <img src="${c.image[1].image_name ? '/storage/' + c.image[1].image_name : ''}" alt="">
                                        </a>
                                    ` : ''}

                                    <div class="gorup-button">
                                        <a href="#" class="wishlist"><i class="fa fa-heart"></i></a>
                                        <a href="#" class="compare"><i class="fa fa-exchange"></i></a>
                                        <a href="/product-detail/${c.id}" class="quick-view" data-product-id="${c.id}"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3 class="product-name">
                                        <a href="/product-detail/${c.id}" data-product-id="${c.id}">${c.product_name}</a>
                                    </h3>
                                    <span class="price">
                                        <ins style="text-decoration: line-through">${formatCurrency(c.discount_price)}</ins>
                                        <ins>${formatCurrency(c.price)}</ins>
                                    </span>
                                    <a href="/product-detail/${c.id}" class="button add-to-cart" data-product-id="${c.id}">ADD TO CART</a>
                                </div>
                            </div>
                        </li>
                        `;

                    $('#shopList').append(shopItemHtml);
                });
                // Gắn sự kiện click handler cho nút "ADD TO CART" sau khi danh sách sản phẩm đã được tải lại
                $('.add-to-cart').off('click').on('click', function(e) {
                    e.preventDefault();
                    var productId = $(this).data('product-id');

                    // Gọi hàm addToCart với productId như tham số
                    addToCart(productId);
                });
            },
            error: function(xhr, status, error) {
                console.log('Có lỗi xảy ra trong yêu cầu Ajax');
            }
        });
    }

    //FilterPrice
    function filterPrice(minPrice, maxPrice) {
        $.ajax({
            url: "{{ route('filter_price') }}",
            method: 'GET',
            data: {
                minPrice: minPrice,
                maxPrice: maxPrice,
            },
            success: function(response) {
                $('#shopList').empty();

                var shopArray = Object.values(response.products);

                shopArray.forEach(c => {
                    var shopItemHtml =
                        `
                                <li class="product-item col-sm-6 col-md-4">
                                    <div class="product-inner">
                                        <div class="product-thumb has-back-image">
                                            ${c.image.length > 0 ? `
                                                <a href="/product-detail/${c.id}">
                                                    <img src="${c.image[0].image_name ? '/storage/' + c.image[0].image_name : ''}" alt="">
                                                </a>
                                            ` : ''}
                                            ${c.image.length > 1 ? `
                                                <a class="back-image" href="/product-detail/${c.id}">
                                                    <img src="${c.image[1].image_name ? '/storage/' + c.image[1].image_name : ''}" alt="">
                                                </a>
                                            ` : ''}

                                            <div class="gorup-button">
                                                <a href="#" class="wishlist"><i class="fa fa-heart"></i></a>
                                                <a href="#" class="compare"><i class="fa fa-exchange"></i></a>
                                                <a href="/product-detail/${c.id}" class="quick-view" data-product-id="${c.id}"><i class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <h3 class="product-name">
                                                <a href="/product-detail/${c.id}" data-product-id="${c.id}">${c.product_name}</a>
                                            </h3>
                                            <span class="price">
                                                <ins style="text-decoration: line-through">${formatCurrency(c.discount_price)}</ins>
                                                <ins>${formatCurrency(c.price)}</ins>
                                            </span>
                                            <a href="/product-detail/${c.id}" class="button add-to-cart" data-product-id="${c.id}">ADD TO CART</a>
                                        </div>
                                    </div>
                                </li>
                                `;

                    $('#shopList').append(shopItemHtml);
                });
                // Gắn sự kiện click handler cho nút "ADD TO CART" sau khi danh sách sản phẩm đã được tải lại
                $('.add-to-cart').off('click').on('click', function(e) {
                    e.preventDefault();
                    var productId = $(this).data('product-id');

                    // Gọi hàm addToCart với productId như tham số
                    addToCart(productId);
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    $(document).ready(function() {
        // Xử lý sự kiện khi người dùng nhấp vào nút thêm vào giỏ hàng
        $('.add-to-cart').on('click', function(e) {
            e.preventDefault();
            var productId = $(this).data('product-id');

            addToCart(productId);
        });

        $('.qty').on('change', function() {
            var value = parseInt($(this).val());

            if (value < 0) {
                $(this).val(0);
            }
        });

        $('#checkoutButton').on('click', function(event) {
            event.preventDefault();

            window.location.href = "{{ route('check_out') }}";
        });

        var item = @json($item ?? null);

        $('#checkDelete').on('click', function(event) {
            event.preventDefault();

            // Kiểm tra số lượng sản phẩm trong giỏ hàng
            var cartItemCount = {{ count(session('cart', [])) }};

            if (cartItemCount > 0) {
                if (item) {
                    window.location.href = "{{ route('destroy_cart', ['id' => ':id']) }}".replace(':id', item.id);
                } else {
                    alert("Không thể xoá sản phẩm.");
                }
            } else {
                // Xử lý khi giỏ hàng trống
                alert("Giỏ hàng đã trống. Không thể xoá sản phẩm.");
            }
        });

        $('#updateCartForm').on('click', function(event) {
            event.preventDefault();

            var formData = $('#updateCartForm').serialize();

            updateCart(formData);
        });

        // Remove
        $('.remove-item').on('click', function(e) {
            e.preventDefault();
            var productId = $(this).data('delete-cart-id');

            removeCartItem(productId);
        });

        // Filter categories,brand
        $('.product-categories a, .tagcloud a').click(function(event) {
            event.preventDefault();

            var categoryId = $(this).data('category-id');
            var brandId = $(this).data('brand-id');

            filterProduct(categoryId, brandId);
        });
        // Filter Price
        $('.slider-range-price').slider({
            range: true,
            min: 50000,
            max: 1000000,
            values: [50000, 1000000],
            slide: function(event, ui) {
                $('.amount-range-price').text('Price: ' + ui.values[0] + 'đ - ' + ui.values[1] +
                    'đ');
            },
            stop: function(event, ui) {
                var minPrice = ui.values[0];
                var maxPrice = ui.values[1];

                filterPrice(minPrice, maxPrice);
            }
        });
    });
</script>
