<div class="card card-default">
	{{-- Card Header --}}
		<div class="card-header card-header-border-bottom">
					<h2 class="justify-content-end">
								Menus
					</h2>
		</div>
	{{-- End Of Card Header --}}
	{{-- Card Body --}}
		<div class="card-body">
			<nav class="nav flex-column">
				<a href="{{ url('admin/master/product/' . $productId) }}" class="nav-link">
					Product Detail
				</a>
				<hr>
				<a href="{{ url('admin/master/product/' . $productId . '/images') }}" class="nav-link">
					Product Images
				</a>
				<hr>
			</nav>
		</div>
	{{-- End Of Card Body --}}
</div>