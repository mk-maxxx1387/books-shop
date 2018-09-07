<style type="text/css">
	table {
		width: 100%;
	}
	TD, TH {
    padding: 10px; /* Поля вокруг текста */
    border: 1px solid black;
   }
</style>
<form action='index.php?action=showBooks' method='post'>
	<select name='filter_auth'>
		<option value=''>--select author--</option>
		<?foreach ($auth_list as $auth) {
			if ($auth->id == $filter_auth) {
				?><option selected value='<?=$auth->id;?>'><?=$auth->name;?></option><?
			} else {
				?><option value='<?=$auth->id;?>'><?=$auth->name;?></option><?
			}
		}?>
	</select>
	<select name='filter_genre'>
		<option value=''>--select genre--</option>
		<?foreach ($genre_list as $genre) {
			if ($genre->id == $filter_genre) {
				?><option selected value='<?=$genre->id;?>'><?=$genre->name;?></option><?
			} else {
				?><option value='<?=$genre->id;?>'><?=$genre->name;?></option><?
			}
		}?>
	</select>
	<input type='submit' value=' Filter '>
</form>
<table>
		<thead class='admin-thead'>
			<tr>
				<td>Title</td>
				<td>Author(s)</td>
				<td>Genre(s)</td>
				<td>Edit</td>
				<td>Delete</td>
			</tr>
		</thead>
<?foreach ($books as $book) {?>
		<tr>
			<td><a href='admin-mode/book/details/<?=$book->id;?>'><?=$book->name;?></a></td>
			<td>
				<?foreach ($book->authors as $auth) {?>
					<?=$auth->name;?><br>
				<?}?>
			</td>
			<td>
				<?foreach ($book->genres as $genre) {?>
					<?=$genre->name;?><br>
				<?}?>
			</td>
			<td><a href='admin-mode/book/edit/<?=$book->id;?>'>Edit</a></td>
			<td><a href='admin-mode/book/delete/<?=$book->id;?>'>Delete</a></td>
		</tr>
<?}?>
</table>
<a href="admin-mode/book/new"> Add new book </a>
