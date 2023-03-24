<?php view('partials/head.view.php'); ?>
<?php view('partials/nav.view.php'); ?>

<body>
    <main>
        <section class="section-container">
            <h1>Welcome
                <?= $currentUser->getFirstname(); ?>.
            </h1>
            <h2>Here are your messages.</h2>

            <?php

            $messages = $currentUser->getMyRecievedMessages();

            $counter = 1;

            foreach ($messages as $message): ?>
                <ul class="message <?= $counter % 2 ? 'justify-left red-background' : 'justify-right green-background' ?>">
                    <?= $message->printMessage()
                    . '<br><span class="justify-right">-'
                    . $message->sender
                    . '</span>' ?>
                </ul>

                <?php $counter++;
            endforeach; ?>

        </section>

    </main>
</body>

<?php view('partials/foot.view.php'); ?>