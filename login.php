<?php
session_start();
ob_start();
include("connect.php");
include("functions.php");

// Verifica daca a fost trimis un formular de autentificare prin POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Verifica daca utilizatorul si parola nu sunt goale si numele de utilizator nu este numeric
    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        // Cauta utilizatorul in baza de date folosind numele de utilizator
        $query = "SELECT * FROM users WHERE user_name='$user_name' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            $hashed_password = $user_data['password'];

            // Verifica daca parola introdusa corespunde cu parola hashuita stocata in baza de date
            if (password_verify($password, $hashed_password)) {
                // Verifica daca caseta "Tine-ma minte" este bifata
                if (isset($_POST['remember_me'])) {
                    // Seteaza un cookie pentru a retine utilizatorul timp de 30 de zile (sau orice alta perioada dorita)
                    setcookie('remember_me', $user_data['id'], time() + (30 * 24 * 60 * 60));
                }

                // Seteaza sesiunea cu ID-ul si starea de administrator
                $_SESSION['user'] = $user_data['id'];
                $_SESSION['is_admin'] = $user_data['is_admin'];

                // Autentificare reusita, redirectioneaza catre pagina principala
                header("Location: home.php");
                exit;
            } else {
                echo '<span style="color:#AFA;text-align:center;">Wrong username or password</span>';
            }
        } else {
            echo '<span style="color:#AFA;text-align:center;">Wrong username or password</span>';
        }
    } else {
        echo '<span style="color:#AFA;text-align:center;">Wrong username or password</span>';
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <title>Login</title>
    <style>
        body {
            background-image: url('record.jpeg');
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #box {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        #text {
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
            width: 100%;
            margin-bottom: 10px;
            font-size: 16px;
        }

        #button {
            padding: 10px;
            width: 100%;
            color: white;
            background-color: lightblue;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        #button:hover {
            background-color: #0096c7;
        }

        #signup {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: #666;
            text-decoration: none;
        }

        #signup:hover {
            color: #444;
        }

        #reset_password {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: #666;
            text-decoration: none;
        }

        #reset_password:hover {
            color: #444;
        }

        #error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div id="box">
        <form method="post">
            <div style="font-size: 24px; margin-bottom: 20px;">Login</div>
            <input id="text" type="text" name="user_name" placeholder="Username">
            <input id="text" type="password" name="password" placeholder="Password">
            <label for="remember_me"><input type="checkbox" id="remember_me" name="remember_me"> Tine-ma minte</label>
            <input id="button" type="submit" value="Login">
            <a href="signup.php" id="signup">Signup</a>
            <a href="password_reset_request.php" id="reset_password">Resetare Parola</a> <!-- Link to Password Reset Request -->
            <div id="error">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    echo 'Wrong username or password';
                }
                ?>
            </div>
        </form>
    </div>
</body>
</html>
