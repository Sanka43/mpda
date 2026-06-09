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
$studentDob = $_POST['student_dob'] ?? null;
$motherDob = $_POST['mother_dob'] ?? null;
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

if ($studentDob === '') $studentDob = null;
if ($motherDob === '') $motherDob = null;

try {
    $db = getDB();

    $branchCheck = $db->prepare('SELECT id FROM branches WHERE id = ? AND is_active = 1');
    $branchCheck->execute([$branchId]);
    if (!$branchCheck->fetch()) {
        flash('register_error', __('register_error'));
        redirect('register');
    }

    $stmt = $db->prepare('
        INSERT INTO registrations (
            student_name, parent_name, gender, age, address, phone, school,
            student_dob, mother_dob, guardian_nic, guardian_job, emergency_phone,
            preferred_branch_id
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ');

    $stmt->execute([
        $studentName, $parentName, $gender, $age, $address, $phone,
        $school ?: null, $studentDob, $motherDob,
        $guardianNic ?: null, $guardianJob ?: null, $emergencyPhone, $branchId
    ]);

    flash('register_success', __('register_success'));
    redirect('register');
} catch (Exception $e) {
    flash('register_error', __('register_error'));
    redirect('register');
}
