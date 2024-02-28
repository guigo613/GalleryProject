<!DOCTYPE html>
<html>
<head>
    <title>App de Login</title>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="app">
        <div class="center-app">
            <h2>Formulário de Login</h2>
            <?php if (isset($error_message)): ?>
                <p><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form method="post" action="?route=authenticate">
                <div class="mb-3">
                    <label for="username" class="form-label">Usuário</label>
                    <input required type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input required type="password" class="form-control" id="password" name="password">
                </div>
                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>