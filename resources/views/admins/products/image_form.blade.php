@extends('admins.layouts.main')
@section('title', 'Product Images')
@section('content')

<div class="row">
    <div class="col-sm-4 col-md-4">
        @include('admins.products.product_menus')
    </div>
    <div class="col-sm-8 col-md-8">
        <div class="card card-default">
            {{-- Card Header --}}
                <div class="card-header card-header-border-bottom">
                    <h2 class="justify-content-end">
                        Upload Product Image
                    </h2>
                </div>
            {{-- End Of Card Header --}}
            {{-- Card Body --}}
                <div class="card-body">
                    <div class="mb-1">

                        <div class="row">

                            <div class="col-sm-12 col-md-12">

                                @include('admins.partials.flash', ['$errors' => $errors])

                                {{-- form upload images --}}
                                    <form action="{{ route('post.images.product', ['productId' => $productId]) }}" method="POST"
                                        enctype="multipart/form-data"
                                    >
                                        @csrf
                                        @method('POST')
                                        <div class="mb-3 custom-file">
                                            <input type="file" class="custom-file-input" 
                                                name="image[]" id="image"
                                                accept="image/png, image/jpg, image/jpeg"
                                                multiple
                                            >
                                            <label class="custom-file-label" for="image">Choose Image</label>
                                        </div>
                                        <div id="frames"></div>
                                        <div class="mt-5 text-right">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-secondary" type="button" onclick="history.back();">
                                                Back
                                            </button>
                                        </div>
                                    </form>
                                {{-- end of form upload images --}}
                                
                            </div>

                        </div>

                    </div>
                </div>
            {{-- end of card body --}}
        </div>
    </div>
</div>

@endsection
@push('script')
    <script>
        $(() => {
            $('.img-view').popover('toggle');
            $('#image').change(function(){
                $("#frames").html('');
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    console.log(this.files[i].size);
                    let size = this.files[i].size;
                    
                    if(size < 200000){
                        $("#frames").append(`<img src="${window.URL.createObjectURL(this.files[i])}" width="120px" height="120px" class="mr-3 rounded img-view" data-toggle="popover${i}" title="${this.files[i].name}" />`);

                    } else {
                        toastr.options =
                        {
                            closeButton : true,
                            progressBar : true,
                        }
                        toastr.error("File size max 2MB");
                    }
                }
            });
        });
    </script>
@endpush