

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h2 class="text-center mb-4 fw-bold text-primary">Admin Control Panel</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success text-center">
            <?php echo e(session('success')); ?>

        </div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger text-center">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    
    <div class="card shadow mb-5">
        <div class="card-header bg-info text-white fw-semibold">Unverified Employers</div>
        <div class="card-body">
            <?php if($employers->isEmpty()): ?>
                <p class="text-muted text-center">No unverified employers found.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $employers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($emp->UserID); ?></td>
                                    <td><?php echo e($emp->Name); ?></td>
                                    <td><?php echo e($emp->Email); ?></td>
                                    <td>
                                        <form method="POST" action="<?php echo e(route('admin.update.employer', $emp->UserID)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="VerifiedStatus" value="1">
                                            <button type="submit" class="btn btn-sm btn-success">✔ Verify</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="card shadow">
        <div class="card-header bg-warning text-dark fw-semibold">Pending Job Applications</div>
        <div class="card-body">
            <?php if($applications->isEmpty()): ?>
                <p class="text-muted text-center">No pending applications found.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Application ID</th>
                                <th>Job ID</th>
                                <th>Seeker ID</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($app->ApplicationID); ?></td>
                                    <td><?php echo e($app->JobID); ?></td>
                                    <td><?php echo e($app->SeekerID); ?></td>
                                    <td><?php echo e($app->AppliedDate); ?></td>
                                    <td>
                                        <form method="POST" action="<?php echo e(route('admin.update.application', $app->ApplicationID)); ?>" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="status" value="Reviewed">
                                            <button type="submit" class="btn btn-sm btn-success">✔ Mark Reviewed</button>
                                        </form>
                                        <form method="POST" action="<?php echo e(route('admin.update.application', $app->ApplicationID)); ?>" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="status" value="Rejected">
                                            <button type="submit" class="btn btn-sm btn-danger">✖ Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\job_portal\resources\views/admin.blade.php ENDPATH**/ ?>