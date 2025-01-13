<?php



include("connect.php");





// functions.php


function check_access() {
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit;
    }
}





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

    $text .= rand(0, 9);  // Concatenează la valoarea existentă, în loc să o suprascrii

}



	return $text;

}





function get_accessible_courses($con, $user_id) {

    $accessibleCourses = array();



    // Aici poți scrie codul pentru a selecta cursurile la care userul are acces din baza de date

    $query = "SELECT c.course_name, c.file_name

              FROM courses c

              INNER JOIN user_course_access uca ON c.id = uca.course_id

              WHERE uca.user_id = ?";

    

    $stmt = $con->prepare($query);

    $stmt->bind_param("i", $user_id);

    $stmt->execute();

    $result = $stmt->get_result();



    // Debug - Verificați dacă interogarea returnează date

    if ($result->num_rows === 0) {

        echo "Nu există date în interogare.";

    }



    while ($row = $result->fetch_assoc()) {

        $accessibleCourses[] = $row;

    }



    return $accessibleCourses;

}

// Funcție pentru a obține lista de utilizatori

function get_users($con) {

    $query = "SELECT * FROM users";

    $result = mysqli_query($con, $query);

    

    $users = array();

    while ($row = mysqli_fetch_assoc($result)) {

        $users[] = $row;

    }

    

    return $users;

}



// Funcție pentru a obține lista de cursuri

function get_courses($con) {

    $query = "SELECT * FROM courses";

    $result = mysqli_query($con, $query);

    

    $courses = array();

    while ($row = mysqli_fetch_assoc($result)) {

        $courses[] = $row;

    }

    

    return $courses;

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

function get_courses_not_associated_with_user($con, $user_id) {

    $user_id = mysqli_real_escape_string($con, $user_id);

    

    // Selectează cursurile care nu sunt asociate cu utilizatorul dat

    $query = "SELECT * FROM courses WHERE id NOT IN (SELECT course_id FROM user_course_access WHERE user_id = '$user_id')";

    $result = mysqli_query($con, $query);

    

    $courses = array();

    while ($row = mysqli_fetch_assoc($result)) {

        $courses[] = $row;

    }

    

    return $courses;

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







// Setează cheia API

$api_key = "NoSecret";



function verifySolution($cerinta, $solutie, $api_key) {

    $url = 'https://api.openai.com/v1/chat/completions';



    $data = array(

        "model" => "gpt-3.5-turbo",

        "messages" => array(

            array(

                "role" => "system",

                "content" => "You are a helpful assistant that gives a grade from 1 to 10 for the provided solution."

            ),

            array(

                "role" => "user",

                "content" => "I have an exercise with the following requirement: {$cerinta}\nMy solution is: {$solutie}\nIs this solution correct? If not, please give some advice. Please rate it from 1 to 10. Make sure that the last 2 characterss of your response represent the number corresponding to the grade, (the last 2 characters should be the exact number from 1-10) and please respond in romanian."

            )

        ),

        "max_tokens" => 500,

        "temperature" => 0.01

    );



    $headers = array(

        'Content-Type: application/json',

        'Authorization: Bearer ' . $api_key

    );



    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);



    $result = curl_exec($ch);

    if (curl_errno($ch)) {

        echo 'Error: ' . curl_error($ch);

    }

    curl_close($ch);



    $response = json_decode($result);



    // Extragerea și returnarea răspunsului

    $rawText = $response->choices[0]->message->content;

    return $rawText;

}





?>









