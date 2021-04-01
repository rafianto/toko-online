@extends('admins.layouts.main')
@section('title', 'Category')
@section('css')
	<style>
		th{
			background: white;
			position: sticky;
			top: 0; /* Don't forget this, required for the stickiness */
                  box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.1);
		}
	</style>
@endsection
@section('content')
      <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="card card-default">

                        {{-- Card Header --}}
                        <div class="card-header card-header-border-bottom">
                              <h2 class="justify-content-end">
                                    Category
                              </h2>
                        </div>
                        {{-- End Of Card Header --}}

                        {{-- Card Body --}}
                              <div class="card-body">

                                    <div class="mb-5">

                                          <div class="row">
                                                {{-- Search --}}
                                                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                            <div class="form-group d-flex">
                                                                  <label for="keyword" class="justify-content-start pr-3">
                                                                        Search
                                                                  </label>
                                                                  <input type="text" class="form-control justify-content-end" name="keyword" id="keyword" style="width: 65% !important;" autocomplete="off"> 
                                                            </div>
                                                      </div>
                                                {{-- End Of Search --}}

                                                {{-- Filter size --}}
                                                      {{-- <div class="offset-md-4 offset-lg-4 offeset-xl-4 col-sm-6 col-md-2 col-lg-2 col-xl-2">
                                                            <div class="form-group d-flex">
                                                                  <label for="keyword" class="justify-content-start pr-3">
                                                                        Size
                                                                  </label>
                                                                  <select class="custom-select justify-content-end" id="size" name="size">
                                                                        <option value="10" selected>10</option>
                                                                        <option value="25">25</option>
                                                                        <option value="50">50</option>
                                                                        <option value="100">100</option>
                                                                  </select>
                                                            </div>
                                                      </div> --}}
                                                {{-- End Of Filter size --}}

                                          </div>

                                          <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                                          <div id="category-search">
                                                @include('admins.categories.search')
                                          </div>

                                    </div>

                              </div>
                        {{-- End Of Card Body --}}

                  </div>
            </div>
      </div>
@endsection
@push('script')
      <script src="{{ asset('assets/js/apps/category.js') }}"></script>
@endpush