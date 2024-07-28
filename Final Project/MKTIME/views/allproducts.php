<?php
// File: views/allproducts.php

// Include essential header, navigation, and header elements
include 'head.php';
include 'navbar.php';
include 'header.php';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<section class="py-5">
  <div class="container px-4 px-lg-5 mt-5">
    <h2 class="fw-bolder mb-4 text-center">All Products</h2>
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" id="product-list">
      </div>
  </div>
</section>

<script>
  // Fetch product data from API
  fetch('/api/products')
    .then(response => response.json())
    .then(data => {
      if (data.error) {
        // Handle the error, e.g., display an error message
        document.getElementById('product-list').innerHTML = '<p class="text-danger">' + data.error + '</p>';
      } else {
        displayProducts(data.products);
      }
    })
    .catch(error => {
      console.error('Error fetching products:', error);
      // Handle the error (display a generic error message, etc.)
    });

  function displayProducts(products) {
    const productList = document.getElementById('product-list');
    productList.innerHTML = ''; // Clear existing content

    products.forEach(product => {
      const productDiv = document.createElement('div');
      productDiv.classList.add('col', 'mb-5');

      const imageUrl = `/assets/images/${product.image_url}`;  // Construct the correct image URL
      
      productDiv.innerHTML = `
        <div class="card h-100">
            <img src="${imageUrl}" class="card-img-top" alt="${product.name}">
          <div class="card-body p-4">
            <div class="text-center">
              <h5 class="fw-bolder">${product.name}</h5>
              <p class="card-text">${product.description}</p>
              $${product.price}
            </div>
          </div>
          <div class="card-footer text-muted">
            <a href="../functions/added.php?id=${product.id}" class="btn btn-light btn-block">Add to Cart</a>
            <a href="product.php?id=${product.id}" class="btn btn-light btn-block">View Details</a>
          </div>
        </div>
      `;
      productList.appendChild(productDiv);
    });
  }
</script>

<?php include 'footer.php'; ?>
