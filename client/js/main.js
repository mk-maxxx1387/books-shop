const baseUrl = 'http://192.168.0.15/~user3/books-shop/client/';

$(document).ready(function() {
    
    getAllBooks();
    buildFilter();

    $('#filter-book').submit(function(event) {
        var request;
        event.preventDefault();
        var values = $(this).serialize();

        request = $.ajax({
            url: baseUrl+"api/book/",
            type: "get",
            data: values
        });

        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            var obj = $.parseJSON(response);
            buildBooksTable(obj);
        });

        request.fail(function (){
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });
    });

    $('#order-form').submit(function(event) {
        var request;
        event.preventDefault();
        var values = $(this).serialize();
        var bookId = $("input#book-id").val();

        request = $.ajax({
            url: baseUrl+"api/order/"+bookId,
            type: "post",
            data: values
        });

        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            $('#order-modal-close').click();
        });

        request.fail(function (){
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });
    });

    $('#order-show').click( function(event){
        event.preventDefault(); 
        $('#overlay').fadeIn(400,
            function(){
                $('#order-modal') 
                    .css('display', 'block')
                    .animate({opacity: 1, top: '30%'}, 200); 
        });
    });
    
    $('#order-modal-close, #overlay').click( function(){
        $('#order-modal')
            .animate({opacity: 0, top: '45%'}, 200, 
                function(){
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
    });
});


/////////////////////FUNCTIONS////////////////
function getAllBooks () {
	var request = $.ajax({
        url: baseUrl+"api/book/",
        type: "get",
    });

    request.done(function (response, textStatus, jqXHR){
        //console.log(response);
        var obj = $.parseJSON(response);
        buildBooksTable(obj);
    });

    request.fail(function (jqXHR, textStatus, errorThrown){
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

    request.always(function () {
    });
}

function getAllAuthors() {
    var request = $.ajax({
        url: baseUrl+"api/author/",
        type: "get",
    });

    request.done(function (response, textStatus, jqXHR){
        localStorage.setItem('authors', response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown){
        console.log(jqXHR.status);
        console.log(textStatus);
        
    });

    request.always(function () {
    });
}

function getAllGenres() {
    var request = $.ajax({
        url: baseUrl+"api/genre/",
        type: "get",
    });

    request.done(function (response, textStatus, jqXHR){
        localStorage.setItem('genres', response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown){
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });


    request.always(function () {
    });
}

function bookOrder () {
    
}

function buildBooksTable(books){
    $('#t-b-book-list').html('');
    $.each(books, function() {
        var DataCell = $('<tr/>');
        var NameTd = $('<td/>');
        var AuthTd = $('<td/>');
        var GenreTd = $('<td/>');
        var auth = this.authors;//$.parseJSON(this.authors);
        var genr = this.genres;//$.parseJSON(this.genres);
        var link = $('<a/>', {text:this.name, "href":"book/details/"+this.id});

        $.each(auth,function(){
            AuthTd.append(
                $('<p/>',{
                    text:this.name
                })
            );
        });

        $.each(genr,function(){
            GenreTd.append(
                $('<p/>',{
                    text:this.name
                })
            );
        });

        DataCell.append(
            NameTd.append(link),
            AuthTd,
            GenreTd,
        );
        
        $('#t-book-list').append(DataCell);
    });
}

function buildFilter(){
    if(!localStorage.getItem('authors')){
        getAllAuthors();
    }
    if(!localStorage.getItem('genres')){
        getAllGenres();
    }

    let authors = localStorage.getItem('authors');
    let genres = localStorage.getItem('genres');
    
    $.each(JSON.parse(authors),function() {
        $('#filter-auth').append(
            $('<option/>', {
                val:  this.id,
                text: this.name
            })
        );
    });

    $.each(JSON.parse(genres),function() {
        $('#filter-genre').append(
            $('<option/>', {
                val:  this.id,
                text: this.name
            })
        );
    });
}

