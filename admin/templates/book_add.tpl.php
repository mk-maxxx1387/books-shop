<form action='admin-mode/book/add' method='post'>
	<table class='form-table'>
		<tr>
			<td>Title:</td>
			<td><input type='text' name='book_title' required pattern="^[A-Za-z0-9\s]{2,30}$" value=''></td>
		</tr>
		<tr>
			<td>Author(s):</td>
			<td>
				<select name='book_authors[]' multiple='multiple' required>
					<?foreach ($auth_list as $auth) {?>
					<option value='<?=$auth->id;?>'><?=$auth->name;?></option>
					<?}?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Genre(s):</td>
			<td>
				<select name='book_genres[]' multiple='multiple' required>
					<?foreach ($genre_list as $genre) {?>
					<option value='<?=$genre->id;?>'><?=$genre->name;?></option>
					<?}?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Description:</td>
			<td><textarea cols="50" rows="7" name='book_descr' required></textarea></td>
		</tr>
		<tr>
			<td>Price:</td>
			<td><input type='number' name='book_price' required value=''></td>
		</tr>
		<tr>
			<td><input type='submit' value=' Add '></td>
			<td><a href="/"><input type='button' value='Go back'></a></td>
		</tr>
	</table>
</form>