
@push('foot-script')
  <script type="text/javascript" src="{{yStatic('vendor/city/jquery.cityselect.js')}}"></script>
  <script>
      $(function () {
          $("#city").citySelect({nodata: "none", required: false,url:'{{yStatic('vendor/city/city.min.js')}}'});

      });
  </script>
@endpush
