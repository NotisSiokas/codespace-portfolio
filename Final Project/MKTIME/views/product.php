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
  }

  .product-variation-image.not-clickable {
    cursor: default; /* Make the image appear non-clickable */
    opacity: 0.5; /* Optionally, you can use opacity to visually distinguish it */
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

  // Function to fetch product details from the API
  async function fetchProductData(productId) {
    try {
      const response = await fetch(`/api/products/${productId}`);
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      const product = await response.json();
      console.log('Product:', product); // Log product data
      return product;
    } catch (error) {
      console.error('There was a problem with the fetch operation:', error);
      return null;
    }
  }

  // Function to fetch related products (color variations) from the API
  async function fetchRelatedProducts(productId) {
    try {
      const response = await fetch(`/api/products/${productId}/related`);
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      const relatedProducts = await response.json();
      console.log('Related Products:', relatedProducts); // Log related products
      return Array.isArray(relatedProducts.related_products) ? relatedProducts.related_products : []; // Ensure it's an array
    } catch (error) {
      console.error('There was a problem with the fetch operation:', error);
      return []; // Return empty array in case of error
    }
  }

  // Initialize the page
  async function initializePage() {
    const product = await fetchProductData(productId);
    const relatedProducts = await fetchRelatedProducts(productId);

    if (!product) {
      document.getElementById('product-details').innerHTML = '<p class="text-danger">Product not found.</p>';
    } else {
      displayProduct(product, relatedProducts);
    }
  }

  // Function to display the product details and color variations
  function displayProduct(product, relatedProducts) {
    const productDetailsDiv = document.getElementById('product-details');
    productDetailsDiv.innerHTML = ''; // Clear previous content

    // Create container for product image and details
    const containerDiv = document.createElement('div');
    containerDiv.classList.add('product-container');

    // Create product image element
    const mainImg = document.createElement('img');
    mainImg.src = `/assets/images/${product.image_url}`;
    mainImg.alt = product.name;
    mainImg.classList.add('product-image', 'card-img-top', 'mb-5', 'mb-md-0');

    // Create details section
    const detailsDiv = document.createElement('div');
    detailsDiv.classList.add('product-details');
    
    // Set the inner HTML for product details and variations
    detailsDiv.innerHTML = `
      <h1 class="display-5 fw-bolder">${product.name}</h1>
      <div class="fs-5 mb-5">
        <span>$${product.price}</span>
      </div>
      <p class="lead">${product.description}</p>
      <div id="product-variations" class="mt-3"></div>
      <div class="d-flex">
        <input class="form-control text-center me-3" id="inputQuantity" type="number" value="1" style="max-width: 3rem" />
        <button class="btn btn-outline-dark flex-shrink-0" onclick="addToCart(${product.id})"> 
            <i class="bi-cart-fill me-1"></i>
            Add to cart
        </button>
      </div>
    `;

    // Append image and details containers to the main container
    containerDiv.appendChild(mainImg);
    containerDiv.appendChild(detailsDiv);

    // Append the main container to the product details div
    productDetailsDiv.appendChild(containerDiv);

    // Create and append related product images to the product-variations div
    const variationsDiv = detailsDiv.querySelector('#product-variations');
    if (Array.isArray(relatedProducts)) {
      // Create and append the current product image first
      const currentProductImg = document.createElement('img');
      currentProductImg.src = `/assets/images/${product.image_url}`;
      currentProductImg.alt = product.name;
      currentProductImg.classList.add('current-product-image', 'not-clickable'); // Make it non-clickable
      variationsDiv.appendChild(currentProductImg);

      // Add related products images
      relatedProducts.forEach(relatedProduct => {
        const variationImg = document.createElement('img');
        variationImg.src = `/assets/images/${relatedProduct.image_url}`;
        variationImg.alt = relatedProduct.name;
        variationImg.classList.add('product-variation-image');
        variationImg.dataset.productId = relatedProduct.id;
        if (relatedProduct.id === product.id) {
          variationImg.classList.add('not-clickable'); // Make the current product image non-clickable
        } else {
          variationImg.addEventListener('click', () => {
            window.location.href = `product.php?id=${relatedProduct.id}`;
          });
        }
        variationsDiv.appendChild(variationImg);
      });
    } else {
      console.error('Related products data is not an array:', relatedProducts);
    }
  }

  // Function to add to cart (implementation needed)
  function addToCart(productId) {
    const quantity = document.getElementById('inputQuantity').value;
    // Implement your add-to-cart logic using the API
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
