/// select 2
$(".js-example-basic-single").select2();

const TOKEN = $('meta[name="csrf-token"]').attr("content");

// Fetch Data Function
function fetchDataSearch(page, query, size) {
    $.ajax({
        method: "GET",
        url:
            "/admin/master/category/search?page=" +
            page +
            "&size=" +
            size +
            "&keyword=" +
            query,
        success: function (data) {
            NProgress.done();
            $("#category-search").html("");
            $("#category-search").html(data);
        },
    });
}

// event searching
$("#keyword").on("keyup", function (e) {
    let keyword = $(this).val();
    let page = $("#hidden_page").val();
    let size = $("#size").val();
    NProgress.configure({ showSpinner: true });
    NProgress.start();
    fetchDataSearch(page, keyword, size);
});

// event size
$("#size").on("change", function (e) {
    let size = $(this).val();
    let keyword = $("#keyword").val();
    let page = $("#hidden_page").val();
    NProgress.configure({ showSpinner: true });
    NProgress.start();
    fetchDataSearch(page, keyword, size);
});

// Pagination Event
$(document).on("click", ".pagination a", function (event) {
    event.preventDefault();
    let page = $(this).attr("href").split("page=")[1];
    $("#hidden_page").val(page);

    let keyword = $("#keyword").val();

    let size = $("#size").val();
    NProgress.configure({ showSpinner: true });
    NProgress.start();
    $("li").removeClass("active");
    $(this).parent().addClass("active");
    fetchDataSearch(page, keyword, size);
});

// Fetch All Data
function getAllData() {
    $.ajax({
        method: "GET",
        url: "/admin/master/category/search",
        success: function (data) {
            NProgress.done();
            $("#category-search").html("");
            $("#category-search").html(data);
        },
    });
}

// Function Delete Data Customer
function deleteData(id) {
    $.ajax({
        type: "DELETE",
        url: "category/" + id,
        data: {
            _method: "DELETE",
            _token: TOKEN,
            id: id,
        },
        success: function (result) {
            toastr.success("Data has been deleted");
            getAllData();
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
