<form action='admin-mode/author/save/<?=$author->id;?>' method='post'>
	Name: <input type='text' name='auth_name' pattern="^[A-Za-z\s]{2,30}$" required value='<?=$author->name;?>'/>
	<input type='submit' name='submit' value=' Save '/>
</form>