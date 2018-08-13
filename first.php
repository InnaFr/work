<?php
session_start();
$categories = array(
	array(
		"id" => 1,
		"title" => "Обувь",
		'children' => array(
				array(
				'id' => 2,
				'title' => 'Ботинки',
				'children' => array(
						array('id' => 3, 'title' => 'Кожа'),
						array('id' => 4, 'title' => 'Текстиль'),
									),
					 ),
				array('id' => 5, 'title' => 'Кроссовки',),
		)
	),

	array(
		"id" => 6,
		"title" => "Спорт",
		'children' => array(
				array(
				'id' => 7,
				'title' => 'Мячи'
					)
		)
	),
);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Первое задание</title>
</head>
<body>
	<div style="text-align: center;">
		<p style="font-size: 30px;"><b><em>Hello</em></b></p>
		<form method="POST">
		<input style="font-size: 18px;" type="text" name="id" placeholder="Введите id" >
		<input style="font-size: 18px;" type="submit" name="" value="Нажми">
	</form>
	</div>

</body>
</html>

<?php
$a = "empty";
if(!empty($_POST['id']))
{
	$id = $_POST['id'];
	?>
	<br>
	<?php
	searchCategory($categories, $id);
}
else
{
	?>
		<div style="text-align: center; font-size: 18px;">
	<?php
	echo "Необходимо указать id категории";
	?>
		</div>
	<?php
}


function searchCategory($category, $id)
{
	global $a;
	foreach ($category as $value) {
		if ($value['id']==$id)
		{
			
			$a=$value['title'];
		}
		else
		{
			if (count($value['children'])!=0)
			{
				Recursia($value['children'], $id);
			}
		}
	}

	if ($a!="empty")
	{
		?>
			<div style="text-align: center; font-size: 18px;">
		<?php
			echo $a;
		?>
			</div>
		<?php
	}
	else
	{ 
		?>
			<div style="text-align: center; font-size: 18px;">
		<?php
			echo "Элемент с таким id не найден";
		?>
			</div>
		<?php
	}
}

function Recursia($category, $id)
{
	foreach ($category as $value) {
		if ($value['id']==$id)
		{
			global $a;
			$a=$value['title'];
		}
		else
		{
			if (count($value['children'])!=0)
			{
				Recursia($value['children'], $id);
			}
		}
	}
}
?>

