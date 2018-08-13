<!DOCTYPE html>
<html>
<head>
	<title>Запросы</title>
</head>
<body>
	<div style="font-size: 20px; text-align: center;">
		<p style="font-size: 24px;"><b>Выберите, какой запроc к базе нужно выполнить:</b></p>
		<p>1) Выводит название отделов, в которых имеется 5 и более сотрудников</p>
		<p>2) Выводит 2 столбца, в первом выводится название отдела, во втором id всех сотрудников
данного отдела, перечисленные через запятую.</p>
		<form method="POST">
		<input type="text" name="id">
		<input type="submit" name="">
	</form>
	</div>
	
</body>
</html>

<?php
$host = 'localhost'; 
$database = 'second'; 
$user = 'root'; 
$dbcon = @mysql_connect($host,$user);
	if (!$dbcon)
	{
		?>
			<div style="text-align: center;">
				<?php
					echo "Невозможно получить доступ к данным!";
				?>
			</div>
		<?php
	}
	else
	{
		$dataBaseConn = @mysql_select_db($database, $dbcon);
		if (!$dataBaseConn)
		{
			?>
				<div style="text-align: center;">
					<?php
						echo "Ошибка подключения к базе данных!";
					?>
				</div>
			<?php
		}
		else
		{
			if (!empty($_POST['id'])) {
				if ($_POST['id']=="1")
				{
					$sql = "select name, id from department where (select count(*) from worker where department_id=department.id)=5 LIMIT 0, 30 ";
					$try = mysql_query($sql);
					while ($row = mysql_fetch_assoc($try)) {
			    		 $s = $row['name'];
			    		 if (!empty($s)) {
							?>
								<br>
								<div style="text-align: center; font-size: 20px;">
									<?php
										echo $s;
									?>
								</div>
							<?php
			    		 }
			    		 else
			    		 {
			    		 	?>
			    		 		<br>
								<div style="text-align: center; font-size: 20px;">
									<?php
										echo "Не найдено!";
									?>
								</div>
							<?php
			    		 }
			    		 
			   	    };
				}
				elseif ($_POST['id']=="2") 
				{

					$sql = "SELECT department.name, group_concat(worker.id) from department inner join worker on department.id=worker.department_id group by name LIMIT 0, 30 ";
					$try = mysql_query($sql);
					?>
					<br>
					<div style="text-align: center; font-size: 20px;">
						<br>
					<table style="margin-left: 45%; border: 1px solid #000000;">
					<?php
					while ($row = mysql_fetch_assoc($try)) {
			    		 $name = $row['name'];
			    		 $ids = $row['group_concat(worker.id)'];
			    		 if (!empty($name) && !empty($ids)) {
							?>
										<tr>
											<td  style="border: 1px solid #000000;">
												<?php
													echo $name;
												?>
											</td>
											<td  style="border: 1px solid #000000;">
												<?php
													echo $ids;
												?>
											</td>
										</tr>
							<?php
			    		 }
			    		 else
			    		 {
			    		 	?>
			    		 		<br>
								<div style="text-align: center; font-size: 20px;">
									<?php
										echo "Не найдено";
									?>
								</div>
							<?php
			    		 }
			    		 
			   	    };
			   	    ?>
			   		</table>				
					</div>
			   	    <?php
				}
				else
				{
					?>
					<div style="text-align: center; font-size: 20px; ">
						<br>
						<?php
							echo "Некорректное значение, необходимо ввести номер оперции!";
						?>
					</div>
					<?php
				}
			}
			else
			{
				?>
				<div style="text-align: center;font-size: 20px; ">
					<br>
					<?php
						echo "Необходимо указать номер операции!";
					?>
				</div>
				<?php				
			}
		}
	}
?>