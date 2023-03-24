<?php view('partials/head.view.php'); ?>
<?php view('partials/nav.view.php'); ?>

<body>
    <main>
        <section class="section-container">
            
            <form action="/session" method="POST" class="login-form">
                <h1>Log In</h1>

                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Email" class="login-input">

                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password" class="login-input">

                <button type="submit">Log In</button>
                <?php if (isset($errors)) {
                    echo '<p class="errors">';
                    foreach ($errors as $error) {
                            echo $error . '<br>';
                    }
                    echo '</p>';
                }
                ?>
            </form>
        </section>
    </main>
</body>

<?php view('partials/foot.view.php'); ?>