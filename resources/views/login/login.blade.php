<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   
   <!-- Public core CSS -->
    <link href="/css/forms_styles.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

  </head>
  <body class="text-center">
    <main class="form-signin">

      <!-- Route -->
      <form action="/login" method="post">
      @csrf

        <!-- Image -->
        <img class="mb-4" src="/img/logo.png" alt="" width="144" height="114">
        <h1 class="h3 mb-3 fw-normal">Please Login</h1>
        
        <!-- Error alert  -->        
        @if(session()->has('loginError'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <!-- name -->
        <div class="form-floating">
          <input type="text" class="form-control" id="nama" placeholder="Your name" name="nama" required autofocus>
          <label for="nama">Name</label>
        </div>

        <!-- username -->
        <div class="form-floating">
          <input type="text" class="form-control" id="username" placeholder="Username" name="username" required >
          <label for="username">Username</label>
        </div>

        <!-- password -->
        <div class="form-floating">
          <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
          <label for="password">Password</label>
        </div>
                
        <!-- Button -->
        <button class="w-100 btn btn-lg btn-dark" type="submit">Log in</button>

        <!-- Footer -->
        <p class="mt-5 mb-3 text-muted">By ntroxygen</p>
      </form>
    </main>

    <!-- javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
