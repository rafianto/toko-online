</div>
      <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/slimscrollbar/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jekyll-search.min.js') }}"></script>

        <script src="{{ asset('assets/plugins/charts/Chart.min.js') }}"></script>
        {{-- Toaster --}}
        <script   script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>    
        <script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>

        <script src="{{ asset('assets/plugins/daterangepicker/moment.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
        <script>
            jQuery(document).ready(function () {
                jQuery('input[name="dateRange"]').daterangepicker({
                    autoUpdateInput: false,
                    singleDatePicker: true,
                    locale: {
                        cancelLabel: "Clear",
                    },
                });
                jQuery('input[name="dateRange"]').on(
                    "apply.daterangepicker",
                    function (ev, picker) {
                        jQuery(this).val(picker.startDate.format("MM/DD/YYYY"));
                    }
                );
                jQuery('input[name="dateRange"]').on(
                    "cancel.daterangepicker",
                    function (ev, picker) {
                        jQuery(this).val("");
                    }
                );
            });
        </script>

        <!-- font awesome -->
        <script src="https://kit.fontawesome.com/86bd5d84df.js" crossorigin="anonymous"></script>   

        {{-- Sweet Alert CDN --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="{{ asset('assets/js/sleek.bundle.js') }}"></script>
        <script>

            $(function(){

                // declare token
                const TOKEN = $('meta[name="csrf-token"]').attr('content');

                // set ajax
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': TOKEN,
                    }
                });

                // declare Toast
                // success message
                @if(Session::has('message'))
                        toastr.options =
                        {
                            closeButton : true,
                            progressBar : true,
                        }
                        toastr.success("{{ session('message') }}");
                @endif
                
                // Error Message
                @if(Session::has('error'))
                    toastr.options =
                    {
                        closeButton : true,
                        progressBar : true,
                    }
                    toastr.error("{{ session('error') }}");
                @endif

                // Info Message
                @if(Session::has('info'))
                    toastr.options =
                    {
                        closeButton : true,
                        progressBar : true,
                    }
                    toastr.info("{{ session('info') }}");
                @endif
                
                // Warning Message
                @if(Session::has('warning'))
                    toastr.options =
                    {
                        closeButton : true,
                        progressBar : true,
                    }
                    toastr.warning("{{ session('warning') }}");
                @endif

                
            });
        </script>
        @stack('script')
    </body>
</html>