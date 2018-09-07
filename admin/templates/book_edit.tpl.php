<form action='admin-mode/book/save/<?=$book->id;?>' method='post'>
	<table class='form-table'>
		<tr>
			<td>Title:</td>
			<td><input type='text' name='book_title' required pattern="^[A-Za-z0-9\s]{2,30}$" value='<?=$book->name;?>'></td>
		</tr>
		<tr>
			<td>Author(s):</td>
			<td>
				<select name='book_authors[]' multiple='multiple' required>
					<?foreach ($auth_list as $auth) {
						$flag = false;
						foreach ($book->authors as $auth_sel) {
							if ($auth->id == $auth_sel->id) {
								?><option selected value='<?=$auth->id;?>'><?=$auth->name;?></option><?
								$flag = true;
							} else {
								next;
							}
						}
						if ($flag == false) {
							?><option value='<?=$auth->id;?>'><?=$auth->name;?></option><?
						}
					}?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Genre(s):</td>
			<td>
				<select name='book_genres[]' multiple='multiple' required>
					<?foreach ($genre_list as $genre) {
						$flag = false;
						foreach ($book->genres as $genre_sel) {
							if ($genre->id == $genre_sel->id) {
								?><option selected value='<?=$genre->id;?>'><?=$genre->name;?></option><?
								$flag = true;
							} else {
								next;
							}
						}
						if ($flag == false) {
							?><option value='<?=$genre->id;?>'><?=$genre->name;?></option><?
						}
					}?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Description:</td>
			<td><textarea cols="50" rows="7" name='book_descr' required><?=$book->descr;?></textarea></td>
		</tr>
		<tr>
			<td>Price:</td>
			<td><input type='number' name='book_price' required value='<?=$book->price;?>'></td>
		</tr>
		<tr>
			<td><input type='submit' value=' Save '></td>
			<td><a href="admin-mode/"><input type='button' value='Go back'></a></td>
		</tr>
	</table>
</form>