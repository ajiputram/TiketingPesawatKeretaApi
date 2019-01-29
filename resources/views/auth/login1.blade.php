k<!DOCTYPE html>
<html lang="en">
<head>
  <title>A Tour</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" href="{{ url('images/favicon-24.png') }}"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
  
  <div class="limiter">
    <div class="container-login100" style="background-image: url('images/chr.jpg');">
      <div class="wrap-login100 p-t-190 p-b-30">
        <form method="POST" action="{{ route('login') }}" >

            {{ csrf_field() }}

          <div class="login100-form-avatar">
            <img src="images/logo.png" alt="A Tour">
          </div>

          <span class="login100-form-title p-t-20 p-b-45">
            A Tour
          </span>

          <div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
            <input class="input100" type="text" name="username" placeholder="Username" value="{{ old('username') }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-user"></i>
            </span>

              @if ($errors->has('username'))
                        <span class="help-block">
                         <strong>{{ $errors->first('username') }}</strong>
                        </span>
                  @endif

          </div>

          <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock"></i>
            </span>

               @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

          </div>

          <div class="container-login100-form-btn p-t-10">
            <button class="login100-form-btn">
              Login
            </button>
          </div>

          <div class="text-center w-full p-t-25 p-b-230">
            <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me name="remember" {{ old('remember') ? 'checked' : '' }}">
                  Remember Password
                </label>
              </div>
          </div>

        </form>
      </div>
    </div>
  </div>
  
  

  
<!--===============================================================================================-->  
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="js/main.js"></script>

</body>
</html>