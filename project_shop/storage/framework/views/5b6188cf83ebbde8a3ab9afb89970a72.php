<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            background: #F8F9FA;
        }
    </style>
</head>
<body>
    <section class="bg-light py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Login</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="<?php echo e(route('login.post')); ?>">
                                <?php echo csrf_field(); ?>
                                
                                <?php if(session('success')): ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo e(session('success')); ?>

                                    </div>
                                <?php endif; ?>
                                
                                <?php if(session('error')): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo e(session('error')); ?>

                                    </div>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required autofocus>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>

                                <div class="mt-3 text-center">
                                    <a href="<?php echo e(route('register')); ?>">Don't have an account? Register here</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH E:\GitHub\shop_project\project_shop\resources\views/login/login.blade.php ENDPATH**/ ?>