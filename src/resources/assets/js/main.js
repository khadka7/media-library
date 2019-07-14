/*
 Main Js for media library by - Sanjay Khadka (khadka.sk7@gmail.com)
*/


var host = location.origin;
var mediaCreateUrl = host+'/media/create';
var mediaListUrl = host+'/medias/list';
var mediaAddUrl = host+'/media/add';
var ajaxMediaListUrl = host+'/ajax/medias';
var modalGridViewUrl = host+'/ajax/medias/modal/gird-view';
var openModalUrl = host+'/ajax/open-modal';
var searchMediaUrl = host+'/ajax/media/search';


function tabReload() {
    setTimeout(function () {
        $('#upload-tab').removeClass('active')
        $("#gallery-tab").addClass('active')
    }, 4000);
}



function detailImage(uuid) {
    var url = host+'/media/'+uuid+'/detail';

    let modal = $('#myModal');
    $.ajax({
        url:url,
        method:'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function (data) {
            modal.find('.modal-title').html('Image Detail');
            modal.find('.modal-body').html(data.template);
            modal.modal('toggle');
            modal.find(".modal-dialog").css('width', '1100px');
        }
    });
}

//delete image
function deleteImage(uuid) {
    var confirmMessage = confirm('Do you want to delete this image');
    if (confirmMessage === true){
        var delUrl = host+'/media/'+uuid+'/delete';
        delUrl = delUrl.replace('UUID',uuid);
        $.ajax({
            url: delUrl,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                console.log('deleted');
            }
        });
    }
}

//opening modal form input
function openMedia() {
    let modal = $('#myModal');
    $.ajax({
        url: openModalUrl,
        method: 'GET',
        headers: {
            "accept": "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            modal.find('.modal-title').html('Insert Image');
            modal.find('.modal-body').html(data.template);
            modal.find('.modal-footer')
                .html('<button class="btn btn-primary" onclick="insertUrl(event)" ">Insert Image</button>');
            modal.modal('toggle');
            modal.find(".modal-dialog").css('width', '1100px');
        },
        error: function (err) {
            console.log(err.responseText)
        }
    });
}

//on clicking image and adding value to input
function insertUrl(e) {
    e.preventDefault();
    var modal = $('#myModal');
    var extractedUrl = $("#modal-url").val();
    $("#url").val(extractedUrl);
    modal.modal('toggle');
}

$("#searchFile").on('keyup', function () {
    var name = $(this).val();
    var url = searchMediaUrl;
    $.ajax({
        url: url,
        method: 'GET',
        data: {filename: name},
        dataType: 'json',
        success: function (data) {
            $("#media").html(data.data.template);
        }
    })

});


function modalGrid() {
    $.ajax({
        url: modalGridViewUrl,
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $("#gallery").html(data.data.template);
        }
    });
}

function imageInfo(uuid) {
    var url = host+'/media/'+uuid+'/info';
    $.ajax({
        url: url,
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('#modal-url').val(data.data.url).attr('readonly', 'readonly');
            $('#modal-filename').val(data.data.filename);
            var thumb_url = data.data.thumbnail_url;
            var source = host+thumb_url;
            $('.image-status').attr('src', source);
        }
    });
}