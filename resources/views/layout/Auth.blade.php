<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title') – Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4.5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body { margin-top: 20px; background: #f6f9fc; }
    .account-block {
      padding: 0;
      background-image: url(https://bootdey.com/img/Content/bg1.jpg);
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
      height: 100%;
    }
    .overlay {
      position: absolute; top:0; bottom:0; left:0; right:0;
      background-color: rgba(0,0,0,0.4);
    }
    .account-testimonial {
      position: absolute; bottom:3rem; left:0; right:0;
      text-align:center; color:#fff; padding:0 1.75rem;
    }
    .text-theme { color: #5369f8!important; }
    .btn-theme {
      background-color: #5369f8; border-color: #5369f8; color: #fff;
    }
    </style>
</head>
<body>
  <div id="main-wrapper" class="container">
    @yield('content')
  </div>

  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
