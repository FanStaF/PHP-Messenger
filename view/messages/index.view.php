<?php view('partials/head.view.php'); ?>
<?php view('partials/nav.view.php'); ?>

<body>
    <main>
        <h1>Welcome <?= $currentUser->getFirstname(); ?>.</h1>
        <h2>Here are your messages.</h2>

        <section class="message-container">
            <?php

            $messages = $currentUser->getMyRecievedMessages();

            $counter = 1;

            foreach ($messages as $message): ?>
                <ul class="message <?= $counter % 2 ? 'justify-left' : 'justify-right' ?>">
                    <?= $message->printMessage() . ' -' . $message->sender ?>
                </ul>

                <?php $counter++;
            endforeach; ?>

        </section>

    </main>
</body>

<?php view('partials/foot.view.php'); ?>