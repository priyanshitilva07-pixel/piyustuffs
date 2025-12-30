<footer id="footer">
      <div class="container">
        <div class="footer-menu-list">
          <div class="row d-flex flex-wrap justify-content-between">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="footer-menu">
                <h5 class="widget-title">Ultras</h5>
                <ul class="menu-list list-unstyled">
                  <li class="menu-item">
                    <a href="about.php">About us</a>
                  </li>
                  <li class="menu-item">
                    <a href="#">Conditions </a>
                  </li>
                  <li class="menu-item">
                    <a href="blog.php">Our Journals</a>
                  </li>
                  <li class="menu-item">
                    
                  </li>
                  <li class="menu-item">
                    
                  </li>
                  <li class="menu-item">
                    <a href="#">Ultras Press</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="footer-menu">
                <h5 class="widget-title">Customer Service</h5>
                <ul class="menu-list list-unstyled">
                  <li class="menu-item">
                    <a href="faqs.php">FAQ</a>
                  </li>
                  <li class="menu-item">
                    <a href="contact.php">Contact</a>
                  </li>
                  <li class="menu-item">
                    <a href="#">Privacy Policy</a>
                  </li>
                  <li class="menu-item">
                    <a href="#">Returns & Refunds</a>
                  </li>
                  <li class="menu-item">
                    
                  </li>
                  <li class="menu-item">
                    <a href="#">Delivery Information</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="footer-menu">
                <h5 class="widget-title">Contact Us</h5>
                <p>Do you have any questions or suggestions? <a href="#" class="email">ourservices@ultras.com</a>
                </p>
                <p>Do you need assistance? Give us a call. <br>
                  <strong>+91 444 11 00 35</strong>
                </p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="footer-menu">
                <h5 class="widget-title">Forever 2018</h5>
                <p>Celebrating timeless style since 2018.We believe fashion is more than clothing -it's confidence,comfort,and individuality.Explore the wonderful collections only at our ultras. </p>
                <div class="social-links">
                  <ul class="d-flex list-unstyled">
                    <li>
                      <a href="#">
                        <i class="icon icon-facebook"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="icon icon-twitter"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="icon icon-youtube-play"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
    </footer>

    <div id="footer-bottom">
      <div class="container">
        <div class="d-flex align-items-center flex-wrap justify-content-between">
          <div class="copyright">
            <p> <a href="https://templatesjungle.com/"></a>  <a href="https://themewagon.com"></a>
            </p>
          </div>
          <div class="payment-method">
            <div class="card-wrap">
              
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/script.js"></script>
    <script>
      $(document).ready(function() {
        function updateTotals() {
          let subtotal = 0;
          $('#cart-items tr').each(function() {
            const price = parseFloat($(this).find('.quantity-input').data('price'));
            const quantity = parseInt($(this).find('.quantity-input').val());
            const itemTotal = price * quantity;
            $(this).find('.item-total').text('$' + itemTotal.toFixed(2));
            subtotal += itemTotal;
          });
          $('#subtotal').text('$' + subtotal.toFixed(2));
          $('#total').text('$' + subtotal.toFixed(2));
        }

        $('.quantity-input').on('change', function() {
          updateTotals();
        });

        $('form[action="cart.php"]').on('submit', function(e) {
          e.preventDefault();
          const form = $(this);
          $.ajax({
            type: 'POST',
            url: 'cart.php',
            data: form.serialize(),
            success: function() {
              form.closest('tr').remove();
              updateTotals();
            }
          });
        });
      });
    </script>
  </body>
</html>
