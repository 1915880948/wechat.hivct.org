<script type="text/javascript" src="{{yUrl(['site/province'])}}"></script>
<script type="text/javascript" src="{{gStatic('vendor/plugins/province/region.js')}}"></script>
<script>
    $(function () {
        var region = new Selected();
        var province = "";
        var provinces = [];
        if (province !== "" && province.length === 6) {
            var a, b, c;
            a = province.substr(0, 2) + "0000";
            b = province.substr(0, 4) + "00";
            provinces = [a, b, province];
        }
        region.ready({
            labels: ["", " ", " "],
            elem: "{{$select or '#region_select'}}",
            values: provinces,
            onSelect: function (target, value) {
                $("{{$input or '#region_input'}}").val(value);
            }
        });
    });
</script>
