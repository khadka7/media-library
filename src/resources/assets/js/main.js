var host = location.origin;

function tabReload() {
    setTimeout(function () {
        $("#upload-tab").removeClass("active"), $("#gallery-tab").addClass("active")
    }, 4e3)
}

function detailImage(a) {
    detailImageUrl = detailImageUrl.replace('ID', a);
    let t = $("#mediaModal");
    $.ajax({
        url: detailImageUrl,
        method: "GET",
        headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
        success: function (a) {
            t.find(".modal-title").html("Image Detail"), t.find(".modal-body").html(a.template), t.modal("toggle"), t.find(".modal-dialog").css("width", "1100px")
        }
    })
}

function deleteImage(a) {
    if (!0 === confirm("Do you want to delete this image")) {
        deleteImageUrl = deleteImageUrl.replace('ID', a);
        $.ajax({
            url: deleteImageUrl,
            method: "GET",
            headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
            success: function (a) {
                console.log("deleted")
            }
        })
    }
}

function openMedia(a) {
    let e = $("#mediaModal"), t = a.id;
    $.ajax({
        url: openModalUrl,
        method: "GET",
        headers: {accept: "application/json", "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
        success: function (a) {
            console.log("d", a), e.find(".modal-title").html("Insert Image"), e.find(".modal-body").html(a.template), e.find(".modal-footer").html('<button class="btn btn-primary" onclick="insertUrl(' + t + ')">Insert Image</button>'), e.modal("toggle"), e.find(".modal-dialog").css("width", "1100px")
        },
        error: function (a) {
            console.log(a.responseText)
        }
    })
}

function insertUrl(a) {
    console.log('this',a);
    event.preventDefault(), id = a.id;
    var e = $("#mediaModal"),
        t = $("#modal-url").val(),
        o = $("#modal-thumbnail-url").val();
    src = host + o,
        console.log(src);
    $(".img-" + id).attr("src", src),
        $("#" + id).val(t), e.modal("toggle");
}

function modalGrid() {
    $.ajax({
        url: modalGridViewUrl,
        method: "GET",
        headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
        success: function (a) {
            $("#gallery").html(a.data.template)
        }
    })
}

function imageInfo(a) {
    imageInfoUrl = imageInfoUrl.replace('ID', a);
    $.ajax({
        url: imageInfoUrl,
        method: "GET",
        headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
        success: function (a) {
            $("#modal-url").val(a.data.url).attr("readonly", "readonly"), $("#modal-filename").val(a.data.filename), $("#modal-thumbnail-url").val(a.data.thumbnail_url);
            var e = a.data.thumbnail_url, t = host + e;
            $(".image-status").attr("src", t)
        }
    })
}



