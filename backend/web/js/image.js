$('#query').change(function (){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        url: $('#search-url').val(),
        data: {
            '_csrf-backend': $('input[name="_csrf-backend"]').val(),
            'query': $(this).val()
        },
        dataType: "json",
        beforeSend: function() {
            $('#content-image-unsplash').html("Loading the images...");
        },
        success: function(data) {
            $('#content-image-unsplash').html(data.view);
        },
        error: function() {
        }
    });
});