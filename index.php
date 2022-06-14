<!DOCTYPE html>
<html>
  <head>
    <meta charset = "utf-8">
    <title>login&register demo</title>
    <link rel="stylesheet" href="http://unpkg.com/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/login&register.css">
  </head>
  <body>
    <header class = "clear-float">
      <a class = "icon"><i class = "fa fa-user-circle"></i></a>
    </header>
    <main>
      <div class="flip-model">
        <!-- below is for login -->

        <div class="model model-login">
          <div class="tab">
            <a class="tab-login active">Sign in</a>
          </div>
          <div class="error-content">warm tips </div>
          <!-- this form is the sign in form -->

          <form id="login">
            <div class = "input username">
              <a href="#" class="icon"><i class = "fa fa-user-o"></i></a>
              <input type="text" name="username" placeholder = "User Name">
            </div>
            <div class="input password">
              <a href="#" class="icon"><i class = "fa fa-lock"></i></a>
              <input type="password" name="password" placeholder = "Password">
            </div>
            <div class="submit">
              <input type="submit" name="submit" value = "Sign in">
            </div>
          </form>

        </div>
      </div>
    </main>
    <footer></footer>
    <script src="./javascript/login&register.js" ></script>
  </body>
</html>
