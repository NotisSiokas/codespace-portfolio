<?php
// File: views/product.php

// Include essential header, navigation, and header elements
include 'head.php';
include 'navbar.php';

// Error handling: Check if a product ID is provided
if (!isset($_GET['id'])) {
    echo "<p class='text-danger'>Product not found.</p>";
    include 'footer.php';
    exit();
}

$productId = $_GET['id'];
?>

<style>
  /* CSS to control the image size */
  .product-image {
    max-width: 40%; 
    height: auto;  
  }

  .product-variation-image {
    width: 100px; /* Adjust the size as needed */
    height: auto;
    margin-right: 10px;
    margin-bottom: 20px; 
    cursor: pointer;
    opacity: 1; /* Default opacity */
  }

  .product-variation-image.not-clickable {
    cursor: default; /* Make the image appear non-clickable */
  }

  .product-variation-image.selected {
    opacity: 0.5; /* Lower opacity for the selected product image */
  }

  .product-container {
    display: flex;
    align-items: flex-start; /* Align items to the top */
  }

  .product-details {
    flex: 1; /* Take up the remaining space */
    padding-left: 20px; /* Space between image and details */
  }

  #product-variations {
    display: flex;
    gap: 10px; /* Space between images */
    align-items: center; /* Align images in the center */
  }

  .current-product-image {
    width: 100px; /* Size of the current product image */
    height: auto;
    margin-right: 10px;
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const productId = new URLSearchParams(window.location.search).get('id');

  if (!productId) {
    document.getElementById('product-details').innerHTML = '<p class="text-danger">Product not found.</p>';
    return;
  }

  async function fetchProductData(productId) {
    try {
      const response = await fetch(`/api/products/${productId}`);
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return await response.json();
    } catch (error) {
      console.error('There was a problem with the fetch operation:', error);
      return null;
    }
  }

  async function fetchRelatedProducts(productId) {
    try {
      const response = await fetch(`/api/products/${productId}/related`);
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return (await response.json()).related_products || [];
    } catch (error) {
      console.error('There was a problem with the fetch operation:', error);
      return [];
    }
  }

  async function initializePage() {
    const product = await fetchProductData(productId);
    const relatedProducts = await fetchRelatedProducts(productId);

    if (!product) {
      document.getElementById('product-details').innerHTML = '<p class="text-danger">Product not found.</p>';
    } else {
      displayProduct(product, relatedProducts);
    }
  }

  function displayProduct(product, relatedProducts) {
    const productDetailsDiv = document.getElementById('product-details');
    productDetailsDiv.innerHTML = '';

    const containerDiv = document.createElement('div');
    containerDiv.classList.add('product-container');

    const mainImg = document.createElement('img');
    mainImg.src = `/assets/images/${product.image_url}`;
    mainImg.alt = product.name;
    mainImg.classList.add('product-image', 'card-img-top', 'mb-5', 'mb-md-0');

    const detailsDiv = document.createElement('div');
    detailsDiv.classList.add('product-details');
    
    detailsDiv.innerHTML = `
      <h1 class="display-5 fw-bolder">${product.name}</h1>
      <div class="fs-5 mb-5">
        <span>$${product.price}</span>
      </div>
      <p class="lead">${product.description}</p>
      <div id="product-variations" class="mt-3"></div>
      <form action="../functions/added.php" method="get">
        <input type="hidden" name="id" value="${product.id}">
        <button type="submit" class="btn btn-outline-dark bi-cart-fill">
            Add to Cart
        </button>
      </form>
    `;

    containerDiv.appendChild(mainImg);
    containerDiv.appendChild(detailsDiv);
    productDetailsDiv.appendChild(containerDiv);

    const variationsDiv = detailsDiv.querySelector('#product-variations');
    if (Array.isArray(relatedProducts)) {
      const currentProductImg = document.createElement('img');
      currentProductImg.src = `/assets/images/${product.image_url}`;
      currentProductImg.alt = product.name;
      currentProductImg.classList.add('product-variation-image', 'current-product-image', 'not-clickable', 'selected');
      currentProductImg.dataset.productId = product.id; // Added data-product-id attribute for identification
      variationsDiv.appendChild(currentProductImg);

      relatedProducts.forEach(relatedProduct => {
        const variationImg = document.createElement('img');
        variationImg.src = `/assets/images/${relatedProduct.image_url}`;
        variationImg.alt = relatedProduct.name;
        variationImg.classList.add('product-variation-image');
        variationImg.dataset.productId = relatedProduct.id;
        variationImg.addEventListener('click', () => {
          updateProductDetails(relatedProduct.id);
        });
        variationsDiv.appendChild(variationImg);
      });
    }
  }

  async function updateProductDetails(productId) {
    const product = await fetchProductData(productId);
    const relatedProducts = await fetchRelatedProducts(productId);

    if (!product) {
      document.getElementById('product-details').innerHTML = '<p class="text-danger">Product not found.</p>';
    } else {
      displayProduct(product, relatedProducts);
      
      const newUrl = `/views/product.php?id=${productId}`;
      history.pushState(null, '', newUrl);

      document.querySelectorAll('.product-variation-image').forEach(img => {
        img.classList.remove('selected'); // Remove 'selected' class from all images
      });
      const newSelectedImg = document.querySelector(`.product-variation-image[data-product-id="${productId}"]`);
      if (newSelectedImg) {
        newSelectedImg.classList.add('selected'); // Add 'selected' class to the newly selected image
      }
    }
  }

  initializePage();
});
</script>

<section class="py-5">
  <div class="container px-4 px-lg-5 my-5">
    <div class="row gx-4 gx-lg-5 align-items-center" id="product-details">
      <!-- Product details will be loaded here -->
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
