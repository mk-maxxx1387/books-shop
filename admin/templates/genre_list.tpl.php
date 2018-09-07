<table>
	<thead class='admin-thead'>
			<tr>
				<td>Name</td>
				<td>Edit</td>
				<td>Delete</td>
			</tr>
		</thead>
<?foreach ($genres as $genre) {?>
	<tr>
		<td><?=$genre->name;?></td>
		<td><a href='admin-mode/genre/edit/<?=$genre->id;?>'>Edit</a></td>
		<td><a href='admin-mode/genre/delete/<?=$genre->id;?>'>Delete</a></td>
	</tr>
<?}?>
</table>
<p>Add Genre</p>
<form action='admin-mode/genre/add' method='post'>
	Name: <input type='text' name='genre_name' pattern="^[A-Za-z\s]{2,30}$" required />
	<input type='submit' name=' Add '/>
</form>