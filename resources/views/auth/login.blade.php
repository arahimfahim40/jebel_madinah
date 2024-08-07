<!DOCTYPE html>
<html lang="en">

  <!-- Mirrored from big-bang-studio.com/neptune/neptune-default/pages-sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Jan 2017 10:50:30 GMT -->

  <head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('img/logo-small.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>Jabal AL Madinah</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap4/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}">
    <!-- Neptune CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/core.css') }}">
  </head>

  <body class="img-cover" style="background-image: url(img/shippment.jpg);">

    <div class="container-fluid" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
      <div class="sign-form" style="width: 100%;padding-top:0px;">
        <div class="row">
          <div style="max-width: 480px; margin: auto;">
            <div class="box b-a-0"
              style="background-color: rgba(255, 255, 255, 0.95); border-radius: 10px;padding-top:20px;">
              <div class="p-2 text-xs-center" style="padding-bottom: 0px !important;">
                <h3>Welcome To Jabal AL Madinah</h3>
                <p>Please sign in to start your session</p>
              </div>
              @if (Session::has('errors'))
                <div class="alert alert-danger" style="margin:5px;">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <ul style="list-style: none;">
                    @foreach ($errors->all() as $error)
                      <li> {!! $error !!} </li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <form method="POST" class="p-2 form-material mb-1 from-prevent-multiple-submits"
                action="{{ route('auth.login') }}">
                @csrf
                <div class="form-group">
                  <input type="email" class="form-control" id="exampleInputEmail" value="{{ old('email') }}"
                    placeholder="Email" name="email" required />
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="exampleInputPassword" value="{{ old('password') }}"
                    placeholder="Password" name="password" required>
                </div>
                <div class="px-2 form-group mb-0">
                  <button type="submit" class="btn btn-purple btn-block text-uppercase from-prevent-multiple-submits"
                    id="signin">Sign in</button>
                </div>
              </form>
              <div class="p-2 text-xs-center text-muted">
                <!-- <a class="text-black" href="#"><span class="underline">For got password ?</span></a> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Vendor JS -->
    <script type="text/javascript" src="{{ asset('assets/jquery/jquery-1.12.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/tether/js/tether.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bootstrap4/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript">
      $("#signin").click(function(e) {
        setTimeout(function() {
          $("#signin").prop('disabled', true);
        }, 10);
        setTimeout(function() {
          $("#signin").prop('disabled', false);
        }, 3000);
      });

      $("#signin").one('dblclick', function(event) {
        event.preventDefault();
        $(this).prop('disabled', true);
      });
    </script>
    <script type="text/javascript">
      (function() {
        $('.from-prevent-multiple-submits').on('submit', function() {
          setTimeout(function() {
            $('.from-prevent-multiple-submits').attr('disabled', 'true');
          }, 10);
        })
      })();
    </script>
  </body>

</html>
