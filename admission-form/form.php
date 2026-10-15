<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "sahara_school";

$conn = new mysqli(
    $host,
    $username,
    $password,
    $database
);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}


/* Get form data */

$student_name = $_POST['student_name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$class = $_POST['class'];

$father_name = $_POST['father_name'];
$mother_name = $_POST['mother_name'];

$mobile = $_POST['mobile'];
$email = $_POST['email'];

$address = $_POST['address'];
$village = $_POST['village'];
$district = $_POST['district'];

$state = $_POST['state'];
$pin = $_POST['pin'];

$previous_school = $_POST['previous_school'];
$previous_class = $_POST['previous_class'];

$message = $_POST['message'];


/* Insert data */

$sql = "INSERT INTO admissions
(
    student_name,
    dob,
    gender,
    class,
    father_name,
    mother_name,
    mobile,
    email,
    address,
    village,
    district,
    state,
    pin,
    previous_school,
    previous_class,
    message
)

VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "ssssssssssssssss",
    $student_name,
    $dob,
    $gender,
    $class,
    $father_name,
    $mother_name,
    $mobile,
    $email,
    $address,
    $village,
    $district,
    $state,
    $pin,
    $previous_school,
    $previous_class,
    $message
);


if ($stmt->execute()) {

    echo "
    <!DOCTYPE html>

    <html>
    <head>

        <title>Admission Successful</title>

        <style>

            body {
                font-family: Arial;
                background: #f1f5f3;
                text-align: center;
                padding-top: 100px;
            }

            .box {
                background: white;
                max-width: 500px;
                margin: auto;
                padding: 40px;
                border-radius: 15px;
                box-shadow: 0 5px 20px #ccc;
            }

            h1 {
                color: #0F5233;
            }

            a {
                display: inline-block;
                margin-top: 20px;
                background: #0F5233;
                color: white;
                padding: 12px 25px;
                text-decoration: none;
                border-radius: 6px;
            }

        </style>

    </head>

    <body>

        <div class='box'>

            <h1>Application Submitted!</h1>

            <p>
                Your admission application has been
                successfully submitted.
            </p>

            <a href='index.html'>
                Back to Admission Form
            </a>

        </div>

    </body>
    </html>
    ";

} else {

    echo "Error: " . $stmt->error;

}


$stmt->close();
$conn->close();

?>