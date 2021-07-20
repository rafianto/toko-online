@php

    // To get RAM usage
    $loads=sys_getloadavg();
    $core_nums=trim(shell_exec("grep -P '^physical id' /proc/cpuinfo|wc -l"));
    $load=$loads[0]/$core_nums;

    /**
     * Convert bytes to the unit specified by the $to parameter.
     * 
     * @param integer $bytes The filesize in Bytes.
     * @param string $to The unit type to convert to. Accepts K, M, or G for Kilobytes, Megabytes, or Gigabytes, respectively.
     * @param integer $decimal_places The number of decimal places to return.
     *
     * @return integer Returns only the number of units, not the type letter. Returns 0 if the $to unit type is out of scope.
     *
     */
    function isa_convert_bytes_to_specified($bytes, $to, $decimal_places = 1) {
        $formulas = array(
            'K' => number_format($bytes / 1024, $decimal_places),
            'M' => number_format($bytes / 1048576, $decimal_places),
            'G' => number_format($bytes / 1073741824, $decimal_places)
        );
        return isset($formulas[$to]) ? $formulas[$to] : 0;
    }

    $menuMaster = ['product', 'category', 'product-attribute'];
    
@endphp
<!--
    ====================================
    ——— LEFT SIDEBAR WITH FOOTER
    =====================================
-->
    <aside class="left-sidebar bg-sidebar">
        <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
                <a href="{{ url('/admin') }}" title="{{ env('APP_NAME') }} Dashboard">
                    <svg
                        class="brand-icon"
                        xmlns="http://www.w3.org/2000/svg"
                        preserveAspectRatio="xMidYMid"
                        width="30"
                        height="33"
                        viewBox="0 0 30 33"
                    >
                        <g fill="none" fill-rule="evenodd">
                            <path
                                class="logo-fill-blue"
                                fill="#7DBCFF"
                                d="M0 4v25l8 4V0zM22 4v25l8 4V0z"
                            />
                            <path
                                class="logo-fill-white"
                                fill="#FFF"
                                d="M11 4v25l8 4V0z"
                            />
                        </g>
                    </svg>
                    <span class="brand-name text-truncate"
                        >{{ env('APP_NAME') }}</span
                    >
                </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-scrollbar">
                <!-- sidebar menu -->
                <ul class="nav sidebar-inner" id="sidebar-menu">
                    <li class="has-sub @if(request()->segment(2) == 'dashboard') active expand @endif">
                        <a
                            class="sidenav-item-link"
                            href="javascript:void(0)"
                            data-toggle="collapse"
                            data-target="#dashboard"
                            aria-expanded="false"
                            aria-controls="dashboard"
                        >
                            <i
                                class="mdi mdi-view-dashboard-outline"
                            ></i>
                            <span class="nav-text">Dashboard</span>
                            <b class="caret"></b>
                        </a>
                        <ul
                            class="collapse 
                                @if(request()->segment(1) == 'dashboard') show @endif
                            "
                            id="dashboard"
                            data-parent="#sidebar-menu"
                        >
                            <div class="sub-menu">
                                <li class="active">
                                    <a
                                        class="sidenav-item-link"
                                        href="{{ url('admin/dashboard') }}"
                                    >
                                        <span class="nav-text"
                                            >Monitoring</span
                                        >
                                    </a>
                                </li>

                                {{-- <li>
                                    <a
                                        class="sidenav-item-link"
                                        href="analytics.html"
                                    >
                                        <span class="nav-text"
                                            >Analytics</span
                                        >

                                        <span
                                            class="badge badge-success"
                                            >new</span
                                        >
                                    </a>
                                </li> --}}
                            </div>
                        </ul>
                    </li>

                    <li class="has-sub 
                        @if(request()->segment(2) == 'master') active expand @endif
                    ">
                        <a
                            class="sidenav-item-link"
                            href="javascript:void(0)"
                            data-toggle="collapse"
                            data-target="#master"
                            aria-expanded="false"
                            aria-controls="master"
                        >
                            <i class="mdi mdi-pencil-box-multiple"></i>
                            <span class="nav-text">Master</span>
                            <b class="caret"></b>
                        </a>
                        <ul
                            class="collapse @if(request()->segment(2) == 'master') show expand @endif"
                            id="master"
                            data-parent="#sidebar-menu"
                        >
                            <div class="sub-menu">
                                {{-- Category --}}
                                <li
                                    @if(request()->segment(3) == 'category')
                                        class="active"
                                    @endif
                                >
                                    <a
                                        class="sidenav-item-link"
                                        href="{{ url('admin/master/category') }}"
                                    >
                                        <span class="nav-text"
                                            >Category</span
                                        >
                                    </a>
                                </li>
                                {{-- End of category --}}

                                {{-- Product --}}
                                <li
                                    @if(request()->segment(3) == 'product')
                                        class="active"
                                    @endif
                                >
                                    <a
                                        class="sidenav-item-link "
                                        href="{{ url('admin/master/product') }}"
                                    >
                                        <span class="nav-text"
                                            >Product</span
                                        >
                                    </a>
                                </li>
                                {{-- End of product --}}

                                {{-- Attribute --}}
                                <li
                                    @if(request()->segment(3) == 'attribute')
                                        class="active"
                                    @endif
                                >
                                    <a
                                        class="sidenav-item-link "
                                        href="{{ url('admin/master/attribute') }}"
                                    >
                                        <span class="nav-text">Attribute</span>
                                    </a>
                                </li>
                                {{-- End of attribute --}}

                            </div>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="sidebar-footer">
                <hr class="mb-0 separator" />
                <div class="sidebar-footer-content">
                    <h6 class="text-uppercase">
                        Cpu Uses <span class="float-right">{{ $load }}%</span>
                    </h6>
                    <div class="progress progress-xs">
                        <div
                            class="progress-bar active"
                            style="width: {{ $load }}%"
                            role="progressbar"
                        ></div>
                    </div>
                    <h6 class="text-uppercase">
                        Memory Uses <span class="float-right">{{ isa_convert_bytes_to_specified(memory_get_usage(false), 'M') }}MB</span>
                    </h6>
                    <div class="progress progress-xs">
                        <div
                            class="progress-bar progress-bar-warning"
                            style="width: {{ isa_convert_bytes_to_specified(memory_get_usage(false), 'M') }}%"
                            role="progressbar"
                        ></div>
                    </div>
                </div>
            </div>
        </div>
    </aside>