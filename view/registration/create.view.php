<?php view('partials/head.view.php'); ?>
<?php view('partials/nav.view.php'); ?>

<body>
    <main>
        <section>
            <form action="/registration" method="POST" class="login-form">
                <h1>Register</h1>

                <label for="firstname">Firstname:</label>
                <input type="text" name="firstname" placeholder="Firstname" class="login-input">

                <label for="lastname">Lastname:</label>
                <input type="text" id="lastname" name="lastname" placeholder="Lastname" class="login-input">

                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Email" class="login-input">

                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password" class="login-input">

                <button type="submit">Register</button>
                <?php if (isset($messages)) {
                    echo '<p class="errors">';
                    foreach ($messages as $error) {
                        foreach ($error as $message) {
                            echo $message . '<br>';
                        }
                    }
                    echo '</p>';
                }
                ?>
            </form>
        </section>
    </main>
</body>

<?php view('partials/foot.view.php'); ?>