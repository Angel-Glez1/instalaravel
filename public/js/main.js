var url = 'http://instalaravel.com';

window.addEventListener('load', function () {

    $('.btn-dislike').css('cursor', 'pointer');
    $('.btn-like').css('cursor', 'pointer');


    //Me hace un like
    function dislike() {
        $('.btn-dislike').unbind('click').click(function () {
            // console.log("like");
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', 'img/like.png');
            like();
            $.ajax({

                url: url + '/like/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('Diste like');
                    } else {
                        console.log('Error al dar like')
                    }
                }
            });
        });
    }
    dislike();



    //Me hace un like
    function like() {
        $('.btn-like').unbind('click').click(function () {
            // console.log("dislike");
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', 'img/dislike.png');
            dislike();

            $.ajax({

                url: url + '/dislike/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {

                    if (response.like) {
                        console.log('Diste dislike');
                    } else {
                        console.log('Error al dar dislike')
                    }

                }
            });

        });
    }
    like();

    // Buscador de gente
    $('#buscador').submit(function (e) {
        // e.preventDefault();
        $(this).attr('action', url + '/users/profiles/' + $('#buscador #search').val());


    });

})
