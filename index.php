<?php 
include 'header.php'; 
$conn_admin = connect_admin_db();
$sql_products = "SELECT * FROM products";
$products_result = $conn_admin->query($sql_products);
?>

    <section id="billboard" class="overflow-hidden">

      <button class="button-prev">
        <i class="icon icon-chevron-left"></i>
      </button>
      <button class="button-next">
        <i class="icon icon-chevron-right"></i>
      </button>
      <div class="swiper main-swiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide" style="background-image: url('images/banner1.jpg');background-repeat: no-repeat;background-size: cover;background-position: center;">
            <div class="banner-content">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <h2 class="banner-title">Summer Collection</h2>
                    <p>Discover the perfect styles for warm weather.Refresh your closet with our latest looks.</p>
                    <div class="btn-wrap">
                      <a href="shop.php" class="btn btn-light btn-medium d-flex align-items-center" tabindex="0">Shop it now <i class="icon icon-arrow-io"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide" style="background-image: url('images/banner2.jpg');background-repeat: no-repeat;background-size: cover;background-position: center;">
            <div class="banner-content">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <h2 class="banner-title">Casual Collection</h2>
                    <p>Discover effortless style for everyday.Our newest collection is all about comfort and confidence.</p>
                    <div class="btn-wrap">
                      <a href="shop.php" class="btn btn-light btn-light-arrow btn-medium d-flex align-items-center" tabindex="0">Shop it now <i class="icon icon-arrow-io"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="featured-products" class="product-store padding-large">
      <div class="container">
        <div class="section-header d-flex flex-wrap align-items-center justify-content-between">
          <h2 class="section-title">Featured Products</h2>            
          <div class="btn-wrap">
            <a href="shop.php" class="d-flex align-items-center">View all products <i class="icon icon icon-arrow-io"></i></a>
          </div>            
        </div>
        <div class="swiper product-swiper overflow-hidden">
          <div class="swiper-wrapper">
            <?php
              if ($products_result->num_rows > 0) {
                while($row = $products_result->fetch_assoc()) {
                  echo '<div class="swiper-slide">';
                  echo '<div class="product-item">';
                  echo '<div class="image-holder">';
                  echo '<img src="images/' . $row["image"] . '" alt="Books" class="product-image">';
                  echo '</div>';
                  echo '<div class="cart-concern">';
                  echo '<div class="cart-button d-flex justify-content-between align-items-center">';
                  echo '<form method="post" action="shop.php">';
                  echo '<input type="hidden" name="product_id" value="' . $row["id"] . '">';
                  echo '<select class="form-select" name="size" aria-label="Default select example">';
                  echo '<option selected>Size</option>';
                  echo '<option value="S">S</option>';
                  echo '<option value="M">M</option>';
                  echo '<option value="L">L</option>';
                  echo '<option value="XL">XL</option>';
                  echo '<option value="XXL">XXL</option>';
                  echo '</select>';
                  echo '<button type="submit" name="add_to_cart" class="btn-wrap cart-link d-flex align-items-center">add to cart <i class="icon icon-arrow-io"></i></button>';
                  echo '<button type="submit" name="add_to_wishlist" class="wishlist-btn"><i class="icon icon-heart"></i></button>';
                  echo '</form>';
                  echo '<button type="button" class="view-btn tooltip d-flex">';
                  echo '<i class="icon icon-screen-full"></i>';
                  echo '<span class="tooltip-text">Quick view</span>';
                  echo '</button>';
                  echo '</div>';
                  echo '</div>';
                  echo '<div class="product-detail">';
                  echo '<h3 class="product-title">';
                  echo '<a href="single-product.php?id=' . $row["id"] . '">' . $row["name"] . '</a>';
                  echo '</h3>';
                  echo '<span class="item-price text-primary">₹' . $row["price"] . '</span>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                }
              }
              // Reset the result pointer to use it again for the best selling products
              $products_result->data_seek(0);
            ?>
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </section>

    <section id="latest-collection">
      <div class="container">
        <div class="product-collection row">
          <div class="col-lg-7 col-md-12 left-content">
            <div class="collection-item">
              <div class="products-thumb">
                <img src="images/collection-item1.jpg" alt="collection item" class="large-image image-rounded">
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 product-entry">
                <div class="categories">casual collection</div>
                <h3 class="item-title">street wear.</h3>
                <p>Your style,your rules. Explore our blod and fresh Street Wear collection.</p>
                <div class="btn-wrap">
                  <a href="shop.php" class="d-flex align-items-center">shop collection <i class="icon icon-arrow-io"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-md-12 right-content flex-wrap">
            <div class="collection-item top-item">
              <div class="products-thumb">
                <img src="images/collection-item2.jpg" alt="collection item" class="small-image image-rounded">
              </div>
              <div class="col-md-6 product-entry">
                <div class="categories">Basic Collection</div>
                <h3 class="item-title">Basic shoes.</h3>
                <div class="btn-wrap">
                  <a href="shop.php" class="d-flex align-items-center">shop collection <i class="icon icon-arrow-io"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="collection-item bottom-item">
              <div class="products-thumb">
                <img src="images/collection-item3.jpg" alt="collection item" class="small-image image-rounded">
              </div>
              <div class="col-md-6 product-entry">
                <div class="categories">Best Selling Product</div>
                <h3 class="item-title">woolen hat.</h3>
                <div class="btn-wrap">
                  <a href="shop.php" class="d-flex align-items-center">shop collection <i class="icon icon-arrow-io"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="subscribe" class="padding-large">
      <div class="container">
        <div class="row">
          <div class="block-text col-md-6">
            <div class="section-header">
              <h2 class="section-title">Get 25% off Discount Coupons</h2>
            </div>
            <p>Subscribe now to get your 50% off discount and be the first to know about new arrivals.</p>
          </div>
          <div class="subscribe-content col-md-6">
            <form id="form" class="d-flex justify-content-between">
              <input type="text" name="email" placeholder="Enter your email addresss here">
              <button class="btn btn-dark">Subscribe Now</button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <section id="selling-products" class="product-store bg-light-grey padding-large">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Best selling products</h2>
        </div>
        <ul class="tabs list-unstyled">
          <li data-tab-target="#all" class="active tab">All</li>
          <li data-tab-target="#shoes" class="tab">Shoes</li>
          <li data-tab-target="#tshirts" class="tab">Tshirts</li>
          <li data-tab-target="#pants" class="tab">Pants</li>
          <li data-tab-target="#hoodie" class="tab">Hoodie</li>
          <li data-tab-target="#outer" class="tab">Outer</li>
          <li data-tab-target="#jackets" class="tab">Jackets</li>
          <li data-tab-target="#accessories" class="tab">Accessories</li>
        </ul>
        <div class="tab-content">
          <div id="all" data-tab-content class="active">
            <div class="row d-flex flex-wrap">
              <?php
                if ($products_result->num_rows > 0) {
                  while($row = $products_result->fetch_assoc()) {
                    echo '<div class="product-item col-lg-3 col-md-6 col-sm-6">';
                    echo '<div class="image-holder">';
                    echo '<img src="images/' . $row["image"] . '" alt="Books" class="product-image">';
                    echo '</div>';
                    echo '<div class="cart-concern">';
                    echo '<div class="cart-button d-flex justify-content-between align-items-center">';
                    echo '<form method="post" action="shop.php">';
                    echo '<input type="hidden" name="product_id" value="' . $row["id"] . '">';
                    echo '<select class="form-select" name="size" aria-label="Default select example">';
                    echo '<option selected>Size</option>';
                    echo '<option value="S">S</option>';
                    echo '<option value="M">M</option>';
                    echo '<option value="L">L</option>';
                    echo '<option value="XL">XL</option>';
                    echo '<option value="XXL">XXL</option>';
                    echo '</select>';
                    echo '<button type="submit" name="add_to_cart" class="btn-wrap cart-link d-flex align-items-center">add to cart <i class="icon icon-arrow-io"></i></button>';
                    echo '<button type="submit" name="add_to_wishlist" class="wishlist-btn"><i class="icon icon-heart"></i></button>';
                    echo '</form>';
                    echo '<button type="button" class="view-btn tooltip d-flex">';
                    echo '<i class="icon icon-screen-full"></i>';
                    echo '<span class="tooltip-text">Quick view</span>';
                    echo '</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="product-detail">';
                    echo '<h3 class="product-title">';
                    echo '<a href="single-product.php?id=' . $row["id"] . '">' . $row["name"] . '</a>';
                    echo '</h3>';
                    echo '<div class="item-price text-primary">₹' . $row["price"] . '</div>';
                    echo '</div>';
                    echo '</div>';
                  }
                }
                $conn_admin->close();
              ?>
            </div>
          </div>
          <div id="shoes" data-tab-content>
            <div class="row d-flex flex-wrap">
            </div>
          </div>
          <div id="tshirts" data-tab-content>
            <div class="row d-flex flex-wrap">
            </div>
          </div>
          <div id="pants" data-tab-content>
            <div class="row d-flex flex-wrap">
            </div>
          </div>
          <div id="hoodie" data-tab-content>
            <div class="row d-flex flex-wrap">
            </div>
          </div>
          <div id="outer" data-tab-content>
            <div class="row d-flex flex-wrap">
            </div>
          </div>
          <div id="jackets" data-tab-content>
            <div class="row d-flex flex-wrap">
            </div>
          </div>
          <div id="accessories" data-tab-content>
            <div class="row d-flex flex-wrap">
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="testimonials" class="padding-large no-padding-bottom">
      <div class="container">
        <div class="reviews-content">
          <div class="row d-flex flex-wrap">
            <div class="col-md-2">
              <div class="review-icon">
                <i class="icon icon-right-quote"></i>
              </div>
            </div>
            <div class="col-md-8">
              <div class="swiper testimonial-swiper overflow-hidden">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="testimonial-detail">
                      <p>“Life is short make every outfit count ”</p>
                      <div class="author-detail">
                        <div class="name">By Maggie Rio</div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="testimonial-detail">
                      <p>“Clothes aren`t going to change the world, the men who wear them will definitely.”</p>
                      <div class="author-detail">
                        <div class="name">By John Smith</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-arrows">
                <button class="prev-button">
                  <i class="icon icon-arrow-left"></i>
                </button>
                <button class="next-button">
                  <i class="icon icon-arrow-right"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="flash-sales" class="product-store padding-large">
      
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Flash sales</h2>
        </div>
        <div class="swiper product-swiper flash-sales overflow-hidden">

          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="product-item">
                <img src="images/selling-products9.jpg" alt="Books" class="product-image">
                <div class="cart-concern">
                  <div class="cart-button d-flex justify-content-between align-items-center">
                    <button type="button" class="btn-wrap cart-link d-flex align-items-center">add to cart <i class="icon icon-arrow-io"></i>
                    </button>
                    <button type="button" class="view-btn tooltip
                        d-flex">
                      <i class="icon icon-screen-full"></i>
                      <span class="tooltip-text">Quick view</span>
                    </button>
                    <button type="button" class="wishlist-btn">
                      <i class="icon icon-heart"></i>
                    </button>
                  </div>
                </div>
                <div class="discount">10% Off</div>
                <div class="product-detail">
                  <h3 class="product-title">
                    <a href="single-product.php">Full sleeve cover shirt</a>
                  </h3>
                  <div class="item-price text-primary">
                    <del class="prev-price">₹500.00</del>₹400.00
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-item">
                <img src="images/selling-products10.jpg" alt="Books" class="product-image">
                <div class="cart-concern">
                  <div class="cart-button d-flex justify-content-between align-items-center">
                    <button type="button" class="btn-wrap cart-link d-flex align-items-center">add to cart <i class="icon icon-arrow-io"></i>
                    </button>
                    <button type="button" class="view-btn tooltip
                        d-flex">
                      <i class="icon icon-screen-full"></i>
                      <span class="tooltip-text">Quick view</span>
                    </button>
                    <button type="button" class="wishlist-btn">
                      <i class="icon icon-heart"></i>
                    </button>
                  </div>
                </div>
                <div class="discount">10% Off</div>
                <div class="product-detail">
                  <h3 class="product-title">
                    <a href="single-product.php">Long Sleeve T-shirt</a>
                  </h3>
                  <div class="item-price text-primary">
                    <del class="prev-price">₹500.00</del>₹407.00
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-item">
                <img src="images/selling-products11.jpg" alt="Books" class="product-image">
                <div class="cart-concern">
                  <div class="cart-button d-flex justify-content-between align-items-center">
                    <button type="button" class="btn-wrap cart-link d-flex align-items-center">add to cart <i class="icon icon-arrow-io"></i>
                    </button>
                    <button type="button" class="view-btn tooltip
                        d-flex">
                      <i class="icon icon-screen-full"></i>
                      <span class="tooltip-text">Quick view</span>
                    </button>
                    <button type="button" class="wishlist-btn">
                      <i class="icon icon-heart"></i>
                    </button>
                  </div>
                </div>
                <div class="discount">10% Off</div>
                <div class="product-detail">
                  <h3 class="product-title">
                    <a href="single-product.php">Grey Check Coat</a>
                  </h3>
                  <div class="item-price text-primary">
                    <del class="prev-price">₹555.00</del>₹452.00
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-item">
                <img src="images/selling-products12.jpg" alt="Books" class="product-image">
                <div class="cart-concern">
                  <div class="cart-button d-flex justify-content-between align-items-center">
                    <button type="button" class="btn-wrap cart-link d-flex align-items-center">add to cart <i class="icon icon-arrow-io"></i>
                    </button>
                    <button type="button" class="view-btn tooltip
                        d-flex">
                      <i class="icon icon-screen-full"></i>
                      <span class="tooltip-text">Quick view</span>
                    </button>
                    <button type="button" class="wishlist-btn">
                      <i class="icon icon-heart"></i>
                    </button>
                  </div>
                </div>
                <div class="discount">10% Off</div>
                <div class="product-detail">
                  <h3 class="product-title">
                    <a href="single-product.php">Silk White Shirt</a>
                  </h3>
                  <div class="item-price text-primary">
                    <del class="prev-price">₹450.00</del>₹355.00
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-item">
                <img src="images/selling-products8.jpg" alt="Books" class="product-image">
                <div class="cart-concern">
                  <div class="cart-button d-flex justify-content-between align-items-center">
                    <button type="button" class="btn-wrap cart-link d-flex align-items-center">add to cart <i class="icon icon-arrow-io"></i>
                    </button>
                    <button type="button" class="view-btn tooltip
                        d-flex">
                      <i class="icon icon-screen-full"></i>
                      <span class="tooltip-text">Quick view</span>
                    </button>
                    <button type="button" class="wishlist-btn">
                      <i class="icon icon-heart"></i>
                    </button>
                  </div>
                </div>
                <div class="discount">10% Off</div>
                <div class="product-detail">
                  <h3 class="product-title">
                    <a href="single-product.php">Blue Jeans pant</a>
                  </h3>
                  <div class="item-price text-primary">
                    <del class="prev-price">₹457.00</del>₹352.00
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-pagination"></div>

        </div>
      </div>
    </section>

    <section class="shoppify-section-banner">
      <div class="container">
        <div class="product-collection">
          <div class="left-content collection-item">
            <div class="products-thumb">
              <img src="images/model.jpg" alt="collection item" class="large-image image-rounded">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 product-entry">
              <div class="categories">Denim collection</div>
              <h3 class="item-title">The casual selection.</h3>
              <p>Our distinct selection offers timeless pieces that embody comfort and sophistication, perfect for your everyday adventures.</p>
              <div class="btn-wrap">
                <a href="shop.php" class="d-flex align-items-center">shop collection <i class="icon icon-arrow-io"></i>
                </a>
              </div>
            </div>
          </div>
        </div>        
      </div>
    </section>

    <section id="quotation" class="align-center padding-large">
      <div class="inner-content">
        <h2 class="section-title divider">Quote of the day</h2>
        <blockquote>
          <q>It's true, I don't like the whole cutoff-shorts-and-T-shirt look, but I think you can look fantastic in casual clothes.</q>
          <div class="author-name">- Dr. Seuss</div>
        </blockquote>
      </div>
    </section>

    <hr>
    <section id="latest-blog" class="padding-large">
      <div class="container">
        <div class="section-header d-flex flex-wrap align-items-center justify-content-between">
          <h2 class="section-title">our Journal</h2>
          <div class="btn-wrap align-right">
            <a href="blog.php" class="d-flex align-items-center">Read All Articles <i class="icon icon icon-arrow-io"></i>
            </a>
          </div>
        </div>
        <div class="row d-flex flex-wrap">
          <article class="col-md-4 post-item">
            <div class="image-holder zoom-effect">
              <a href="single-post.php">
                <img src="images/post-img1.jpg" alt="post" class="post-image">
              </a>
            </div>
            <div class="post-content d-flex">
              <div class="meta-date">
                <div class="meta-day text-primary">22</div>
                <div class="meta-month">Aug-2021</div>
              </div>
              <div class="post-header">
                <h3 class="post-title">
                  <a href="single-post.php">top 10 casual look ideas to dress up your kids</a>
                </h3>
                <a href="blog.php" class="blog-categories">Fashion</a>
              </div>
            </div>
          </article>
          <article class="col-md-4 post-item">
            <div class="image-holder zoom-effect">
              <a href="single-post.php">
                <img src="images/post-img2.jpg" alt="post" class="post-image">
              </a>
            </div>
            <div class="post-content d-flex">
              <div class="meta-date">
                <div class="meta-day text-primary">25</div>
                <div class="meta-month">Aug-2021</div>
              </div>
              <div class="post-header">
                <h3 class="post-title">
                  <a href="single-post.php">Latest trends of wearing street wears supremely</a>
                </h3>
                <a href="blog.php" class="blog-categories">Trending</a>
              </div>
            </div>
          </article>
          <article class="col-md-4 post-item">
            <div class="image-holder zoom-effect">
              <a href="single-post.php">
                <img src="images/post-img3.jpg" alt="post" class="post-image">
              </a>
            </div>
            <div class="post-content d-flex">
              <div class="meta-date">
                <div class="meta-day text-primary">28</div>
                <div class="meta-month">Aug-2021</div>
              </div>
              <div class="post-header">
                <h3 class="post-title">
                  <a href="single-post.php">types of comfortable clothes ideas for women</a>
                </h3>
                <a href="blog.php" class="blog-categories">Inspiration</a>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <section id="brand-collection" class="padding-medium bg-light-grey">
      <div class="container">
        <div class="d-flex flex-wrap justify-content-between">
          <img src="images/brand1.png" alt="phone" class="brand-image">
          <img src="images/brand2.png" alt="phone" class="brand-image">
          <img src="images/brand3.png" alt="phone" class="brand-image">
          <img src="images/brand4.png" alt="phone" class="brand-image">
          <img src="images/brand5.png" alt="phone" class="brand-image">
        </div>
      </div>
    </section>

    <section id="instagram" class="padding-large">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Follow our instagram</h2>
        </div>
        <p>Our official Instagram account <a href="#">@ultras</a> or <a href="#">#ultras_clothing</a>
        </p>
        <div class="row d-flex flex-wrap justify-content-between">
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img src="images/insta-image1.jpg" alt="instagram" class="insta-image">
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img src="images/insta-image2.jpg" alt="instagram" class="insta-image">
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img src="images/insta-image3.jpg" alt="instagram" class="insta-image">
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img src="images/insta-image4.jpg" alt="instagram" class="insta-image">
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img src="images/insta-image5.jpg" alt="instagram" class="insta-image">
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img src="images/insta-image6.jpg" alt="instagram" class="insta-image">
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
        </div>          
      </div>
    </section>

    <section id="shipping-information">
      <hr>
      <div class="container">
        <div class="row d-flex flex-wrap align-items-center justify-content-between">
          <div class="col-md-3 col-sm-6">
            <div class="icon-box">
              <i class="icon icon-truck"></i>
              <h4 class="block-title">
                <strong>Free shipping</strong> Over ₹2000
              </h4>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="icon-box">
              <i class="icon icon-return"></i>
              <h4 class="block-title">
                <strong>Money back</strong> Return within 7 days
              </h4>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="icon-box">
              <i class="icon icon-tags1"></i>
              <h4 class="block-title">
                <strong>Buy 4 get 5th</strong> 50% off
              </h4>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="icon-box">
              <i class="icon icon-help_outline"></i>
              <h4 class="block-title">
                <strong>Any questions?</strong> experts are ready
              </h4>
            </div>
          </div>
        </div>
      </div>
      <hr>
    </section>

<?php include 'footer.php'; ?>
