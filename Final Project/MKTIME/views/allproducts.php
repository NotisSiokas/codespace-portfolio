<?php
// File: views/allproducts.php

// Include essential files
include 'head.php';
include 'header.php';
include 'navbar.php';
?>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4 text-center">All Products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col mb-5">
                        <div class="card h-100">

                            <img class="card-img-top"
                                 src="<?= htmlspecialchars($product['image_url']); ?>"
                                 alt="<?= htmlspecialchars($product['name']); ?>">

                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder"><?= htmlspecialchars($product['name']); ?></h5>

                                    $<?= number_format($product['price'], 2); ?>
                                </div>
                            </div>

                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto"
                                       href="product.php?id=<?= $product['id']; ?>">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="col-12 text-center">
                    <p>No products available at the moment.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>


<?php include 'footer.php'; ?>
