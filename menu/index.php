<?php
global $product_name, $price;
session_start();
include('../config.php');

if (isset($_SESSION['user_name']))
{
  $user_name = $_SESSION['user_name'];
  $user_id = $_SESSION['user_id'];
}
?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/styles.css">
     <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
 <!--     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <title>SBS - AI</title>
  <style>
    body { margin:0; font-family: Arial, sans-serif; }
    main { padding:20px; min-height:100vh; }

    .content-section { margin-top:80px;display:none; }
    .content-section.active { display:block; }

    /* bottom nav */
    .bottom-nav {
      position:fixed; left:0; right:0; bottom:0;
      display:flex; justify-content:space-around;
     background:#fff;
      padding:8px 0;
    }
    .bottom-nav__link {
      flex:1; text-align:center; text-decoration:none; color:#666;
    }
    .bottom-nav__link i { display:block; font-size:20px; }
    .bottom-nav__link.active { color:#2563eb; }
  </style>
    </head>
    <body>
        <!--=============== HEADER ===============-->
        <header class="header">
            <nav class="nav container">
                <div class="nav__data">
                    <a href="#" class="nav__logo">
                    SBS - AI
                    </a>
    
                    <div class="nav__toggle" id="nav-toggle">
                        <i class="ri-menu-line nav__toggle-menu"></i>
                        <i class="ri-close-line nav__toggle-close"></i>
                    </div>
                </div>

                <!--=============== NAV MENU ===============-->
                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li>
                            <a href="#" class="nav__link">AI</a>
                        </li>

                        <!--=============== DROPDOWN 1 ===============-->
                        <li class="dropdown__item">                      
                            <div class="nav__link dropdown__button">
                                Projects <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                            </div>

                            <div class="dropdown__container">
                                <div class="dropdown__content">
                                    <div class="dropdown__group">
                                        <div class="dropdown__icon">
                                            <i class="ri-flashlight-line"></i>
                                        </div>
    
                                        <span class="dropdown__title">Most viewed courses</span>
    
                                        <ul class="dropdown__list">
                                            <li>
                                                <a href="#" class="dropdown__link">HTML for beginners</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown__link">Advanced CSS</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown__link">JavaScript OOP</a>
                                            </li>
                                        </ul>
                                    </div>
    
                                    <div class="dropdown__group">
                                        <div class="dropdown__icon">
                                            <i class="ri-heart-3-line"></i>
                                        </div>
    
                                        <span class="dropdown__title">Popular courses</span>
    
                                        <ul class="dropdown__list">
                                            <li>
                                                <a href="#" class="dropdown__link">Development with Flutter</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown__link">Web development with React</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown__link">Backend development expert</a>
                                            </li>
                                        </ul>
                                    </div>
    
                                    <div class="dropdown__group">
                                        <div class="dropdown__icon">
                                            <i class="ri-book-mark-line"></i>
                                        </div>
    
                                        <span class="dropdown__title">Careers</span>
    
                                        <ul class="dropdown__list">
                                            <li>
                                                <a href="#" class="dropdown__link">Web development</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown__link">Applications development</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown__link">UI/UX design</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown__link">Informatic security</a>
                                            </li>
                                        </ul>
                                    </div>
    
                                    <div class="dropdown__group">
                                        <div class="dropdown__icon">
                                            <i class="ri-file-paper-2-line"></i>
                                        </div>
    
                                        <span class="dropdown__title">Certifications</span>
    
                                        <ul class="dropdown__list">
                                            <li>
                                                <a href="#" class="dropdown__link">Course certificates</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown__link">Free certifications</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!--=============== DROPDOWN 2 ===============-->
                        <li class="dropdown__item">
                            <div class="nav__link dropdown__button">
                                Products <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                            </div>

                            <div class="dropdown__container">
                                <div class="dropdown__content">
                                    <div class="dropdown__group">
                                        <div class="dropdown__icon">
                                            <i class="ri-code-line"></i>
                                        </div>
    
                                        <span class="dropdown__title">Web templates</span>
    
                                        <ul class="dropdown__list">
                                            <li>
                                                <a href="#" class="dropdown__link">Free templates</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown__link">Premium templates</a>
                                            </li>
                                        </ul>
                                    </div>
    
                                    <div class="dropdown__group">
                                        <div class="dropdown__icon">
                                            <i class="ri-pen-nib-line"></i>
                                        </div>
    
                                        <span class="dropdown__title">Designs</span>
    
                                        <ul class="dropdown__list">
                                            <li>
                                                <a href="#" class="dropdown__link">Web designs</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown__link">App designs</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown__link">Component design</a>
                                            </li>
                                        </ul>
                                    </div>
    
                                    <div class="dropdown__group">
                                        <div class="dropdown__icon">
                                            <i class="ri-apps-2-line"></i>
                                        </div>
    
                                        <span class="dropdown__title">Others</span>
    
                                        <ul class="dropdown__list">
                                            <li>
                                                <a href="#" class="dropdown__link">Recent blogs</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown__link">Tutorial videos</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown__link">Webinar</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <a href="#pricing" class="nav__link">Courses</a>
                        </li>

                        <!--=============== DROPDOWN 3 ===============-->
                        <li class="dropdown__item">                        
                            <div class="nav__link dropdown__button">
                                Contact <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                            </div>

                            <div class="dropdown__container">
                                <div class="dropdown__content">
                                    <div class="dropdown__group">
                                        <div class="dropdown__icon">
                                            <i class="ri-community-line"></i>
                                        </div>
    
                                        <span class="dropdown__title">About us</span>
    
                                        <ul class="dropdown__list">
                                            <li>
                                                <a href="#" class="dropdown__link">About us</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown__link">Support</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown__link">Contact us</a>
                                            </li>
                                        </ul>
                                    </div>
    
                                    <div class="dropdown__group">
                                        <div class="dropdown__icon">
                                            <i class="ri-shield-line"></i>
                                        </div>
    
                                        <span class="dropdown__title">Safety and quality</span>
    
                                        <ul class="dropdown__list">
                                            <li>
                                                <a href="#" class="dropdown__link">Cookie settings</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown__link">Privacy Policy</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
<!--=============== PRICING SECTION ===============-->
<main>
  <section id="home" class="content-section active">
    <h2>Home</h2>
    <p>Welcome to the Home section</p>
  </section>

  <section id="projects" class="content-section">
    <h2>Projects</h2>
    <p>Here are our products.</p>
  </section>

  <section id="products" class="content-section">
 
  <div class="form-container">
    <h2>Products</h2>

<?php
$id = '';
$image_path = '';
// Use a prepared statement for fetching products
$stmt = $GLOBALS['con']->prepare("SELECT id, product_name, price, image_path FROM products");
$stmt->execute();

$stmt->bind_result($id, $product_name, $price, $image_path);

while ($stmt->fetch()) {
    ?>
    <div style="
        display: inline-block;
        width: 200px;
        padding: 10px;
        margin: 10px;
        border: 1px solid #ccc;
        text-align: center;
        border-radius: 5px;
    ">
        <form action="../sbspay/pay.php" method="post">
        <!-- Product Image -->
        <img src="<?php echo htmlspecialchars($image_path); ?>"
             alt="<?php echo htmlspecialchars($product_name); ?>"
             style="width: 100%; height: 150px; ">

        <!-- Product Name -->
        <h4><?php echo htmlspecialchars($product_name); ?></h4>
        <h5><?php echo htmlspecialchars($price); ?></h5>
        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($id); ?>">
        <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">
        <!-- Separate Button -->
        <button style="
            background: #28a745;
            color: #fff;
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            border-radius: 3px;">
            Proceed to Pay
        </button>
      </form>
    </div>
    <?php
}
$stmt->close();
?>
  </div>
  </section>


  <section id="wallet" class="content-section">
  <?php include('wallet.php'); ?>
  </section>

</main>


<!--=============== BOTTOM NAVIGATION ===============-->
<nav class="bottom-nav">
  <a href="#home" class="bottom-nav__link active">
    <i class="ri-home-line"></i><span>Home</span>
  </a>
  <a href="#projects" class="bottom-nav__link">
    <i class="ri-search-line"></i><span>Projects</span>
  </a>
  <a href="#products" class="bottom-nav__link">
    <i class="ri-bookmark-line"></i><span>Products</span>
  </a>
  <a href="#wallet" class="bottom-nav__link">
    <i class="ri-wallet-line"></i><span>Wallet</span>
  </a>
</nav>

<script>
  const navLinks = document.querySelectorAll('.bottom-nav__link');
  const sections = document.querySelectorAll('.content-section');

  navLinks.forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();

      // remove active from all
      navLinks.forEach(l => l.classList.remove('active'));
      sections.forEach(s => s.classList.remove('active'));

      // add active to clicked
      link.classList.add('active');
      const target = link.getAttribute('href').substring(1);
      document.getElementById(target).classList.add('active');
    });
  });
</script>
        
    <!--=============== MAIN JS ===============-->
    <script src="../assets/js/main.js"></script>
   </body>
</html>