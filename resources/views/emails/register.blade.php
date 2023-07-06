@extends('layout')
@section('content')
  <title>Login Form</title>
  <style>
    .login {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 60vh;
      margin: 0;
    }

    .container {
      width: 350px;
      height: 450px;
      padding: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #fff;
    }

    .container h2 {
      text-align: center;
    }

    .container label,
    .container input[type="text"],
    .container input[type="email"],
    .container input[type="password"],
    .container input[type="submit"],
    .container p {
      display: block;
      width: 100%;
      margin-bottom: 10px;
    }

    .container label {
      font-weight: bold;
    }

    .container input[type="submit"] {
      position: relative;
      background-color: blue;
      color: white;
      border: none;
      padding: 10px;
      margin-bottom: 10%;
      cursor: pointer;
    }

    .container input[type="submit"]:hover {
      background-color: #1066d6;
    }

    .container .links {
      display: flex;
      justify-content: space-between;
      position: relative;
      bottom:8%;
      text-decoration: underline;
    }

    .container .links a:hover {
    color: blue;
    }

    .container .links a {
        text-decoration: none;
    }
    </style>

<div class="login">
  <div class="container">
    <h2>Register</h2>
    <form action="{{ route('authenticate') }}" method="POST">
        @csrf
      <label for="name">Username:</label>
      <input type="text" id="name" name="name" value="{{ old('name') }}">@error('name')<p style="color: red">{{$message}}</p>@enderror

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}">@error('email')<p style="color: red">{{$message}}</p>@enderror


      <label for="password">Password:</label>
      <input type="password" id="password" name="password">@error('password')<p style="color: red">{{$message}}</p>@enderror

      <label for="password_again">Confirm Password:</label>
      <input type="password" id="password_again" name="password_again">@error('password_again')<p style="color: red">{{$message}}</p>@enderror

      <input type="submit" value="Register">
    </form>
  </div>
</div>
@endsection
