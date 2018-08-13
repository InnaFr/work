<?php
session_start();
$arr = array ("<a>", "<b>", "</b>", "<em>", "</em>", "</a>");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Тэги</title>
</head>
<body>
	<div style="text-align: center;">
		<p><em><b>Исходные данные массива:</b></em></p>
		<p>
			<?php
			foreach ($arr as $value) {
				echo htmlspecialchars($value);
			}
			?>
		</p>
		<p><em>Проверка на корректность</em></p>
		<form method="POST">
			<input type="submit" name="check" value="Обработать массив">
		</form>
	</div>
</body>
</html>
<?php
function Tegs($arr){
$arrOpen = array();
if ($arr[0][1]=="/") {
	echo "Ошибка.";
}
else
{
	foreach ($arr as  $value) {
		if ($value[1]!="/") {
			array_push($arrOpen, $value);
		}
		else
		{
			$a = substr($value, 2, count($value)-2);
			$a_1 = substr($arrOpen[count($arrOpen)-1], 1, count($arrOpen[count($arrOpen)-1])-2);
			if ($a==$a_1) 
			{
				array_pop($arrOpen);
			}
			else
			{
				$_SESSION['error'] = "true";
				break;
			}
		}
	}
	?>
	<hr>
	<div style="text-align: center;">
		<?php
		if (count($arrOpen)==0 && !isset($_SESSION['error']))
		{
			echo "ВСе хорошо, струкрура корректна.";
		}
		else
		{
			echo "Ошибка.";
		}
		?>
	</div>
	<?php
}


}
if (isset($_POST['check'])) {
	unset($_SESSION['error']);
	Tegs($arr);
}

?>