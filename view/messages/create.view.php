<?php view('partials/head.view.php'); ?>
<?php view('partials/nav.view.php'); ?>

<body>
    <main>
        <section>
            <form action="/messages" method="POST" class="input-form">
                <h1>New Message</h1>

                <textarea type="text" rows="5" name="message" placeholder="Write a message"
                    class="message-textarea"></textarea>

                <button type="submit">Send</button>
                <?php if (isset($messages)) {
                    echo '<p class="errors">';
                    foreach ($messages as $error) {
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