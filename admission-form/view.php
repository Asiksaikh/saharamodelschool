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
    die("Database connection failed");
}


if (!isset($_GET['id'])) {
    die("Invalid application ID");
}


$id = intval($_GET['id']);


$stmt = $conn->prepare(
    "SELECT * FROM admissions WHERE id = ?"
);

$stmt->bind_param("i", $id);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Application not found");
}

$row = $result->fetch_assoc();

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Admission Details</title>

<style>

body {
    font-family: Arial;
    background: #f1f5f3;
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 800px;
    margin: auto;
    background: white;
    padding: 30px;
    border-radius: 12px;
}

.header {
    text-align: center;
    color: #0F5233;
    border-bottom: 2px solid #0F5233;
    padding-bottom: 15px;
}

.details {
    margin-top: 20px;
}

.item {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

.item strong {
    display: inline-block;
    width: 200px;
}

.buttons {
    text-align: center;
    margin-top: 25px;
}

button,
a {
    display: inline-block;
    padding: 12px 25px;
    margin: 5px;
    border: none;
    border-radius: 6px;
    text-decoration: none;
    cursor: pointer;
}

.print {
    background: #0F5233;
    color: white;
}

.back {
    background: #777;
    color: white;
}

@media print {

    .buttons {
        display: none;
    }

}

</style>

</head>


<body>

<div class="container">


<div class="header">

<h1>SAHARA MODEL SCHOOL</h1>

<h3>ADMISSION APPLICATION</h3>

</div>


<div class="details">


<div class="item">
<strong>Application ID:</strong>
<?php echo $row['id']; ?>
</div>


<div class="item">
<strong>Student Name:</strong>
<?php echo htmlspecialchars($row['student_name']); ?>
</div>


<div class="item">
<strong>Date of Birth:</strong>
<?php echo htmlspecialchars($row['dob']); ?>
</div>


<div class="item">
<strong>Gender:</strong>
<?php echo htmlspecialchars($row['gender']); ?>
</div>


<div class="item">
<strong>Class:</strong>
<?php echo htmlspecialchars($row['class']); ?>
</div>


<div class="item">
<strong>Father's Name:</strong>
<?php echo htmlspecialchars($row['father_name']); ?>
</div>


<div class="item">
<strong>Mother's Name:</strong>
<?php echo htmlspecialchars($row['mother_name']); ?>
</div>


<div class="item">
<strong>Mobile:</strong>
<?php echo htmlspecialchars($row['mobile']); ?>
</div>


<div class="item">
<strong>Email:</strong>
<?php echo htmlspecialchars($row['email']); ?>
</div>


<div class="item">
<strong>Address:</strong>
<?php echo nl2br(htmlspecialchars($row['address'])); ?>
</div>


<div class="item">
<strong>Village / Town:</strong>
<?php echo htmlspecialchars($row['village']); ?>
</div>


<div class="item">
<strong>District:</strong>
<?php echo htmlspecialchars($row['district']); ?>
</div>


<div class="item">
<strong>State:</strong>
<?php echo htmlspecialchars($row['state']); ?>
</div>


<div class="item">
<strong>PIN:</strong>
<?php echo htmlspecialchars($row['pin']); ?>
</div>


<div class="item">
<strong>Previous School:</strong>
<?php echo htmlspecialchars($row['previous_school']); ?>
</div>


<div class="item">
<strong>Previous Class:</strong>
<?php echo htmlspecialchars($row['previous_class']); ?>
</div>


<div class="item">
<strong>Message:</strong>
<?php echo nl2br(htmlspecialchars($row['message'])); ?>
</div>


<div class="item">
<strong>Submitted:</strong>
<?php echo $row['created_at']; ?>
</div>


</div>


<div class="buttons">

<button
    class="print"
    onclick="window.print()">
    Print / Save PDF
</button>


<a
    href="admin.php"
    class="back">
    Back to Admin
</a>

</div>


</div>

</body>

</html>

<?php

$stmt->close();
$conn->close();

?>