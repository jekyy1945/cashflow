<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .all {
            background-color: #478CCF;

        }

        .container {
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            display: flex;

        }

        .login-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100vh;
            color: black;
            background-color: #ffffff;
        }
    </style>
</head>

<body>

    <div class="all">
        <div class="container">
            <div class="login-container">
                @if ($errors->any())
                <ul>
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $item)
                        <li>
                            {{ $item }}
                        </li>
                        @endforeach
                    </div>
                </ul>
                @endif
                <form action="/login" method="post">
                    <h3>LOGIN</h3>
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="input" name="name" value="{{ Session::get('name') }}" class="form-control"
                            placeholder="Masukkan Username" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                    </div>
                    <div class="mb-3 d-grid">
                        <button type="submit" name="submit" class="btn btn-primary">LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
