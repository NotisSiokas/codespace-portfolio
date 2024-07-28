<?php
// File: views/product.php

// Include essential header, navigation, and header elements
include 'head.php';
include 'navbar.php';
include 'header.php';

// Error handling: Check if a product ID is provided
if (!isset($_GET['id'])) {
    echo "<p class='text-danger'>Product not found.</p>";
    include 'footer.php';
    exit();
}

$productId = $_GET['id'];

?>

<script>
  // Fetch product data from API
  fetch('/api/products/<?php echo $productId; ?>')
    .then(response => response.json())
    .then(data => {
      if (data.error) {
        // Handle error (e.g., display an error message)
        document.getElementById('product-details').innerHTML = '<p class="text-danger">' + data.error + '</p>';
      } else {
        // Display product details
        displayProduct(data);
      }
    });

  function displayProduct(product) {
    const productDetailsDiv = document.getElementById('product-details');

    // Create image element
    const img = document.createElement('img');
    img.src = product.image_url;
    img.alt = product.name;
    img.classList.add('card-img-top', 'mb-5', 'mb-md-0');
    productDetailsDiv.appendChild(img);

    // Create details section
    const detailsDiv = document.createElement('div');
    detailsDiv.classList.add('col-md-6');
    detailsDiv.innerHTML = `
      <h1 class="display-5 fw-bolder">${product.name}</h1>
      <div class="fs-5 mb-5">
        <span>$${product.price}</span>
      </div>
      <p class="lead">${product.description}</p>
      <div class="d-flex">
        <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
        <button class="btn btn-outline-dark flex-shrink-0" onclick="addToCart(${product.id})"> 
            <i class="bi-cart-fill me-1"></i>
            Add to cart
        </button>
      </div>
    `;
    productDetailsDiv.appendChild(detailsDiv);
  }

  function addToCart(productId) {
    const quantity = document.getElementById('inputQuantity').value;
    // Implement your add-to-cart logic using the API
  }
</script>

<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center" id="product-details">
            </div>
    </div>
</section>

<?php
// Include footer
include 'footer.php';
?>
