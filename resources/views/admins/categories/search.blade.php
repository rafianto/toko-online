<div class="clearfix mb-3">
		<a class="btn btn-primary float-right" href="{{ url('admin/category/create') }}" role="button">
					<i class="mdi mdi-plus"></i> Add New Category
		</a>
</div>

{{-- Content Table --}}
	<div  style="height: 400px !important;overflow:auto !important;margin-top:25px !important;">
	
		<div class="table-responsive">

					<table id="categories-table" class="table  table-striped table-hover table-bordered">

								{{-- Thead --}}
											<thead class="text-center">
														<tr>
																	<th class="text-center">
																				No
																	</th>
																	<th>
																				Name
																	</th>
																	<th>
																				Slug
																	</th>
																	<th>
																				Category Parent
																	</th>
																	<th>
																				Created At
																	</th>
																	<th>
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

												{{-- Jika Data Category Kosong --}}
												@if(count($categories) == 0)
														<tr  class="text-center">
																<td colspan="7">
																		No Data Found
																</td>
														</tr>
												@endif

												@foreach ($categories as $index => $category)

														<tr class="text-dark">
															<td class="text-center">
																{{ $index + $categories->firstItem() }}
															</td>
															<td>
																{{ $category->name }}
															</td>
															<td>
																{{ $category->slug }}
															</td>
															<td>
																{{ $category->parent? $category->parent->name : ''}}
															</td>
															<td>
																{{ date('d-m-Y H:i:s', strtotime($category->created_at)) }}
															</td>
															<td>
																@if(!is_null($category->updated_at))
																	{{ date('d-m-Y H:i:s', strtotime($category->updated_at)) }}
																@endif
															</td>
															<td class="text-center" width="15%">
																<a href="{{ url('admin/category') }}/{{ $category->id }}" id="btn-view" data-id="{{ $category->id }}" class="btn btn-warning my-2" data-toggle="tooltip" data-placement="top" title="View Data">
																	<i class="mdi mdi-eye text-white"></i>
																</a>
																<button id="btn-delete" data-id="{{ $category->id }}" class="btn btn-danger my-2" data-toggle="tooltip" data-placement="top" title="Delete Data">
																	<i class="mdi mdi-delete text-white"></i>
																</button>
															</td>
														</tr>
													
												@endforeach

											</tbody>
								{{-- End Of Tbody --}}

					</table>

		</div>

	</div>
{{-- End Of Content Table --}}


<span>
		Total Data:&nbsp;<b>{{ $categories->total() }}</b>
</span>
{{-- Pagination --}}
		<div class="row my-3 justify-content-end">
				<div>
						{{ $categories->links('vendor.pagination.bootstrap-4') }}
				</div>
		</div>
{{-- End Of Pagination --}}