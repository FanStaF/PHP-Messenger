<?php view('partials/head.view.php');
use Core\User; ?>
<?php view('partials/nav.view.php'); ?>

<body>
    <main>
        <section class="section-container">
            <form action="/messages" method="POST" class="input-form">
                <input type="hidden" name="_method" value="PUT">
                <h1>New Message</h1>

                <div>

                    <label for="messageTo">Send message to:</label>
                    <select name="messageTo" id="messageTo">
                        <?php $currentUser = new User($_SESSION['user']);
                    
                        foreach ($currentUser->myFriends->friendsIDList as $friend) {
                            echo "<option value='{$friend}'>{$currentUser->myFriends->getFriendName($friend)}</option>}";
                        }
                        ?>

                    </select>
                </div>

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