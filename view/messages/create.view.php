<?php view('partials/head.view.php'); ?>
<?php view('partials/nav.view.php'); ?>

<body>
    <main>
        <section>
            <form action="/messages" method="POST" class="input-form">
                <input type="hidden" name="_method" value="PUT">
                <h1>New Message</h1>

                <textarea type="text" rows="5" name="messageText" placeholder="Write a message"
                    class="message-textarea"></textarea>

                <button type="submit">Send</button>
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