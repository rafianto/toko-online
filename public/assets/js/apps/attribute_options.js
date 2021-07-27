const TOKEN = $('meta[name="csrf-token"]').attr("content");

if ($("#option_id").val() == null || $("#option_id").val() == "") {
    $("#title-card-header").text("Add Attribute Option");
}

$("#clear").on("click", () => {
    $("#title-card-header").text("Add Attribute Option");
    $("#option_id").val(null);
    $("#name").val(null);
});

function viewData(optionId, OptionName) {
    // mengambil input type hidden option_id
    $("#title-card-header").text("Update Attribute Option");
    // assign option id
    let id = $("#option_id").val(optionId);
    let name = $("#name").val(OptionName);
}

$("#saveOption").on("click", () => {
    NProgress.configure({ showSpinner: true });
    NProgress.start();
    let data = $("#formAttributeOption").serializeArray();
    let attributeId = $("#saveOption").attr("data-attributeId");
    let name = $("input[name='name']").val()
        ? $("input[name='name']").val()
        : null;
    data.push({ name: "attribute_id", value: attributeId });
    if (name == null) {
        Swal.fire({
            icon: "error",
            title: "Ops...",
            text: "The field name is required.",
            // footer: '<a href="">Why do I have this issue?</a>',
        });
        NProgress.done();
        return false;
    }

    // lolo pengecekan
    $.ajax({
        url: `${postUrl}`,
        method: "POST",
        data: data,
        success: function (data) {
            NProgress.done();
            Swal.fire({
                icon: "success",
                title: `SUCCESS`,
                text: `${data.message}`,
                // footer: '<a href="">Why do I have this issue?</a>',
            });
            $("#input[name='option_id']").val(null);
            $("#input[name='name']").val(null);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            NProgress.done();
            if (xhr.status == 422) {
                Swal.fire({
                    icon: "error",
                    title: `${xhr.statusText}`,
                    text: `${xhr.responseJSON.errors.name[0]}`,
                    // footer: '<a href="">Why do I have this issue?</a>',
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: `${xhr.status}`,
                    text: `${thrownError}`,
                    // footer: '<a href="">Why do I have this issue?</a>',
                });
            }
            return false;
        },
    });
});

// Function Delete Data Customer
function deleteData(id) {
    $.ajax({
        type: "DELETE",
        url: "product/" + id,
        data: {
            _method: "DELETE",
            _token: TOKEN,
            id: id,
        },
        success: function (result) {
            toastr.success("Data has been deleted");
        },
        error: function (jqXHR, error, errorThrown) {
            if (jqXHR.status && jqXHR.status == 400) {
                toastr.error(jqXHR.responseText);
            } else {
                toastr.error("Something Went Wrong");
            }
        },
    });
}

// Delete Event
$(document).on("click", "#btn-delete", function () {
    let id = $(this).attr("data-id");
    let attributeId = $(this).attr("data-attributeId");
    Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this data!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, keep it",
    }).then((result) => {
        if (result.isConfirmed) {
            deleteData(id);
        }
    });
});
