<?php

class RegisterView
{
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';
    private static $messageId = 'RegisterView::Message';
    private static $register = 'RegisterView::Register';
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function generateRegisterNewUserHTML($message){

        // If valid username has been entered but password is missing then fill in the username again automatically:
        if(isset($_POST[self::$name]) && strlen($_POST[self::$name]) >= 3 && $_POST[self::$password] === "")
            $username = $_POST[self::$name];
        // If short username has been entered but passwords are valid then fill in the username again automatically:
        elseif(isset($_POST[self::$password]) && $_POST[self::$password] === $_POST[self::$passwordRepeat] &&
            strlen($_POST[self::$password]) >= 6 &&
            strlen($_POST[self::$name]) <=3 && strlen($_POST[self::$name]) > 0){
            $username = $_POST[self::$name];
        }
        // If valid username has been entered but passwords are invalid then fill in the username again automatically:
        elseif(isset($_POST[self::$password]) && $_POST[self::$password] === $_POST[self::$passwordRepeat] &&
            strlen($_POST[self::$password]) < 6 && strlen($_POST[self::$password]) > 0 &&
            strlen($_POST[self::$name]) >= 3){
            $username = $_POST[self::$name];
        }
        else
            $username = "";

        return '
			<form method="post" > 
				<fieldset>
					<legend>Register - enter wanted username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Enter username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="'.$username.'" />
                    <br>
					<label for="' . self::$password . '">Enter password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
                    <br>
					<label for="' . self::$passwordRepeat . '">Repeat password :</label>
					<input type="password" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" />
					<br>
					<input type="submit" name="' . self::$register . '" value="Register" />
				</fieldset>
			</form>
		';
    }
    public function getRegisterUserName() {
        //RETURN REQUEST VARIABLE: USERNAME
        if(isset($_POST[self::$name]))
            return $_POST[self::$name];
    }
    public function getRegisterPassword() {
        //RETURN REQUEST VARIABLE: PASSWORD
        if(isset($_POST[self::$password]))
            return $_POST[self::$password];
    }
    public function getRegisterRepeatPassword() {
        //RETURN REQUEST VARIABLE: PASSWORD
        if(isset($_POST[self::$passwordRepeat]))
            return $_POST[self::$passwordRepeat];
    }
    public function getRegister() {
        //RETURN REQUEST VARIABLE: PASSWORD
        return isset($_POST[self::$register]);
    }
}