<form action='admin-mode/genre/save/<?=$genre->id;?>' method='post'>
	Name: <input type='text' name='genre_name' required pattern="^[A-Za-z\s]{2,30}$" value='<?=$genre->name;?>'/>
	<input type='submit' name='submit' value=' Save '/>
</form>