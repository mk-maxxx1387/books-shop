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
</table>
<button id='order-show'> Order book </button>
<a href="/"><input type='button' value='Go back to catalog'></a>


<div id="order-modal"><!-- Сaмo oкнo --> 
	<h2>Order book via email</h2>
    <span id="order-modal-close">X</span> <!-- Кнoпкa зaкрыть --> 
    <form id='order-form' action='' method='post' onsubmit="return false">
		<table>
		<tr>
			<td>Address: </td>
			<td>
				<input type='text' required name='order_address'>
			</td>
		</tr>
		<tr>
			<td>Full name: </td>
			<td>
				<input type='text' required name='order_full_name'>
			</td>
		</tr>
		<tr>
			<td>Books count: </td>
			<td>
				<input type='number' min='1' value='1' required name='order_books_count'>
			</td>
		</tr>
		<tr>
			<td><input type='submit' value=' Order book '></td>
			<td></td>
		</tr>
	</table>
	<input type='hidden' name='book-id' id='book-id' value='<?=$book->id;?>'>
</form>
</div>
<div id="overlay"></div><!-- Пoдлoжкa -->