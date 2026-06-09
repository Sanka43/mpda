<?php

if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
    flash('register_error', __('register_error'));
    redirect('register');
}

$studentName = trim($_POST['student_name'] ?? '');
$parentName = trim($_POST['parent_name'] ?? '');
$gender = $_POST['gender'] ?? '';
$age = (int)($_POST['age'] ?? 0);
$address = trim($_POST['address'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$school = trim($_POST['school'] ?? '');
$studentDob = $_POST['student_dob'] ?? '';
$motherDob = $_POST['mother_dob'] ?? '';
$guardianNic = trim($_POST['guardian_nic'] ?? '');
$guardianJob = trim($_POST['guardian_job'] ?? '');
$emergencyPhone = trim($_POST['emergency_phone'] ?? '');
$branchId = (int)($_POST['preferred_branch_id'] ?? 0);

$validGenders = ['male', 'female', 'other'];

if (
    !$studentName || !$parentName || !in_array($gender, $validGenders, true)
    || $age < 3 || $age > 30 || !$address || !$phone || !$emergencyPhone || !$branchId
) {
    flash('register_error', __('register_error'));
    redirect('register');
}

$branch = getBranchById($branchId);
if (!$branch) {
    flash('register_error', __('register_error'));
    redirect('register');
}

$message = "MPDA Registration\n\n"
    . "Student: {$studentName}\n"
    . "Parent: {$parentName}\n"
    . "Gender: {$gender}\n"
    . "Age: {$age}\n"
    . "Address: {$address}\n"
    . "Phone: {$phone}\n"
    . "Emergency: {$emergencyPhone}\n"
    . "School: " . ($school ?: 'N/A') . "\n"
    . "Student DOB: " . ($studentDob ?: 'N/A') . "\n"
    . "Mother DOB: " . ($motherDob ?: 'N/A') . "\n"
    . "Guardian NIC: " . ($guardianNic ?: 'N/A') . "\n"
    . "Guardian Job: " . ($guardianJob ?: 'N/A') . "\n"
    . "Branch: {$branch['name']} ({$branch['day_of_week']})";

header('Location: ' . whatsappUrl($message));
exit;
