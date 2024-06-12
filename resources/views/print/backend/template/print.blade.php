<div id="print_content" class="contract ck-content">
    {!!$template->content!!}
</div>
<style>
    .ck-content {
        width:794px;
        margin:0 auto;
        padding:1cm;
        border:1px solid #000;
    }
    .ck-content p {
        line-height: 33px;
    }
    .ck-content .electronic-sign {
        border:0;
    }
    @media print{
        .ck-content {
            width:auto;
            margin:0 auto;
            padding:0;
            border:0;
        }
    }
</style>
<script src="{{asset(Universal::version('assets/js/lib/jquery.min.js'))}}"></script>
<script src="{{asset(Universal::version('print/plugins/ckeditor5/build/ckeditor.js'))}}"></script>
<script>
    var default_data = @json($data??[]);
    Object.keys(default_data).map((key) => {
        $("#print_content").find(`span[data-target="${key}"]`).text(default_data[key]);
    });
    var elements = document.getElementsByClassName("cpkm-input");
    for (var i = 0; i < elements.length; i++) {
        var element = elements[i];
        element.setAttribute("contenteditable",false);
    }
    var elements = document.getElementsByClassName("cpkm-input-none");
    for (var i = 0; i < elements.length; i++) {
        var element = elements[i];
        element.setAttribute("contenteditable",false);
    }
</script>