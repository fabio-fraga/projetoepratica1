$('#form-comment').submit(function (e) {
    e.preventDefault();

    var us = $('#id_us').val();
    var post = $('#id_post').val();
    var comment = $('#comentario').val();
    var img = $('#img').val();
    //console.log(us, post, comment);

    $.ajax({
        url:'comentario.php',
        method: 'POST',
        data: {id_us: us, id_post:post, comentario: comment, img:img},
        dataType: 'json'
    }).done(function (result) {
        console.log(result);
    })

});





