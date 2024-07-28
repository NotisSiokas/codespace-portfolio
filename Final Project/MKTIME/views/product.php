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
</style>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Define the product variations
    const productVariations = [
      {
        id: 34,
        name: 'Red Watch',
        price: 100,
        description: 'This is the red watch description.',
        image_url: 'watchRed.jpg'
      },
      {
        id: 35,
        name: 'Green Watch',
        price: 100,
        description: 'This is the green watch description.',
        image_url: 'watchGreen.jpg'
      },
      {
        id: 36,
        name: 'Blue Watch',
        price: 100,
        description: 'This is the blue watch description.',
        image_url: 'watchBlue.jpg'
      }
    ];

    // Get the current product based on the product ID from URL
    const urlParams = new URLSearchParams(window.location.search);
    const productId = parseInt(urlParams.get('id')); // Get the product ID from the URL

    console.log('Product ID from URL:', productId); // Debugging

    // Find the current product from the variations list
    const currentProduct = productVariations.find(product => product.id === productId);
    console.log('Current Product:', currentProduct); // Debugging

    if (!currentProduct) {
      document.getElementById('product-details').innerHTML = '<p class="text-danger">Product not found.</p>';
    } else {
      // Display the current product details
      displayProduct(currentProduct);
      // Display the product variations
      displayVariations(currentProduct);
    }

    // Function to display the product details
    function displayProduct(product) {
      const productDetailsDiv = document.getElementById('product-details');
      productDetailsDiv.innerHTML = ''; // Clear previous content
      productDetailsDiv.classList.add('d-flex'); // Add Flexbox class to the parent container

      console.log('Displaying Product:', product); // Debugging

      // Create image element
      const img = document.createElement('img');
      img.src = `/assets/images/${product.image_url}`;
      img.alt = product.name;
      img.classList.add('product-image', 'card-img-top', 'mb-5', 'mb-md-0');
      productDetailsDiv.appendChild(img);

      // Create details section
      const detailsDiv = document.createElement('div');
      detailsDiv.classList.add('col-md-6');
      detailsDiv.style.alignSelf = "flex-start";
      detailsDiv.innerHTML = `
        <h1 class="display-5 fw-bolder">${product.name}</h1>
        <div class="fs-5 mb-5">
          <span>$${product.price}</span>
        </div>
        <p class="lead">${product.description}</p>
        <div id="product-variations" class="mt-3"></div>
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

    // Function to display the product variations
    function displayVariations(currentProduct) {
      const variationsDiv = document.getElementById('product-variations');
      variationsDiv.innerHTML = ''; // Clear previous variations

      console.log('Displaying Variations for Product:', currentProduct); // Debugging

      productVariations.forEach(variation => {
        if (variation.id !== currentProduct.id) {
          const variationLink = document.createElement('a');
          variationLink.addEventListener('click', () => changeProductVariation(variation.id));

          const variationImg = document.createElement('img');
          variationImg.src = `/assets/images/${variation.image_url}`;
          variationImg.alt = variation.name;
          variationImg.classList.add('product-variation-image');

          variationLink.appendChild(variationImg);
          variationsDiv.appendChild(variationLink);
        }
      });
    }

    // Function to change the product variation
    function changeProductVariation(variationId) {
      const variation = productVariations.find(v => v.id === variationId);
      if (variation) {
        console.log('Changing to Variation:', variation); // Debugging
        displayProduct(variation);
        displayVariations(variation);
      }
    }

    function addToCart(productId) {
      const quantity = document.getElementById('inputQuantity').value;
      // Implement your add-to-cart logic using the API
    }
  });
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
