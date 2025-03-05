<?php 

require_once 'config.php';
require_once 'database.php';
require_once 'helper_discord.php';

loadEnv(__DIR__ . '/.env');

header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");

function safe_redirect($url) {
    if (!headers_sent()) {
        header("Location: " . getenv('BASE_URL') . $url);
        exit;
    } else {
        die("Cannot redirect, headers already sent.");
    }
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    safe_redirect("registration/");
    exit;
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
        VALUES (:household, :citizenship, :requirement, :household_income, :ownership_status, :private_property_ownership, :first_time_applicant, :name, :email, :phone)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':household' => $household,
    ':citizenship' => $citizenship,
    ':requirement' => $requirement,
    ':household_income' => $household_income,
    ':ownership_status' => $ownership_status,
    ':private_property_ownership' => $private_property_ownership,
    ':first_time_applicant' => $first_time_applicant,
    ':name' => $name,
    ':email' => $email,
    ':phone' => $phone,
]);

$inserted_id = $pdo->lastInsertId();

$sql = "SELECT * FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $inserted_id]);
$user = $stmt->fetch();

if ($user) {
    // sendLeadToDiscord($user);
} else {
    die("Error: User not found after insert");
}

switch (true) {
    case $citizenship === 'No, not Singapore Citizens or Permanent Residents' || 
        $requirement === 'No' || 
        $household_income === 'No' || 
        $private_property_ownership === 'Yes':
        safe_redirect("disqualification/");
        exit;
    case $ownership_status === 'Yes, MOP completed':
        safe_redirect("congratulation/");
        exit;
    case $ownership_status === 'Yes, still within MOP':
        safe_redirect("mop/");
        exit;
    case $ownership_status === 'No, do not own any HDB':
        safe_redirect("appeal/");
        exit;
    default:
        safe_redirect("/");
        exit;
}

?>