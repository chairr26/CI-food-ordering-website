<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" href="CSS/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="JS/multislider.min.js"></script>
    <title>Lau Cafe</title>
</head>

<body>
    <nav>
        <center>
            <div class="navbar-top">
                <div>
                    <a href="#">
                        <h4 class="logo">Lau Cafe</h4>
                    </a>
                </div>
                <div>

                    <div class="keranjang">
                        <div class="sum-prices">
                            <i class="fas fa-shopping-cart shoppingCartButton"></i>
                            <h6 id="sum-prices"></h6>
                        </div>
                    </div>
                </div>
            </div>
        </center>



        <div class="producstOnCart hide">
            <div class="overlay"></div>
            <div class="top">
                <button id="closeButton">
                    <i class="fas fa-times-circle"></i>
                </button>
                <h3>Cart</h3>
            </div>
            <ul id="buyItems">
                <h4 class="empty">Your shopping cart is empty</h4>
            </ul>
            <button class="btn checkout hidden">Check out</button>
        </div>
    </nav>
    <div class="container">
        <br>
        <center>
            <a style="background-color: #94B49F;text-decoration:none;padding:5px;color:white;" href="#makanan" class="link">Makanan</a>
            <a style="background-color: #94B49F;text-decoration:none;padding:5px;color:white;" href="#minuman" class="link">Minuman</a>
            <a style="background-color: #94B49F;text-decoration:none;padding:5px;color:white;" href="#snack" class="link">Snack</a>
        </center>
    </div>

















    <main>

        <section class="main-section" id="minuman">
            <div class="main">
                <div id="list_food_home" class="container">
                    <div class="row" id="prinf_food">
                    </div>
                </div>
            </div>
            <?php
            foreach ($menu as $key => $value) :
            ?>
                <script>
                    var prinf = `
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 p-4 product">
                        <div class="produre_box bg-white shadow-sm product-under">
                            <div class="image_box product-image">
                                <img src="<?= $value->menu_image ?>" width="100%" height="100%" style="">
                            </div>
                            <div class="info_box p-3 bg-white">
                                <h5 class="productName"><?= $value->menu_name ?></h5>
                                
                                <h6 class="price" style="padding:0">Rp <span class="priceValue"><?= $value->menu_price ?></span>
                                </h6>
                                <div style="height:60px">
                                    <p style="font-size: 80%;width:85%;"><?= $value->menu_description ?></p>
                                </div>
                                <div class="order_box float-right">
                                    <div class="order_button float-right pt-2">
                                    <div class="product-over">
                                        <button class="tombol addToCart" data-product-id="<?= $value->menu_id ?>">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                        
                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>
                        </div>
                    </div>`;
                    document.getElementById("prinf_food").innerHTML += prinf;
                </script>
            <?php endforeach ?>
        </section>
    </main>



















    <script>
        let productsInCart = JSON.parse(localStorage.getItem('shoppingCart'));
        if (!productsInCart) {
            productsInCart = [];
        }
        const parentElement = document.querySelector('#buyItems');
        const cartSumPrice = document.querySelector('#sum-prices');
        const products = document.querySelectorAll('.product-under');


        const countTheSumPrice = function() { // 4
            let sum = 0;
            productsInCart.forEach(item => {
                sum += item.price;
            });
            return sum;
        }

        const updateShoppingCartHTML = function() { // 3
            localStorage.setItem('shoppingCart', JSON.stringify(productsInCart));
            if (productsInCart.length > 0) {
                let result = productsInCart.map(product => {
                    return `
				<li class="buyItem">
					<img src="${product.image}">
					<div>
						<h5>${product.name}</h5>
						<h6>Rp ${product.price}</h6>
						<div>
							<button class="button-minus" data-id=${product.id}>-</button>
							<span class="countOfProduct">${product.count}</span>
							<button class="button-plus" data-id=${product.id}>+</button>
						</div>
					</div>
				</li>`
                });
                parentElement.innerHTML = result.join('');
                document.querySelector('.checkout').classList.remove('hidden');
                cartSumPrice.innerHTML = 'Rp' + countTheSumPrice();

            } else {
                document.querySelector('.checkout').classList.add('hidden');
                parentElement.innerHTML = '<h4 class="empty">Your shopping cart is empty</h4>';
                cartSumPrice.innerHTML = '';
            }
        }

        function updateProductsInCart(product) { // 2
            for (let i = 0; i < productsInCart.length; i++) {
                if (productsInCart[i].id == product.id) {
                    productsInCart[i].count += 1;
                    productsInCart[i].price = productsInCart[i].basePrice * productsInCart[i].count;
                    return;
                }
            }
            productsInCart.push(product);
        }

        products.forEach(item => { // 1
            item.addEventListener('click', (e) => {
                if (e.target.classList.contains('addToCart')) {
                    const productID = e.target.dataset.productId;
                    const productName = item.querySelector('.productName').innerHTML;
                    const productPrice = item.querySelector('.priceValue').innerHTML;
                    const productImage = item.querySelector('img').src;
                    let product = {
                        name: productName,
                        image: productImage,
                        id: productID,
                        count: 1,
                        price: +productPrice,
                        basePrice: +productPrice,
                    }
                    updateProductsInCart(product);
                    updateShoppingCartHTML();
                }
            });
        });

        parentElement.addEventListener('click', (e) => { // Last
            const isPlusButton = e.target.classList.contains('button-plus');
            const isMinusButton = e.target.classList.contains('button-minus');
            if (isPlusButton || isMinusButton) {
                for (let i = 0; i < productsInCart.length; i++) {
                    if (productsInCart[i].id == e.target.dataset.id) {
                        if (isPlusButton) {
                            productsInCart[i].count += 1
                        } else if (isMinusButton) {
                            productsInCart[i].count -= 1
                        }
                        productsInCart[i].price = productsInCart[i].basePrice * productsInCart[i].count;

                    }
                    if (productsInCart[i].count <= 0) {
                        productsInCart.splice(i, 1);
                    }
                }
                updateShoppingCartHTML();
            }
        });

        updateShoppingCartHTML();
    </script>
    <script>
        // const responsiveNavbar = (function() {
        //     const button = document.querySelector("#menuButton");
        //     const navbar = document.querySelector("#navbar")
        // button.addEventListener("click", function() {
        // if (navbar.className === "navbar") {
        // navbar.className += " navbarResponsive";
        // } else {
        //     navbar.className = "navbar";
        // }
        // });
        // })();

        if (document.getElementById('hearderSlide')) {
            $('#hearderSlide').multislider();
            $('#hearderSlide').multislider('pause');
        }


        function closeCart() {
            const cart = document.querySelector('.producstOnCart');
            cart.classList.toggle('hide');
            document.querySelector('body').classList.toggle('stopScrolling')
        }


        const openShopCart = document.querySelector('.shoppingCartButton');
        openShopCart.addEventListener('click', () => {
            const cart = document.querySelector('.producstOnCart');
            cart.classList.toggle('hide');
            document.querySelector('body').classList.toggle('stopScrolling');
        });


        const closeShopCart = document.querySelector('#closeButton');
        const overlay = document.querySelector('.overlay');
        closeShopCart.addEventListener('click', closeCart);
        overlay.addEventListener('click', closeCart);
    </script>
</body>

</html>