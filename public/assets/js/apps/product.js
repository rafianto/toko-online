// const TOKEN = $('meta[name="csrf-token"]').attr("content");

// Fetch Data Function
function fetchDataSearch(page, query, size) {
    $.ajax({
        method: "GET",
        url:
            "/admin/product/search?page=" +
            page +
            "&size=" +
            size +
            "&keyword=" +
            query,
        success: function (data) {
            NProgress.done();
            console.log(data);
            $("#product-search").html("");
            $("#product-search").html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
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
        url: "/admin/product/search",
        success: function (data) {
            NProgress.done();
            $("#product-search").html("");
            $("#product-search").html(data);
        },
    });
}

// Function Delete Data Customer
function deleteData(id) {
    const TOKEN = $('meta[name="csrf-token"]').attr("content");
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

$(".js-example-basic-multiple").select2();
$(".js-example-basic-single").select2();
$("input[data-type='currency']").on({
    keyup: function () {
        formatCurrency($(this));
    },
    blur: function () {
        formatCurrency($(this), "blur");
    },
});

function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.

    // get input value
    var input_val = input.val();

    // don't validate empty input
    if (input_val === "") {
        return;
    }

    // original length
    var original_len = input_val.length;

    // initial caret position
    var caret_pos = input.prop("selectionStart");

    // check for decimal
    if (input_val.indexOf(".") >= 0) {
        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatNumber(left_side);

        // validate right side
        right_side = formatNumber(right_side);

        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
            right_side += "00";
        }

        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = "IDR" + left_side + " " + right_side;
    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        var rp = "IDR ";
        input_val = formatNumber(input_val);
        input_val = rp + input_val;

        // final formatting
        if (blur === "blur") {
            input_val += ".00";
        }
    }

    // send updated string to input
    input.val(input_val);

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}
