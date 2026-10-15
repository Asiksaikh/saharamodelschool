<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "sahara_school";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}


/* Delete application */

if (isset($_GET['delete'])) {

    $id = intval($_GET['delete']);

    $stmt = $conn->prepare(
        "DELETE FROM admissions WHERE id = ?"
    );

    $stmt->bind_param("i", $id);

    $stmt->execute();

    $stmt->close();

    header("Location: admin.php");
    exit();
}


/* Search */

$search = "";

if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}


if ($search != "") {

    $stmt = $conn->prepare(
        "SELECT * FROM admissions
         WHERE student_name LIKE ?
         OR mobile LIKE ?
         OR father_name LIKE ?
         OR class LIKE ?
         ORDER BY id DESC"
    );

    $like = "%" . $search . "%";

    $stmt->bind_param(
        "ssss",
        $like,
        $like,
        $like,
        $like
    );

    $stmt->execute();

    $result = $stmt->get_result();

} else {

    $result = $conn->query(
        "SELECT * FROM admissions ORDER BY id DESC"
    );
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Sahara Model School - Admin Panel</title>


<style>

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f1f5f3;
}


/* Header */

.header {
    background: #0F5233;
    color: white;
    padding: 20px;
    text-align: center;
}

.header h1 {
    margin: 0;
}

.header p {
    margin: 5px 0 0;
}


/* Container */

.container {
    width: 95%;
    margin: 25px auto;
}


/* Search */

.search-box {
    background: white;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.search-box form {
    display: flex;
    gap: 10px;
}

.search-box input {
    flex: 1;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
}

.search-box button {
    background: #0F5233;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 6px;
    cursor: pointer;
}


/* Table */

.table-box {
    background: white;
    padding: 15px;
    border-radius: 10px;
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 1100px;
}

th {
    background: #0F5233;
    color: white;
    padding: 12px;
}

td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}


/* Buttons */

.view {
    background: #2563eb;
    color: white;
    padding: 7px 12px;
    text-decoration: none;
    border-radius: 5px;
}

.delete {
    background: #dc2626;
    color: white;
    padding: 7px 12px;
    text-decoration: none;
    border-radius: 5px;
}


/* Empty */

.empty {
    text-align: center;
    padding: 30px;
    color: #777;
}


/* Mobile */

@media(max-width: 600px) {

    .search-box form {
        flex-direction: column;
    }

    .search-box button {
        width: 100%;
    }

}

</style>

</head>


<body>


<div class="header">

    <h1>SAHARA MODEL SCHOOL</h1>

    <p>ADMIN ADMISSION PANEL</p>

</div>


<div class="container">


<div class="search-box">

<form method="GET">

    <input
        type="text"
        name="search"
        placeholder="Search student, mobile, father name or class..."
        value="<?php echo htmlspecialchars($search); ?>"
    >

    <button type="submit">
        Search
    </button>

</form>

</div>



<div class="table-box">

<table>

<tr>

    <th>ID</th>

    <th>Student Name</th>

    <th>Class</th>

    <th>Father Name</th>

    <th>Mobile</th>

    <th>District</th>

    <th>Date</th>

    <th>Action</th>

</tr>


<?php

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

?>

<tr>

    <td>
        <?php echo $row['id']; ?>
    </td>

    <td>
        <?php echo htmlspecialchars(
            $row['student_name']
        ); ?>
    </td>

    <td>
        <?php echo htmlspecialchars(
            $row['class']
        ); ?>
    </td>

    <td>
        <?php echo htmlspecialchars(
            $row['father_name']
        ); ?>
    </td>

    <td>
        <?php echo htmlspecialchars(
            $row['mobile']
        ); ?>
    </td>

    <td>
        <?php echo htmlspecialchars(
            $row['district']
        ); ?>
    </td>

    <td>
        <?php echo $row['created_at']; ?>
    </td>

    <td>

        <a
            class="view"
            href="view.php?id=<?php echo $row['id']; ?>"
        >
            View
        </a>

        <a
            class="delete"
            href="admin.php?delete=<?php echo $row['id']; ?>"
            onclick="return confirm('Are you sure you want to delete this application?');"
        >
            Delete
        </a>

    </td>

</tr>

<?php

    }

} else {

?>

<tr>

    <td colspan="8" class="empty">

        No admission application found.

    </td>

</tr>

<?php

}

?>

</table>

</div>

</div>


</body>

</html>

<?php

$conn->close();

?>