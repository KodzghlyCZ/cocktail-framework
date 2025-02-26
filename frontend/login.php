<?php
$title = 'Login';
include 'header.php'
?>

<div class="content login">
    <h2>Login</h2>
    <label for="token">Password</label>
    <input id='inputToken' type="text" name="token" placeholder="Type in your password" required>
    <input id='loginButton' type="submit" value="Přihlásit se">
    <div id="error-message" style="color: red;"></div>
    <div id="success-message" style="color: green;"></div>

    <p>Nemáte tiket? <a href="create-ticket.php">Vytvořit tiket</a></p>
    <p>Jste pověřený administrátor? <a href="admin-login.php">Přihlašte se jako administrátor</a></p>
</div>

<script src="config.js"></script>
<script src="api.js"></script>
<script>
    function login(data) {
        if (data.success === true) {
            document.getElementById('success-message').innerText = 'Přihlášení proběhlo v pořádku';
            window.location.href = `ticket.php?id=${data.data['id']}`
        } else {
            document.getElementById('error-message').innerText = data.error;
        }
    }
    document.getElementById('loginButton').addEventListener('click', function() {
        fetchAPI(
            'login.php',
            login, {
                token: document.getElementById('inputToken').value,
            }
        );
    });
</script>

<!-- Include the footer template -->
<?php include 'footer.php' ?>
