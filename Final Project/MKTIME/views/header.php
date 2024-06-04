
<body>
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <?php if (isset($headerData)): ?>
                    <h1 class="display-4 fw-bolder"><?php echo $headerData['title']; ?></h1>
                    <p class="lead fw-normal text-white-50 mb-0"><?php echo $headerData['subtitle']; ?></p>
                <?php else: ?>
                    <h1 class="display-4 fw-bolder">MKTime,  now it's the time!</h1>
                    <p class="lead fw-normal text-white-50 mb-0">to buy some time..</p>
                <?php endif; ?>
            </div>
        </div>
    </header>
</body>

