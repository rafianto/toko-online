@include('admins.layouts.header')
@include('admins.layouts.sidebar')
{{-- Page Wrapper --}}
<div class="page-wrapper">

      @include('admins.layouts.navbar')

      {{-- Content Wrapper --}}
            <div class="content-wrapper">
                  
                  <div class="content">

                        <div class="breadcrumb-wrapper">

                              <h1>
                                    {{ strtoupper(request()->segment(2)) }}
                              </h1>

                              <nav aria-label="breadcrumb">
                                    <ol class="p-0 breadcrumb">
                                          <li class="breadcrumb-item">
                                          <a href="{{ url('admin/') }}">
                                          <span class="mdi mdi-home"></span>
                                          </a>
                                          </li>
                                          <li class="breadcrumb-item">{{ ucwords(request()->segment(2)) }}</li>
                                          <li class="breadcrumb-item" aria-current="page">
                                                @if(request()->segment(3) == null)
                                                      List
                                                @else
                                                      @if(request()->segment(3) > 0)
                                                            Update
                                                      @else
                                                            {{ ucwords(request()->segment(3)) }}
                                                      @endif
                                                @endif
                                          </li>
                                    </ol>
                              </nav>

                        </div>

                        @yield('content')

                  </div>

                  {{-- Footer --}}
                        <footer class="mt-auto footer">
                              <div class="bg-white copyright">
                                    <p>
                                    &copy; <span id="copy-year">2019</span> Copyright {{ env('APP_NAME') }} By
                                    <a
                                    class="text-primary"
                                    href="https://github.com/Rahmatulah12"
                                    target="_blank"
                                    >Rahmatulah Sidik</a
                                    > And This Template Created By 
                                    <a
                                          class="text-primary"
                                          href="http://www.iamabdus.com/"
                                          target="_blank"
                                          >Abdus</a
                                    >.
                                    </p>
                              </div>
                              <script>
                                    var d = new Date();
                                    var year = d.getFullYear();
                                    document.getElementById("copy-year").innerHTML = year;
                              </script>
                        </footer>
                  {{-- End Of Footer --}}

            </div>
      {{-- End Of Content Wrapper --}}

</div>
{{-- End Of Page Wrapper --}}
@include('admins.layouts.footer')