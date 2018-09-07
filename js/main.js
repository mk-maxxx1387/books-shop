$(document).ready(function() {
	getAllBooks();

    $('#filter-book').submit(function(event) {
        var request;
        event.preventDefault();
        var values = $(this).serialize();

        request = $.ajax({
            url: "api/book/all",
            type: "post",
            data: values
        });

        request.done(function (response, textStatus, jqXHR){
            console.log(response);
            var obj = $.parseJSON(response);
            buildBooksTable(obj['books']);
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
            url: "api/book/order/"+bookId,
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
                function(){ // пoсле aнимaции
                    $(this).css('display', 'none'); // делaем ему display: none;
                    $('#overlay').fadeOut(400); // скрывaем пoдлoжку
                }
            );
    });

    //initFilter();
});


/////////////////////FUNCTIONS////////////////
function getAllBooks () {
	var request = $.ajax({
        url: "api/book/all",
        type: "get",
        //data: serializedData
    });

    request.done(function (response, textStatus, jqXHR){
        //console.log(response);
        var obj = $.parseJSON(response);
        buildBooksTable(obj['books']);
        buildFilter(obj['auth_list'], obj['genre_list']);
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
    $.each(books,function() {
            var DataCell = $('<tr/>');
            var NameTd = $('<td/>');
            var AuthTd = $('<td/>');
            var GenreTd = $('<td/>');
            var auth = $.parseJSON(this.authors);
            var genr = $.parseJSON(this.genres);
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

function buildFilter (authors, genres) {
    $.each(authors,function() {
        $('#filter-auth').append(
            $('<option/>', {
                val:  this.id,
                text: this.name
            })
        );
    });
    $.each(genres,function() {
        $('#filter-genre').append(
            $('<option/>', {
                val:  this.id,
                text: this.name
            })
        );
    });
}

