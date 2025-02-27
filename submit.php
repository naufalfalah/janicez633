<?php 

header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");

function safe_redirect($url) {
    if (!headers_sent()) {
        header("Location: https://janicez633.sg-host.com/" . $url);
        exit;
    } else {
        die("Cannot redirect, headers already sent.");
    }
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    safe_redirect("registration/");
    exit;
}

$servername = "localhost"; // Ya tumhara database host
$username = "uinubwggjwyks"; // Database username
$password = "~1)&(bh1^c1C"; // Database ka password
$dbname = "dbiqzpqa1fx0dl"; // Tumhara database name

// MySQL connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Connection check
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// POST se data lena
$household = $_POST['option'] ?? null;
$citizenship = $_POST['citizenship'] ?? null;
$requirement = $_POST['age'] ?? null;
$household_income = $_POST['income'] ?? null;
$ownership_status = $_POST['hdb'] ?? null;
$private_property_ownership = $_POST['private-property'] ?? null;
$first_time_applicant = $_POST['first-applications'] ?? null;
$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$phone = $_POST['phone'] ?? null;

// SQL Query
$sql = "INSERT INTO users (household, citizenship, requirement, household_income, ownership_status, private_property_ownership, first_time_applicant, name, email, phone) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssss", $household, $citizenship, $requirement, $household_income, $ownership_status, $private_property_ownership, $first_time_applicant, $name, $email, $phone);

// Execute Query
if ($stmt->execute()) {
    // echo "Data successfully inserted!";
} else {
    // echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();

$msg = '';

switch (true) {
    case $citizenship === 'No, not Singapore Citizens or Permanent Residents' || 
        $requirement === 'No' || 
        $household_income === 'No' || 
        $private_property_ownership === 'Yes':
        safe_redirect("disqualification/");
        exit;
        // $msg = 'We have assessed your EC eligibility, and unfortunately, it seems you might not currently qualify for an EC purchase. However, based on your assessment, you might be eligible to seek an appeal. Our team will contact you to discuss the possibility of an appeal and guide you through the process. Meanwhile, here are the top 5 affordable condos for you to consider as alternatives. <a herf="#">View top 5 condos</a> 😊';
    case $ownership_status === 'Yes, MOP completed':
        safe_redirect("congratulation/");
        exit;
        // $msg = "We have assessed your EC eligibility. Good news! You're potentially eligible for an EC purchase. If you're a first-timer, you might qualify for up to $30,000 in cash grants to offset your selling price. Our team will reach out to you soon to confirm whether you can receive the $30,000 grant. Meanwhile, download a PDF copy of all available ECs in the market to explore your options! <a herf='#'>Download a copy now</a> 😊";
    case $ownership_status === 'Yes, still within MOP':
        safe_redirect("mop/");
        exit;
        // $msg = "We've noted that your HDB is still within the Minimum Occupation Period (MOP), which may affect your eligibility for an EC purchase. We will be conducting a second assessment to explore potential grounds for an appeal on your behalf. Meanwhile, consider these top 5 affordable condos as alternatives. Please note that Additional Buyer's Stamp Duty (ABSD) may apply. <a herf='#'>View top 5 condos</a> 😊";
    case $ownership_status === 'No, do not own any HDB':
        safe_redirect("appeal/");
        exit;
        // $msg = 'We have assessed your EC eligibility, and unfortunately, it seems you might not currently qualify for an EC purchase. However, based on your assessment, you might be eligible to seek an appeal. Our team will contact you to discuss the possibility of an appeal and guide you through the process. Meanwhile, here are the top 5 affordable condos for you to consider as alternatives. <a herf="#">View top 5 condos</a> 😊';
    default:
        safe_redirect("/");
        exit;
}

?>