<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.0/dist/css/coreui.min.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center min-vh-100 bg-light">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="mb-3 text-center">Sign In</h3>
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form method="post" novalidate>
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input name="username" type="text" class="form-control" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input name="password" type="password" class="form-control" required>
                            </div>
                            <button class="btn btn-primary w-100" type="submit">Login</button>
                        </form>
                    </div>
                </div>
                <p class="text-center mt-3 text-muted small">Demo: admin / 1234</p>
            </div>
        </div>
    </div>

</body>

</html>