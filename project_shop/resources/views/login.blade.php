<!doctype html>
<html lang="en">
 <head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Login</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" 
rel="stylesheet" integrity="sha384-
LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" 
crossorigin="anonymous">
<style type="text/css">
 body{
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
 <form method="POST" action="{{ route('login.post') }}">
 @csrf
 @session('error')
 <div class="alert alert-danger" role="alert"> 
 {{ $value }}
 </div>
 @endsession
 <div>
 <label for="email" class="form-label">Email</label>
 <input type="email" class="form-control" id="email" 
name="email" required>
 </div>
 <div class="mb-3">
 <label for="password" class="form￾label">Password</label>
 <input type="password" class="form-control" 
id="password" name="password" required>
 </div>
 <button type="submit" class="btn btn￾primary">Login</button>
 </div>
 <div class="mt-3">
 <a href="{{ route('register') }}">Don't have an account? 
Register here</a>
 </div>
 </form>
 </div>
 </div>
 </div>
 </div>
 </div>
 </section>
 <script 
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-
ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O
5Q" crossorigin="anonymous"></script>
 </body>
</html>
5.3.Registration.blade.php
<!doctype html>
<html lang="en">
 <head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Registration </title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" 
rel="stylesheet" integrity="sha384-
LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" 
crossorigin="anonymous">
<style type="text/css">
 body{
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
 <h5 class="card-title">Registration</h5>
 </div>
 <div class="card-body">
 <form method="POST" action="{{ route('register.post') }}">
 @csrf
 <div>
 <label for="name" class="form-label">Name</label>
 <input type="text" class="form-control" id="name" 
name="name" required>
 </div>
 <div class="mb-3">
 <label for="email" class="form-label">Email</label>
 <input type="email" class="form-control" id="email" 
name="email" required>
 </div>
 <div class="mb-3">
 <label for="password" class="form￾label">Password</label>
 <input type="password" class="form-control" 
id="password" name="password" required>
 </div>
 <button type="submit" class="btn btn￾primary">Register</button>
 </form>
 </div>
 </div>
 </div>
 </div>
 </div>
 </section>
 <script 
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-
ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O
5Q" crossorigin="anonymous"></script>
 </body>
</html>