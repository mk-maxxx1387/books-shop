<table>
	<tr>
		<td>Title: </td>
		<td><?=$book->name;?></td>
	</tr>
	<tr>
		<td>Author(s): </td>
		<td>
		<?foreach ($book->authors as $auth) {?>
			<p><?=$auth->name;?></p>
		<?}?>
		</td>
	</tr>
	<tr>
		<td>Genre(s): </td>
		<td>
		<?foreach ($book->genres as $genre) {?>
			<p><?=$genre->name;?></p>
		<?}?>
		</td>
	</tr>
	<tr>
		<td>Description: </td>
		<td><?=$book->descr;?></td>
	</tr>
	<tr>
		<td>Price: </td>
		<td><?=$book->price;?></td>
	</tr>
	<tr>
		<td></td>
		<td><a href="admin-mode/"><input type='button' value='Go back'></a></td>
	</tr>
</table>
