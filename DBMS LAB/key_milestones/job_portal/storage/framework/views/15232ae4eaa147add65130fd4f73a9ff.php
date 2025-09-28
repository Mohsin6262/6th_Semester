

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
  <h2 class="mb-4">My Profile</h2>

  <?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
  <?php endif; ?>

  <form method="POST" action="<?php echo e(route('profile.update')); ?>">
    <?php echo csrf_field(); ?>

    <!-- Common Fields -->
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" value="<?php echo e(old('name', $user->Name)); ?>" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" value="<?php echo e(old('email', $user->Email)); ?>" class="form-control" required>
    </div>

    <!-- Jobseeker Profile Fields -->
    <?php if($user->UserType === 'jobseeker'): ?>
      <div class="mb-3">
        <label class="form-label">Date of Birth</label>
        <input type="date" name="date_of_birth" value="<?php echo e(old('date_of_birth', $profile->DateOfBirth ?? '')); ?>" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Address</label>
        <input type="text" name="address" value="<?php echo e(old('address', $profile->Address ?? '')); ?>" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Profile Summary</label>
        <textarea name="profile_summary" class="form-control" rows="4" required><?php echo e(old('profile_summary', $profile->ProfileSummary ?? '')); ?></textarea>
      </div>

    <!-- Employer Profile Fields -->
    <?php else: ?>
     <!-- Company Name Field -->
<div class="mb-3">
  <label class="form-label">Company Name</label>
  <input type="text" name="CompanyName" value="<?php echo e(old('CompanyName', $profile->CompanyName)); ?>" class="form-control" required>
</div>


      <div class="mb-3">
        <label class="form-label">Company Description</label>
        <textarea name="company_description" class="form-control" rows="4" required><?php echo e(old('company_description', $profile->CompanyDescription ?? '')); ?></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Company Website</label>
        <input type="url" name="company_website" class="form-control"
               value="<?php echo e(old('company_website', $profile->CompanyWebsite ?? '')); ?>">
      </div>

      <!-- Verified Status Display -->
      <div class="mb-3">
        <label class="form-label">Verified Status</label><br>
        <?php if(isset($profile->VerifiedStatus) && $profile->VerifiedStatus): ?>
          <span class="badge bg-success">Verified</span>
        <?php else: ?>
          <span class="badge bg-warning text-dark">Not Verified</span>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <button type="submit" class="btn btn-primary">Update Profile</button>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\job_portal\resources\views/profile.blade.php ENDPATH**/ ?>