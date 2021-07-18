<div class="clearfix mb-3">
		<a class="btn btn-primary float-right" href="{{ url('admin/product/create') }}" role="button">
					<i class="mdi mdi-plus"></i> Add New Produt
		</a>
</div>

{{-- Content Table --}}
	<div  style="height: 400px !important;overflow:auto !important;margin-top:25px !important;">
	
		<div class="table-responsive text-nowrap">

					<table id="product-table" class="table  table-striped table-hover table-bordered">

								{{-- Thead --}}
											<thead class="text-center">
														<tr>
																	<th class="text-center">
																				No
																	</th>
																	<th>
																				SKU
																	</th>
																	<th>
																				Name
																	</th>
																	<th>
																				Slug
																	</th>
																	<th>
																				Price
																	</th>
																	<th>
																				Status
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
												@if(count($products) == 0)
														<tr  class="text-center">
																<td colspan="7">
																		No Data Found
																</td>
														</tr>
												@endif

												@foreach ($products as $index => $product)

														<tr class="text-dark">
															<td class="text-center">
																{{ $index + $products->firstItem() }}
																<td>
																{{ $product->sku }}
															</td>
															</td>
															<td>
																{{ ucwords($product->name) }}
															</td>
															<td>
																{{ $product->slug }}
															</td>
															<td>
																{{ number_format($product->price, 2) }}
															</td>
															<td>
																@if($product->status == 0)
																	Draft
																@elseif ($product->status == 1)
																	Active
																@else
																	Inactive
																@endif
															</td>
															<td class="text-center" width="15%">
																<a href="{{ url('admin/product') }}/{{ $product->id }}" id="btn-view" data-id="{{ $product->id }}" class="btn btn-warning my-2" data-toggle="tooltip" data-placement="top" title="View Data">
																	<i class="mdi mdi-eye text-white"></i>
																</a>
																<button id="btn-delete" data-id="{{ $product->id }}" class="btn btn-danger my-2" data-toggle="tooltip" data-placement="top" title="Delete Data">
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
		Total Data:&nbsp;<b>{{ $products->total() }}</b>
</span>
{{-- Pagination --}}
		<div class="row my-3 justify-content-end">
				<div>
						{{ $products->links('vendor.pagination.bootstrap-4') }}
				</div>
		</div>
{{-- End Of Pagination --}}