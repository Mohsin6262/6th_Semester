<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Job Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Login Styles -->
  <style>
    html,
    body {
      height: 100%;
    }

    body {
      display: flex;
      align-items: center;
      justify-content: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
    }

    .form-signin {
      max-width: 330px;
      padding: 1rem;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .form-signin .form-floating:focus-within {
      z-index: 2;
    }

    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
  </style>
</head>
<body>

<main class="form-signin text-center">
  <form method="POST" action="<?php echo e(route('login.submit')); ?>">
    <?php echo csrf_field(); ?>
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <?php if($errors->any()): ?>
      <div class="alert alert-danger">
        <?php echo e($errors->first()); ?>

      </div>
    <?php endif; ?>

    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">© Job Portal <?php echo e(date('Y')); ?></p>
    <a href="<?php echo e(route('register')); ?>" class="btn btn-link mt-3">Don't have an account? Register here</a>
  </form>
</main>


</body>
</html>
<?php /**PATH D:\Semester_Data\6th_semester\DBMS LAB\key_milestones\job_portal\resources\views/auth/login.blade.php ENDPATH**/ ?>