<?php
// File: views/allproducts.php

// Include essential files
global $link;
include 'head.php';
include 'navbar.php';
include 'header.php';

// Ensure Bootstrap icons are included
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />';

// Database connection
require '../connect_db.php';

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
                            <?php if (file_exists($imagePath)): ?>
                                <img src="/MKTIME/assets/images/<?= htmlspecialchars($imageFileName); ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']); ?>">
                            <?php else: ?>
                                <img src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" class="card-img-top" alt="Image Not Found">
                            <?php endif; ?>

                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder"><?= htmlspecialchars($product['name']); ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($product['description']); ?></p>
                                    $<?= htmlspecialchars($product['price']); ?>
                                </div>
                            </div>

                            <div class="card-footer text-muted">
                                <a href="../functions/added.php?id=<?= $product['id']; ?>" class="btn btn-light btn-block">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php else: ?>
    <div class="col-12 text-center">
        <p class="lead text-center">There are currently no items in the table to display.</p>
    </div>
<?php endif; ?>

<?php
// Close the database connection
mysqli_close($link);

include 'footer.php';
?>
