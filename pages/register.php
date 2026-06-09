<?php
$pageTitle = __('register_title');
$metaDescription = __('register_subtitle');

$success = flash('register_success');
$error = flash('register_error');
$selectedBranch = (int)($_GET['branch'] ?? 0);

$branches = getBranches();

if (isPost()) {
    require __DIR__ . '/../api/submit-registration.php';
    exit;
}
?>

<div class="page-header">
    <div class="container">
        <h1><?= e(__('register_title')) ?></h1>
        <p><?= e(__('register_subtitle')) ?></p>
    </div>
</div>

<section>
    <div class="container">
        <div class="form-section fade-in">
            <?php if ($success): ?>
            <div class="alert alert-success"><?= e($success) ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
            <div class="alert alert-error"><?= e($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="<?= url('register') ?>" id="registrationForm">
                <?= csrfField() ?>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="student_name"><?= e(__('field_student_name')) ?> *</label>
                        <input type="text" id="student_name" name="student_name" required maxlength="150">
                    </div>
                    <div class="form-group">
                        <label for="parent_name"><?= e(__('field_parent_name')) ?> *</label>
                        <input type="text" id="parent_name" name="parent_name" required maxlength="150">
                    </div>
                    <div class="form-group">
                        <label for="gender"><?= e(__('field_gender')) ?> *</label>
                        <select id="gender" name="gender" required>
                            <option value=""><?= e(__('field_branch_select')) ?></option>
                            <option value="male"><?= e(__('field_gender_male')) ?></option>
                            <option value="female"><?= e(__('field_gender_female')) ?></option>
                            <option value="other"><?= e(__('field_gender_other')) ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="age"><?= e(__('field_age')) ?> *</label>
                        <input type="number" id="age" name="age" required min="3" max="30">
                    </div>
                    <div class="form-group full-width">
                        <label for="address"><?= e(__('field_address')) ?> *</label>
                        <input type="text" id="address" name="address" required maxlength="500">
                    </div>
                    <div class="form-group">
                        <label for="phone"><?= e(__('field_phone')) ?> *</label>
                        <input type="tel" id="phone" name="phone" required maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="school"><?= e(__('field_school')) ?></label>
                        <input type="text" id="school" name="school" maxlength="150">
                    </div>
                    <div class="form-group">
                        <label for="student_dob"><?= e(__('field_student_dob')) ?></label>
                        <input type="date" id="student_dob" name="student_dob">
                    </div>
                    <div class="form-group">
                        <label for="mother_dob"><?= e(__('field_mother_dob')) ?></label>
                        <input type="date" id="mother_dob" name="mother_dob">
                    </div>
                    <div class="form-group">
                        <label for="guardian_nic"><?= e(__('field_guardian_nic')) ?></label>
                        <input type="text" id="guardian_nic" name="guardian_nic" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="guardian_job"><?= e(__('field_guardian_job')) ?></label>
                        <input type="text" id="guardian_job" name="guardian_job" maxlength="150">
                    </div>
                    <div class="form-group">
                        <label for="emergency_phone"><?= e(__('field_emergency_phone')) ?> *</label>
                        <input type="tel" id="emergency_phone" name="emergency_phone" required maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="preferred_branch_id"><?= e(__('field_branch')) ?> *</label>
                        <select id="preferred_branch_id" name="preferred_branch_id" required>
                            <option value=""><?= e(__('field_branch_select')) ?></option>
                            <?php foreach ($branches as $branch): ?>
                            <option value="<?= (int)$branch['id'] ?>" <?= $selectedBranch === (int)$branch['id'] ? 'selected' : '' ?>>
                                <?= e($branch['name']) ?> — <?= e($branch['day_of_week']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top:1.5rem;width:100%;"><?= e(__('register_submit')) ?></button>
            </form>
        </div>
    </div>
</section>
