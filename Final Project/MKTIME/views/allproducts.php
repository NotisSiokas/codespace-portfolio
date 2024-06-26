<?php
// File: views/allproducts.php

// Include essential header, navigation, and header elements
global $link; // database connection accessible globally
include 'head.php';
include 'navbar.php';
include 'header.php';

// Include Bootstrap icons for visual styling
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />';

// Establish database connection
require '../connect_db.php';

// SQL query to fetch all products from the 'products' table
$q = "SELECT * FROM products";
$r = mysqli_query($link, $q);

// Checking if products were found
if (mysqli_num_rows($r) > 0): ?>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">

        <?php
        if (isset($_SESSION['success_msg']) && !empty($_SESSION['success_msg'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success_msg'] . '</div>';
            // Unset the message after displaying to avoid repetition
            unset($_SESSION['success_msg']);
        }
        ?>
            <h2 class="fw-bolder mb-4 text-center">All Products</h2>

            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                // Loop through each product retrieved from the database
                while ($product = mysqli_fetch_assoc($r)):

                    // Get product image details
                    $imageFileName = $product['image_url'];
                    $imagePath = __DIR__ . '/../assets/images/' . $imageFileName;
                    ?>

                    <div class="col mb-5">
                        <div class="card h-100">
                            <?php if (file_exists($imagePath)): ?>
                                <img src="/assets/images/<?= htmlspecialchars($imageFileName); ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']); ?>">
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

<?php
// If no products are found, display a message
else: ?>
    <div class="col-12 text-center">
        <p class="lead text-center">There are currently no items in the table to display.</p>
    </div>
<?php endif;

// Close the database connection
mysqli_close($link);

// Include footer
include 'footer.php';
?>
