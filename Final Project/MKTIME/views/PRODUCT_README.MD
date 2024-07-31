# MKTIME E-commerce - Product Details Page (`product.php`)

## Overview

This page (`product.php`) is responsible for displaying detailed information about a single product in the MKTIME e-commerce website. It leverages both PHP and JavaScript to fetch and dynamically render product data, including images, descriptions, prices, and color variations.

## Features

- **Single Product Display:** Fetches and displays comprehensive details of a specific product, including its name, description, price, and main image.
- **Color Variations:** 
    - Fetches related products (different color variations) from the API.
    - Displays these variations as smaller, clickable images below the main product image.
- **Dynamic Updates:** 
    - Uses AJAX (Asynchronous JavaScript and XML) to fetch product data and update the page content without full page reloads, enhancing the user experience.
    - When a color variation image is clicked, the page dynamically updates the main product image, name, price, and description to reflect the selected variation.
    - The URL is also updated to reflect the selected product ID, using the History API to maintain a seamless browsing experience.

## How It Works

1. **Load Product Details:** When the page loads, the JavaScript code fetches the main product's details from the API endpoint `/api/products/{productId}`. It also fetches related products (variations) from `/api/products/{productId}/related`.

2. **Render Main Product:**  The `displayProduct` function creates the HTML elements to display the main product's image, name, price, and description.

3. **Display Variations:** The `displayVariations` function creates image links for each color variation and appends them to the `product-variations` section on the page.

4. **Dynamic Update on Click:** When a variation image is clicked, the `changeProductImage` function fetches the details of the selected variation and updates the main product image, name, price, and description accordingly. The `updateProductDetails` function also fetches the new related products for the selected variation and re-renders the variation images.


## Technologies Used

- **PHP:** Server-side scripting for basic page structure and API interaction.
- **JavaScript:** Dynamic content fetching and updating, event handling, and DOM manipulation.
- **HTML/CSS:** Page layout and styling.
- **Bootstrap (optional):**  CSS framework for styling (if used in your project).
- **Fetch API:** JavaScript API for making asynchronous HTTP requests to your API.

## How to Use (For Developers)

1. **Prerequisites:** Ensure that your PHP server and API are running correctly.
2. **Open Product Page:** Navigate to `http://localhost:3000/views/product.php?id={productId}`, replacing `{productId}` with the ID of the product you want to view.
3. **View Variations:** Click on the variation images to dynamically switch between different color options.

## Additional Notes

- **API Endpoints:**  The `product.php` page relies on the following API endpoints:
    - `/api/products/{productId}`: Returns the details of a single product.
    - `/api/products/{productId}/related`: Returns related products (variations).
- **Error Handling:**  The JavaScript code includes basic error handling to display a message if the product data cannot be fetched or if an error occurs during the API request.

Feel free to customize and expand this README based on the specific details and features of your implementation.
