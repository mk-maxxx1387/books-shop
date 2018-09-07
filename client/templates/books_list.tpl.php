<style type="text/css">
	
</style>
<form id='filter-book' onsubmit="return false">
	<select name='filter_auth' id='filter-auth'>
		<option value=''>--select author--</option>
		
	</select>
	<select name='filter_genre' id='filter-genre'>
		<option value=''>--select genre--</option>
		
	</select>
	<input id='filter-submit' type='submit' value=' Filter '>
</form>
<table id='t-book-list'>
	<thead>
		<tr>
			<td>Title</td>
			<td>Author(s)</td>
			<td>Genre(s)</td>
		</tr>
	</thead>
	<tbody id='t-b-book-list'></tbody>
</table>
