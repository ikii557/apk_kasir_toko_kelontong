<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .auth-form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h4 {
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="container ">
        <div class="auth-form ">
            <h4 class="text-center mb-4">Register untuk login</h4>
            <form action="/store/register" method="post" class="mt-4">
                @csrf
                <div class="form-group">
                    <label><strong>Nama</strong></label>
                    <input name="nama" type="nama" class="form-control">
                    @error('nama')
                            <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>No hp</strong></label>
                    <input name="no_hp" type="no_hp" class="form-control">
                    @error('no_hp')
                            <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input name="email" type="email" class="form-control">
                    @error('email')
                            <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Password</strong></label>
                    <input name="password" type="password" class="form-control" >
                    @error('password')
                            <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Role</strong></label>
                    <select name="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="superadmin">Super Admin</option>
                    </select>
                    @error('role')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>


                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block mt-2">REGISTER</button>
                </div>
            </form>
            <div class="new-account mt-3">
                <p>Belum Punya Akun Silahkan? <a class="text-primary" href="/login">login</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
