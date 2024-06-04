<?php
// File: views/allproducts.php

// Include essential files
global $link;
include 'head.php';
include 'navbar.php';
include 'header.php';


// Ensure Bootstrap icons are included (add this line if not already present in head.php)
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />';

// Database connection (assuming connect_db.php is in the same directory)
require '../connect_db.php';

// Fetch products from the database
$q = "SELECT * FROM products";
$r = mysqli_query($link, $q);
?>
<?php
// File: views/allproducts.php

// ... (other includes and database connection)

// Fetch products from the database
$q = "SELECT * FROM products";
$r = mysqli_query($link, $q);

if (mysqli_num_rows($r) > 0): ?>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4 text-center">All Products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php while ($product = mysqli_fetch_assoc($r)):
                    $imageFileName = $product['image_url'];
                    $imagePath = __DIR__ . '/../assets/images/' . $imageFileName;
                    ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <?php if (isset($product['sale_price']) && $product['sale_price'] < $product['price']): ?>
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <?php endif; ?>

                            <?php if (file_exists($imagePath)): ?>
                                <img src="/MKTIME/assets/images/<?= htmlspecialchars($imageFileName); ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']); ?>">
                            <?php else: ?>
                                <img src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" class="card-img-top" alt="Image Not Found">
                            <?php endif; ?>

                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder"><?= htmlspecialchars($product['name']); ?></h5>
                                    <?php if (isset($product['sale_price']) && $product['sale_price'] < $product['price']): ?>
                                        <span class="text-muted text-decoration-line-through">$<?= htmlspecialchars($product['price']); ?></span> $<?= htmlspecialchars($product['sale_price']); ?>
                                    <?php else: ?>
                                        $<?= htmlspecialchars($product['price']); ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="?action=displaySingle&id=<?= htmlspecialchars($product['id']); ?>">View Product</a></div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php else: ?> <div class="col-12 text-center">
    <p class="lead text-center">There are currently no items in the table to display.</p>
</div>
<?php endif; ?>  // ... (Close the database connection and include footer)

<?php
// Close the database connection
mysqli_close($link);

include 'footer.php';
?>
