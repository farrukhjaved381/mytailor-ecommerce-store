<body>
  <!-- Navbar start -->
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="index.php">&nbsp;&nbsp;My Tailor</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
      </ul>
      <?php
            include ($_SERVER['DOCUMENT_ROOT'] . "/myweb/mera-darzi/helper.php");

            if (is_loggged_in()) {
                $user_info_arr = wpent_get_current_user();
                ?>
                <div style="border: 1px solid black;margin-left:5px;padding:5px" class="btn login-btn">Username:
                    <?php echo $user_info_arr["user_fields"]['username']; ?>
                </div>
                <a href="/myweb/mera-darzi/logout.php">
                    <button class="btn btn-outline-dark login-btn">
                        Logout
                    </button>
                </a>
                <?php
            } else { ?>
                <a href="login.php">
                    <button class="btn btn-outline-dark login-btn">
                        Login
                    </button>
                </a>
                <?php
            }
            ?>
    </div>
  </nav>
  <!-- Navbar end -->
