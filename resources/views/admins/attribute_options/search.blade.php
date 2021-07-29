{{-- Content Table --}}
<div class="table-responsive responsive-data-table">

    <table id="categories-table" 
        class="table table-striped table-hover table-bordered dt-responsive text-wrap "
    >

        {{-- Thead --}}
            <thead class="text-center">
                <tr>
                    <th class="text-center">
                        No
                    </th>
                    <th class="text-center">
                        Name
                    </th>
                    <th class="text-center">
                        Created At
                    </th class="text-center">
                    <th class="text-center">
                        Updated At
                    </th>
                    <th class="text-center">
                                #
                    </th>
                </tr>
            </thead>
        {{-- End Of Thead --}}

        {{-- Tbody --}}
            <tbody>

            {{-- Jika Data option Kosong --}}
            @if(count($options) == 0)
                <tr  class="text-center">
                    <td colspan="6">
                        No Data Found
                    </td>
                </tr>
            @endif
            {{-- akhir kondisi --}}
                @php
                    $i = 1;
                @endphp
            @foreach ($options as $index => $option)

                <tr class="text-dark text-wrap">
                    <td class="text-center">
                        {{ $index + $i }}
                    </td>
                    <td>
                        {{ ucwords($option->name) }}
                    </td>
                    <td class="text-center">
                        {{ date('d/m/Y H:i:s' , strtotime($option->created_at)) }}
                    </td>
                    <td class="text-center">
                        {{ date('d/m/Y H:i:s' , strtotime($option->updated_at)) }}
                    </td>
                    <td class="text-center" width="20%">
                        <button type="button"
                            id="btn-view" data-id="{{ $option->id }}" 
                            class="my-2 btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="View Data"
                            onclick="viewData({{ $option->id }}, `{{ ucwords($option->name) }}`)"
                        >
                            <i class="text-white mdi mdi-eye"></i>
                        </button>
                        <button id="btn-delete" data-id="{{ $option->id }}" class="my-2 btn btn-danger btn-sm" data-attributeId="{{ $attribute->id }}" data-toggle="tooltip" data-placement="top" title="Delete Data">
                            <i class="text-white mdi mdi-delete"></i>
                        </button>
                    </td>
                </tr>
                
            @endforeach

            </tbody>
        {{-- End Of Tbody --}}

    </table>

    </div>

    <span>
            Total Data:&nbsp;<b>{{ $options->total() }}</b>
    </span>
</div>
{{-- End Of Content Table --}}
{{-- Pagination --}}
<div class="my-3 row justify-content-end paging">
    <div>
        {{ $options->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
{{-- End Of Pagination --}}
@push('script')
    <script>
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
        var attributeId = {{ $attribute->id }};
        fetchDataSearch(1);
        // Fetch Data Function
        function fetchDataSearch(page) {
            $.ajax({
                method: "GET",
                url:`/admin/master/attribute/${attributeId}/options/search?page=${page}`,
                success: function (data) {
                    NProgress.done();
                    $("#attributeOptions-search").html("");
                    $("#attributeOptions-search").html(data);
                    let paging = document.getElementsByClassName("paging")[1];
                    paging.classList.add("invisible");
                    paging.classList.add("absolute");
                },
                error: function (jqXHR, error, errorThrown) {
                    if (jqXHR.status && jqXHR.status == 400) {
                        toastr.error(jqXHR.responseJSON.message);
                    } else {
                        toastr.error("Something Went Wrong");
                    }
                },
            });
        }

        // Pagination Event
        $(document).on("click", ".pagination a", function (event) {
            event.preventDefault();
            let page = $(this).attr("href").split("page=")[1];
            $("#hidden_page").val(page);
            
            NProgress.configure({ showSpinner: true });
            NProgress.start();
            $("li").removeClass("active");
            $(this).parent().addClass("active");
            fetchDataSearch(page);
        });

        // Function Delete Data Customer
        function deleteData(id) {
            $.ajax({
                type: "DELETE",
                url: "/admin/master/attribute/options/" + id,
                data: {
                    _method: "DELETE",
                    _token: TOKEN,
                    id: id,
                },
                success: function (result) {
                    toastr.success("Data has been deleted");
                    Swal.fire({
                        icon: "success",
                        title: `Success`,
                        text: `${result.message}`,
                        // footer: '<a href="">Why do I have this issue?</a>',
                    });
                },
                error: function (jqXHR, error, errorThrown) {
                    Swal.fire({
                        icon: "error",
                        title: `${jqXHR.status}`,
                        text: `${jqXHR.responseJSON.message}`,
                        // footer: '<a href="">Why do I have this issue?</a>',
                    });
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
    </script>
@endpush