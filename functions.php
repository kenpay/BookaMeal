<?php



include("connect.php");





// functions.php



// ... alte funcții ...



// Funcție pentru a obține ID-ul utilizatorului pe baza numelui de utilizator

function get_user_id_by_username($con, $username) {

    $query = "SELECT id FROM users WHERE user_name = '$username' LIMIT 1";

    $result = mysqli_query($con, $query);

/*$query = "SELECT id FROM users WHERE user_name = ? LIMIT 1";

$stmt = $con->prepare($query);

$stmt->bind_param("s", $username);

$stmt->execute();

$result = $stmt->get_result();*/

    if ($result && mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        return $row['id'];

    }



    return null;

}



function check_login($con)

{

    if(isset($_SESSION['user']))

    {

        $id = $_SESSION['user'];

        $query = "SELECT * FROM users WHERE id = '$id' LIMIT 1";

        $result = mysqli_query($con, $query);

        

        if($result && mysqli_num_rows($result) > 0)

        {

            return $user_data = mysqli_fetch_assoc($result);



            // Verifică dacă utilizatorul are drepturi de administrator

            //if($user_data['is_admin'] == 1) {

                //return $user_data;

            //} else {

                //echo "Access denied. Only administrators are allowed to access this page.";

            //}

        }

        else

        {

            echo "No user data found in database.";

        }

    }

    else

    {

        echo "User session not set.";

    }



    // Redirect to login

    header("Location: login.php");

    die;

}



function random_num($length)

{

	$text="";

	if($length <5)

	{

		$length=5;

	}

	$len = rand(4,$length);

for ($i = 0; $i < $len; $i++) {

    $text .= rand(0, 9);  // concateneaza la valoarea existenta

}



	return $text;

}







function get_non_admin_users($con) {

    $users = array();



    $query = "SELECT * FROM users WHERE is_admin = 0";

    $result = mysqli_query($con, $query);



    if ($result) {

        while ($row = mysqli_fetch_assoc($result)) {

            $users[] = $row;

        }

    }



    return $users;

}


function get_admin_user_id($con) {

    $query = "SELECT id FROM users WHERE is_admin = 1 LIMIT 1";

    $result = mysqli_query($con, $query);



    if ($result && mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        return $row['id'];

    }



    return null;

}





