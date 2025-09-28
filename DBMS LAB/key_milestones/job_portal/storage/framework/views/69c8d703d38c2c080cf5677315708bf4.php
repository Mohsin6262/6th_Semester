

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
  <h2 class="mb-4">Post a New Job</h2>

  
  <?php if($errors->any()): ?>
    <div class="alert alert-danger">
      <ul class="mb-0">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
  <?php endif; ?>

  
  <form method="POST" action="<?php echo e(route('jobs.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="mb-3">
      <label for="company_name" class="form-label">Company Name</label>
      <input type="text" name="company_name" class="form-control" required>
    </div>
    
    <div class="mb-3">
      <label for="title" class="form-label">Job Title</label>
      <input type="text" name="title" class="form-control" value="<?php echo e(old('title')); ?>" required>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Job Description</label>
      <textarea name="description" class="form-control" rows="4" required><?php echo e(old('description')); ?></textarea>
    </div>

    <div class="mb-3">
      <label for="requirements" class="form-label">Requirements</label>
      <textarea name="requirements" class="form-control" rows="4" required><?php echo e(old('requirements')); ?></textarea>
    </div>

    <div class="mb-3">
      <label for="location" class="form-label">Location</label>
      <input type="text" name="location" class="form-control" value="<?php echo e(old('location')); ?>" required>
    </div>

    <div class="mb-3">
      <label for="salary" class="form-label">Salary Range</label>
      <input type="text" name="salary" class="form-control" value="<?php echo e(old('salary')); ?>" required>
    </div>

   

    <button type="submit" class="btn btn-success w-100">Post Job</button>
  </form>
</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\job_portal\resources\views/jobs/create.blade.php ENDPATH**/ ?>