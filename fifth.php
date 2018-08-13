<?php

class CookieMaker
{
	private static  $instance = null;

    public static function getInstance()
    {
        if (null === self::$instance)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone() {}
    private function __construct() {}
    private function __wakeup() {}    

	public static function CreateCookie($a, $sec=0, $min=0, $hour=0, $day=0)
	{

		if ($sec==0 && $min==0 && $hour==0 && $day==0) {
			setcookie("cookieFirst", $a, time() +365*24*60*60);
		}
		else
		{
			setcookie("cookieFirst", $a, time() + $sec + $min*60 + $hour*3600 + $day*3600*24 );
		}

		
	}

	public static function DeleteCookie()
	{
		if (isset($_COOKIE['cookieFirst'])) {
			unset($_COOKIE['cookieFirst']);
			$timee = time()-3600;
			setcookie("cookieFirst", "", time()-10000);
		}
		else
		{
			?>
			<div style="text-align: center;">
			<?php
				echo "Значение пока не установлено!";
			?>
			</div>
			<?php
		}

	}

	public static function ReadCokie()
	{
		?>
		<div style="text-align: center;">
		<?php
			echo $_COOKIE['cookieFirst'];
		?>
		</div>
		<?php
	}

}

$cook = CookieMaker::getInstance();
function Read()
{
	if (isset($_COOKIE['cookieFirst']))
	{
		global $cook;
		$cook->ReadCokie();
	}
	else
	{
		?>
		<div style="text-align: center;">
		<?php
			echo "Значение пока не установлено!";
		?>
		</div>
		<?php
	}
}

function Delete()
{
	global $cook;
	$cook->DeleteCookie();
}

function Create()
{
	global $cook;
	if (!empty($_POST['value']) && !isset($_COOKIE['cookieFirst']))
	{
		$cook->CreateCookie($_POST['value'], $_POST['seconds'], $_POST['minuts'], $_POST['hours'], $_POST['days']);
	}
	elseif(empty($_POST['value']))
	{
		?>
		<div style="text-align: center;">
		<?php
			echo "Необходимо указать значение!";
		?>
		</div>
		<?php
	}
	else
	{
		?>
		<div style="text-align: center;">
		<?php
			echo "Значение уже  установлено!";
		?>
		</div>
		<?php
	}
}

if (isset($_POST['Read']))
{
	Read();
}

if (isset($_POST['Delete'])) 
{
	Delete();
}

if (isset($_POST['create'])) {
	Create();
}

if (isset($_POST['change'])) {
	if (isset($_COOKIE['cookieFirst'])) {
		Create();
	}
	else
	{
		?>
		<div style="text-align: center;">
		<?php
			echo "Значение пока не установлено!";
		?>
		</div>
		<?php
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Куки</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<hr>
	<div style="text-align: center; font-size: 18px;">
			<p style="font-size: 20px;"><b>Выберите, что вы хотите сделать.</b></p>
		<form method="POST">
			<p><em>Создание Cookie</em></p>
			<p>Укажите время жизни Cookie, если это необходимо. По умолчанию она будет существовать 1 год.</p>
			<input type="text" name="seconds" placeholder="Укажите количество секунд">
			<br>
			<input type="text" name="minuts" placeholder="Укажите количество минут">
			<br>
			<input type="text" name="hours" placeholder="Укажите количество часов">
			<br>
			<input type="text" name="days" placeholder="Укажите количество дней">
			<br>
			<input type="text" name="value" placeholder="Введите значение Cookie">
			<br><br>
			<input type="submit" name="create" value="Создать">
		</form>

		<form method="POST">
			<p><em> Удаление Cookie </em></p>
			<input type="submit" name="Delete" value="Удалить">
		</form>

		<form method="POST" >
			<p>Укажите новое значение Cookie, если необходимо изменить его.</p>
			<input type="text" name="value" placeholder="Введите значение Cookie">
			<br>
			<input type="submit" name="change" value="Изменить">
		</form>

		<form method="POST"">
			<p> <em> Текущее значение Cookie. </em></p>
			<input type="submit" name="Read" value="Прочитать">
		</form>
		<hr>
	</div>
	
</body>
</html>
