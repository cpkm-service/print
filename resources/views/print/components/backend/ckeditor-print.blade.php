
<div class="mb-4">
    <label class="form-label" for="{{$name}}">{{__($text)}}@if($required)<span class="text-danger">*</span>@endif</label>
    <div class="ck-content" name="{{$name}}" id="{{$name}}">{!!$value!!}</div>
    <textarea class="form-control d-none" name="{{$name}}"  cols="30" rows="10" placeholder="{{__($text)}}" @if($required) required @endif @if($disabled) disabled @endif>{!!$value!!}</textarea>
    @error($name)
        <div id="{{$name}}-error" class="invalid-feedback animated fadeIn" style="display:block">{{$message}}</div>
    @enderror
</div>
@pushonce('javascript')
<script src="{{asset(Universal::version('print/plugins/ckeditor5/build/ckeditor.js'))}}"></script>
@endpushonce
@pushonce('style')
<style>
    .ck-content {
        width:794px;
        margin:0 auto;
        padding:1cm!important;
        border:1px solid #000!important;
    }
</style>
@endpushonce
@push('javascript')
@if(!$disabled)
<script>
    var {{$name}}
    InlineEditor.create(
        document.querySelector( '#{{$name}}' ),
        {
			licenseKey: '',
            removePlugins: ['Style', 'Markdown','Title'],
		}).then( editor => {
            window.editor = editor;
			{{$name}} = editor;
            editor.model.document.on('change:data', () => {
                // 获取编辑器当前的内容
                const editorData = editor.getData();
                // 将内容设置到对应的隐藏<textarea>元素中
                document.querySelector('textarea[name="{{$name}}"]').value = editorData;
            });
		}).catch( error => {
		});
</script>
@endif
@endpush