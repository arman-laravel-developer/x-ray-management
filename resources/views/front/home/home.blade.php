<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-Ray & MRI Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: linear-gradient(135deg, #4b6cb7, #182848);
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .btn-custom {
            padding: 10px 20px;
            font-size: 1.2rem;
            background: #ff4081;
            color: white;
            border: none;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: #e73370;
        }
    </style>
</head>
<body>
    <h1 class="mb-4">Welcome to X-Ray & MRI Management</h1>
    <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel" style="color: teal">User Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="username" class="form-label" style="color: teal">Username</label>
                    <input type="text" id="username" class="form-control mb-3" placeholder="Enter your username" autocomplete="off">
                    <label for="password" class="form-label" style="color: teal">Password</label>
                    <input type="password" id="password" class="form-control mb-3" placeholder="Enter your password" autocomplete="off">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
