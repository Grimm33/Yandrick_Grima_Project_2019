import Book from './book.js'

let booksArray = new Array();
let count = 0;

$(document).ready(function(){
    //#region initialisations for Materialize components
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('.modal').modal();

    //#endregion


    $('#button').click(function(){
        ApiCall(0, 10)
    });

    $('#modalBooks').click(function(){
        //get info of modal
    })

})

function ApiCall(offset, maxResults){
    let search = $('#search').val();

    $.ajax({
        url: `https://www.googleapis.com/books/v1/volumes?q=${search}&startIndex=${offset}&maxResults=${maxResults}`,
        dataType: "json",

        error: function(){
            $("#results").html("<h2>ERROR!!</h2>");
        },

        success: function(data){
            try {
                let cols = 4;


                for(var i = 0; i<data.items.length; i++){
                    let volumeInfo = data.items[i].volumeInfo

                    //Get title
                    let title = volumeInfo.title

                    //Get authors
                    let authors = [];
                    if(volumeInfo.authors){
                        $.each(volumeInfo.authors, function(i, v){
                            authors.push(v);
                        })
                    }else{
                        authors.push(volumeInfo.author)
                    }

                    //Get industry identifiers: isbn, stanford, oxford etc
                    let isbn = {}
                    if(volumeInfo.industryIdentifiers){
                        $.each(volumeInfo.industryIdentifiers, function(i, v){
                            isbn[v.type] = v.identifier
                        })
                    }

                    let idens = ""
                    Object.keys(isbn).forEach(function(key){
                        idens+= `<p>${key}: ${isbn[key]}</p>`
                    })

                    //if book does not have an image, use default image
                    let img
                    if(volumeInfo.imageLinks){
                        img = volumeInfo.imageLinks.thumbnail
                    }else{
                        img = "./images/image-not-available.jpg"
                    }
                    
                    let a = new Book(count, title, authors, isbn, img)
                    booksArray.push(a)


                    //show all results in 4 columns
                    if(count % cols == 0){
                        $('#results').append('<div class="row"></div>')
                    }
                    $('#results .row:last').append(`<div class="col s6 m3 bookCard modal-trigger" href="#modalBooks">
                        <div class="card">
                            <div class="card-image">
                                <img src="${img}">
                            </div>
                            <div class="card-content">
                                <span class="card-title book-list" id="book-${count}">${$('.book-list')[0]}</span>
                                <p>${authors.join(", ")}</p>
                            </div>
                        </div>
                    </div>`);
                    count++;
                }
            } catch (error) {
                console.log(error)
            }
        },
        type: "GET"
    })
    
    console.log(booksArray)
}

