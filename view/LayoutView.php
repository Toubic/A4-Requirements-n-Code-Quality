<?php


class LayoutView {
  
  public function render(LoginView $v, DateTimeView $dtv) {

      if(!isset($_SESSION['isLoggedIn']) || $v->isLoggedOut())
          $isLoggedIn = "No";
      elseif ($v->login($v->getRequestUserName(), $v->getRequestPassword()))
          $isLoggedIn = "Yes";
      else
          $isLoggedIn = $_SESSION['isLoggedIn'];

      echo '<!DOCTYPE html>
          <html>
            <head>
              <meta charset="utf-8">
              <title>Login Example</title>
            </head>
            <body>
              <h1>Assignment 2</h1>
              ' . $this->renderIsLoggedIn($isLoggedIn) . '
              
              <div class="container">
                  ' . $v->response() . '
                  
                  ' . $dtv->show() . '
              </div>
             </body>
          </html>
      ';
  }

  private function renderIsLoggedIn($isLoggedIn) {

      if ($isLoggedIn === "Yes")
          return '<h2>Logged in</h2>';
      if ($isLoggedIn === "No")
          return '<h2>Not logged in</h2>';
      else
          return '<h2>Logged in</h2>';
  }
}
