<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/vue.min.js') }}"></script>
<script src="{{ asset('js/vue-2.js') }}"></script>
<script src="{{ asset('js/axios.js') }}"></script>

@if(Request::segment(1) != 'admin')
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/loading.js') }}"></script>
    <script src="{{ asset('js/products.js') }}"></script>
    <script src="{{ asset('js/basket.js') }}"></script>
    <script src="{{ asset('js/choose-address.js') }}"></script>
    <script src="{{ asset('js/search-product.js') }}"></script>
    <!-- <script src="{{ asset('js/like-product.js') }}"></script> -->
    <!-- <script src="{{ asset('js/comparison-table.js') }}"></script> -->
    <script src="{{ asset('js/app.js') }}"></script>
@endif
@if(Request::segment(1) == 'admin')
    <script src="{{ asset('js/passport.js') }}"></script>
    <script src="{{ asset('js/product-field.js') }}"></script>
    <script src="{{ asset('js/category-field.js') }}"></script>
    <script src="{{ asset('js/advertise-field.js') }}"></script>
    <script src="{{ asset('js/kamadatepicker.js') }}"></script>
    <script src="{{ asset('js/jcrop.js') }}"></script>
    <script src="{{ asset('js/jcrop.main.js') }}"></script>
    <script src="{{ asset('js/ckeditor4/ckeditor.js') }}"></script>
    @if(Request::segment(3) == 'report')
    <!-- <script src="{{ asset('js/chart/chart.js') }}"></script> -->
    <script src="{{ asset('js/chart/sale-total.js') }}"></script>
    <script src="{{ asset('js/chart/sale-daily.js') }}"></script>
    <script src="{{ asset('js/chart/price-chart.js') }}"></script>
    <script src="{{ asset('js/chart/highstock.src.js') }}"></script>
    <script src="{{ asset('js/chart/highcharts-more.src.js') }}"></script>
    <script src="{{ asset('js/chart/data.js') }}"></script>
    @endif
@endif
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.2/classic/ckeditor.js"></script> -->


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<!-- 
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
        a = s.createElement(o), m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    ga('create', '{{ $constant["google_analytics"] }}', 'auto' @if(\Auth::id()) ,{ userId: "{{ \Auth::id() ? \Auth::id() : 'Guest' }}" } @endif );
    ga('send', 'pageview');
	ga('set', 'userId', {{ \Auth::user() ? \Auth::id() : 0 }} );
</script> -->

@if( isset($constant['crisp']) && $constant['crisp'] != '' && $constant['crisp'] == '12')
<script data-cfasync='false'>
    window.$crisp=[];
    CRISP_RUNTIME_CONFIG = {
      locale : 'fa'
    };
    CRISP_WEBSITE_ID = "{{ $constant['crisp'] }}";(function(){
          d=document;s=d.createElement('script');
          s.src='https://client.crisp.chat/l.js';
          s.async=1;d.getElementsByTagName('head')[0].appendChild(s);
    })();       
</script>
@endif

