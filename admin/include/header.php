
<?php
    $uri = $_SERVER['PHP_SELF'];
    $title = "";
    $route = "";
    switch($uri){
        case "/BK_Apple_Store/admin/index.php":
        case "/BK_Apple_Store":
            $route = "home";
            $title = "Admin | Home page";
            break;
        case "/BK_Apple_Store/admin/product_list.php":
            $route = "product_list";
            $title = "Admin | List of products";
            break;
        case "/BK_Apple_Store/admin/add_account.php":
            $title = "Admin | Add account";
            break;
        case "/BK_Apple_Store/admin/inbox.php":
            $route = "inbox";
            $title = "Admin | Inbox";
            break;
        case "/BK_Apple_Store/admin/product.php":
            $title = "Admin | Product";
            break;
        case "/BK_Apple_Store/admin/admin_info.php":
            $route = "admin_info";
            $title = "Admin | Admin info";
            break;
        case "/BK_Apple_Store/admin/edit_product.php":
            $title = "Admin | Edit product";
            break;
        case "/BK_Apple_Store/admin/user_order.php":
            $route = "user_order";
            $title = "Admin | Orders of Users";
            break;
        case "/BK_Apple_Store/admin/user_list.php":
            $title = "Admin | List of Users";
            $route = "user_list";
            break;
        case "/BK_Apple_Store/admin/add_product.php":
            $title = "Admin | Add product";
            break;
        case "/BK_Apple_Store/admin/user_order_detail.php":
            $title = "Admin | User order details";
            break;
    }


?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BK Apple Store chuyên cung cấp các sản phẩm Apple. BK Apple Store luôn đảm bảo chất lượng sản phẩm chính hãng, khuyến mãi tốt">
    <meta name="keywords" content="bk apple store, ipad, iphone, watch, macbook, mac, apple">
    <title>
        <?php
            echo $title;
        ?>
    </title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <script src="../assets/js/script.js" type="text/javascript"></script>
    <style>
        .rainbow-text {
	    font-family: Arial;
	    font-weight: bold;
	    font-size: 40px;
	    -webkit-text-stroke-width: 1px;
	    -webkit-text-fill-color: transparent;
        }
        .rainbow-text .block-line > span {
        	display: inline-block;
        }
    </style>
    <link rel="icon" href="../../assets/images/logo_apple_1.png">
</head>
<body>

<!-- scroll button -->
<!-- <div class="scroll-up-btn">
    <i class="fa fa-angle-up"></i>
</div> -->
<!-- navigation bar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-style">
    <div class="container mobile">
        <a class="navbar-brand" href="home" style="display: flex;">
            <img src="../assets/images/logo_apple_1.png" alt="logo" class="logo" style="width: 60px;">
            <div class="rainbow-text" style="text-align: center; margin: 5px 0px 0px 10px">
	            <span class="block-line"><span><span style="color:#ff0000;">B</span><span style="color:#ff8000;">K&nbsp;</span></span><span><span style="color:#ffff00;">A</span><span style="color:#80ff00;">p</span><span style="color:#00ff00;">p</span><span style="color:#00ff80;">l</span><span style="color:#00ffff;">e&nbsp;</span></span><span><span style="color:#007fff;">S</span><span style="color:#0000ff;">t</span><span style="color:#7f00ff;">o</span><span style="color:#ff00ff;">r</span><span style="color:#ff0080;">e</span></span></span>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="col-auto">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class=<?php echo $route == 'home'? "'nav-item active'": "nav-item" ?>>
                        <a class="nav-link" href="home">Home page<span class="sr-only">(current)</span></a>
                    </li>
                    <li class=<?php echo $route == 'product_list'? "'nav-item active'": "nav-item" ?>>
                        <a href="product-list" class="nav-link">
                            List of products
                        </a>
                    </li>
                    <li class=<?php echo $route == 'user_list'? "'nav-item active'": "nav-item" ?>>
                        <a href="user-list" class="nav-link">
                           List of Users
                        </a>
                    </li>
                    <li class=<?php echo $route == 'inbox'? "'nav-item active'": "nav-item" ?>>
                        <a href="inbox" class="nav-link">
                            <i class="fa fa-envelope"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo in_array($route, array('admin_info', 'user_order'))? "active" : "" ?>" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <?php echo $_SESSION['user']['userName'] ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item <?php echo $route == 'admin_info'? "active": "" ?>" href="admin-info">My profile</a>
                            <a class="dropdown-item <?php echo $route == 'user_order'? "active": "" ?>" href="user-order">Orders of Users</a>
                            <a class="dropdown-item" href="../core/auth.php?logout=true">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>