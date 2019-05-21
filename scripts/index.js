let count = 0;

$(function(){
    //#region initialisations for Materialize components
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('.modal').modal();
    //#endregion

    $('#button').click(function(){
        MainSearch(0, 40)
    });

    $('.container').on('click', '.bookCard', function(){
        let res = $(this).prop('id')
        console.log(res)
        SearchToAddToCart(res)
    })

    ShowInfoInCart()

})

function ShowInfoInCart(){
    $('img.cardImage').each(function(i, obj){
        let bookId = $(this).attr('id');

        console.log(`id in img = ${bookId}`)

        $.ajax({
            url: `https://www.googleapis.com/books/v1/volumes?q=id:${bookId}`,
            dataType: 'json',
            error: function(){
                console.log("error")
            },
            success: function(data){
                if(data.items){
                    let volumeInfo = data.items[0].volumeInfo

                    let imgCard = "./images/image-not-available.jpg"
                    if(volumeInfo.imageLinks){
                        imgCard = volumeInfo.imageLinks.thumbnail
                    }
    
                    let title = volumeInfo.title
                    console.log(title)
    
                    $(`#${bookId}`).attr('src', imgCard);
                    $(`h3#${bookId}`).html(title)
                }else{
                    console.log("Not found!")
                }                
            }
        })
    })
}

function SearchToAddToCart(bookId){
    $('#results').empty();

    $.ajax({
        url: `https://www.googleapis.com/books/v1/volumes?q=id:${bookId}`,
        dataType: 'json',
        error: function(){
            console.log("error")
        },
        success: function(data){
            console.log(data)

            let volumeInfo = data.items[0].volumeInfo

            let title = volumeInfo.title

            let authors = [];
            if(volumeInfo.authors){
                $.each(volumeInfo.authors, function(i, v){
                    authors.push(v);
                })
            }else{
                authors.push(volumeInfo.author)
            }

            let isbn = {}
            if(volumeInfo.industryIdentifiers){
                $.each(volumeInfo.industryIdentifiers, function(i, v){
                    isbn[v.type] = v.identifier
                })
            }

            let img
            if(volumeInfo.imageLinks){
                img = volumeInfo.imageLinks.thumbnail
            }else{
                img = "./images/image-not-available.jpg"
            }

            let price = Math.floor(Math.random()*(30 - 9 + 1)) + 9 //random price beweteen 9 and 30 euros

            $("#results").html(`
            <h1>${title}</h1>
            <h3>${authors.join(", ")}</h3>
            <img src=${img}>
            <p>Price: ${price}</p>
            <form action="addToCart.php" method="post">
                <input type="hidden" name="bookId" value="${bookId}">
                <input type="hidden" name="bookPrice" value="${price}">
                <button class="waves-effect btn btn-large" name="subCart">Add To Cart</button>
            </form>
            `)
        }
    })

}

function MainSearch(offset, maxResults){
    let search = $('#search').val();
    $('#results').empty();

 
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

                    //show all results in 4 columns
                    if(count % cols == 0){
                        $('#results').append('<div class="row"></div>')
                    }
                    $('#results .row:last').append(`<div class="col s6 m3 bookCard" id="${data.items[i].id}">
                        <div class="card">
                            <div class="card-image">
                                <img src="${img}">
                            </div>
                            <div class="card-content">
                                <span class="card-title">${title}</span>
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
}

