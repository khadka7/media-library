var host = location.origin;

function tabReload() {
    setTimeout(function () {
        $("#upload-tab").removeClass("active"), $("#gallery-tab").addClass("active")
    }, 4e3)
}

function detailImage(a) {
    detailImageUrl = detailImageUrl.replace('ID',a);
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
        deleteImageUrl = deleteImageUrl.replace('ID',a);
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

function openMedia(obj) {
    console.log(obj);
    let a = $("#mediaModal");
    $.ajax({
        url: openModalUrl,
        method: "GET",
        headers: {accept: "application/json", "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
        success: function (e) {
            a.find(".modal-title").html("Insert Image"),
                a.find(".modal-body").html(e.template),
                a.find(".modal-footer").html('<button class="btn btn-primary" onclick="insertUrl(event)" ">Insert Image</button>'),
                a.modal("toggle"), a.find(".modal-dialog").css("width", "1100px")
        },
        error: function (a) {
            console.log(a.responseText)
        }
    })
}

function insertUrl(a) {
    a.preventDefault();
    var e = $("#mediaModal"),
        t = $("#modal-url").val(),
        l = $("#modal-thumbnail-url").val();
    console.log(l);
    src = host + l,
        $(".media-image-thumb").attr("src", src), $("#url").val(t), e.modal("toggle")
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
    imageInfoUrl = imageInfoUrl.replace('ID',a);
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

$("#searchFile").on("keyup", function () {
    var a = $(this).val(), e = searchMediaUrl;
    $.ajax({
        url: e, method: "GET", data: {filename: a}, dataType: "json", success: function (a) {
            $("#media").html(a.data.template)
        }
    })
});
