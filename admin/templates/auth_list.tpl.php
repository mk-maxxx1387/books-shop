<table>
	<thead class='admin-thead'>
		<tr>
			<td>Name</td>
			<td>Edit</td>
			<td>Delete</td>
		</tr>
	</thead>
<?foreach ($authors as $auth) {?>
		<tr>
			<td><?=$auth->name;?></td>
			<td><a href='admin-mode/author/edit/<?=$auth->id;?>'>Edit</a></td>
			<td><a href='admin-mode/author/delete/<?=$auth->id;?>'>Delete</a></td>
		</tr>
<?}?>
</table>
<p>Add Author</p>
<form action='admin-mode/author/add' method='post'>
	Name: <input type='text' name='name' pattern="^[A-Za-z\s]{2,30}$" required />
	<input type='submit' name='submit' value=' Add '/>
</form>