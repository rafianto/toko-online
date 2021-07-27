$(() => {
    // select2
    $(".js-example-basic-single").select2({
        placeholder: "Select an option",
        allowClear: true,
    });

    const TOKEN = $('meta[name="csrf-token"]').attr("content");

    // Fetch Data Function
    function fetchDataSearch(page, query, size) {
        $.ajax({
            method: "GET",
            url:
                "/admin/master/attribute/search?page=" +
                page +
                "&size=" +
                size +
                "&keyword=" +
                query,
            success: function (data) {
                NProgress.done();
                $("#attribute-search").html("");
                $("#attribute-search").html(data);
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

    // Function Delete Data Attribute
    function deleteData(id) {
        let keyword = $("#keyword").val();
        let page = $("#hidden_page").val();
        let size = $("#size").val();
        $.ajax({
            type: "DELETE",
            url: "attribute/" + id,
            data: {
                _method: "DELETE",
                _token: TOKEN,
                id: id,
            },
            success: function (result) {
                if (result.error) {
                    toastr.success(result.message);
                } else {
                    toastr.success(result.message);
                    fetchDataSearch(page, keyword, size);
                }
            },
            error: function (jqXHR, error, errorThrown) {
                if (jqXHR.status && jqXHR.status == 400) {
                    toastr.error(jqXHR.responseText);
                    return false;
                }
                toastr.error("Something Went Wrong");
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
});
