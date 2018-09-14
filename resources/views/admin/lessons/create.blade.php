@extends('layouts.app')

@section('content')
    <div class="header-title">
        <h4>@lang('global.lessons.title')</h4>
    </div>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.lessons.store'], 'files' => true,]) !!}

    <div class="card">
        
        <div class="card-content">
            <div class="title">
                <h5>@lang('global.app_create')</h5>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-field">
                        {!! Form::label('title', trans('global.lessons.fields.title').'', ['class' => 'control-label']) !!}
                        {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        @if($errors->has('title'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('title') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>File</span>
                            {!! Form::file('study_material[]', [
                                'multiple',
                                'data-url' => route('admin.media.upload'),
                                'data-bucket' => 'study_material',
                                'data-filekey' => 'study_material',
                                ]) !!}
                        </div>
                        <div class="file-path-wrapper">
                            {!! Form::text('file_text', old('file_text'), ['class' => 'file-path validate', 'placeholder' => 'Upload your avatar']) !!}
                        </div>
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                        <div class="photo-block">
                            <div class="progress-bar form-group">&nbsp;</div>
                            <div class="files-list"></div>
                        </div>
                        @if($errors->has('study_material'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                {{ $errors->first('study_material') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    {!! Form::label('introduction', trans('global.lessons.fields.introduction').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('introduction', old('introduction'), ['class' => 'form-control editor']) !!}
                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                    @if($errors->has('introduction'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            {{ $errors->first('introduction') }}
                        </span>
                    @endif
                </div>

                <div class="col-12 col-md-6">
                    {!! Form::label('content', trans('global.lessons.fields.content').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('content', old('content'), ['class' => 'form-control editor']) !!}
                    <span class="helper-text" data-error="wrong" data-success="right"></span>
                    @if($errors->has('content'))
                        <span class="helper-text" data-error="wrong" data-success="right">
                            {{ $errors->first('content') }}
                        </span>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::button('<i class="material-icons right">send</i>Create', ['class'=>'btn waves-effect waves-light', 'type'=>'submit']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

    <script src="{{ asset('adminlte/plugins/fileUpload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/fileUpload/js/jquery.fileupload.js') }}"></script>
    <script>
        $(function () {
            $('.file-upload').each(function () {
                var $this = $(this);
                var $parent = $(this).parent();

                $(this).fileupload({
                    dataType: 'json',
                    formData: {
                        model_name: 'Lesson',
                        bucket: $this.data('bucket'),
                        file_key: $this.data('filekey'),
                        _token: '{{ csrf_token() }}'
                    },
                    add: function (e, data) {
                        data.submit();
                    },
                    done: function (e, data) {
                        $.each(data.result.files, function (index, file) {
                            var $line = $($('<p/>', {class: "form-group"}).html(file.name + ' (' + file.size + ' bytes)').appendTo($parent.find('.files-list')));
                            $line.append('<a href="#" class="btn btn-xs btn-danger remove-file">Remove</a>');
                            $line.append('<input type="hidden" name="' + $this.data('bucket') + '_id[]" value="' + file.id + '"/>');
                            if ($parent.find('.' + $this.data('bucket') + '-ids').val() != '') {
                                $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + ',');
                            }
                            $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + file.id);
                        });
                        $parent.find('.progress-bar').hide().css(
                            'width',
                            '0%'
                        );
                    }
                }).on('fileuploadprogressall', function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $parent.find('.progress-bar').show().css(
                        'width',
                        progress + '%'
                    );
                });
            });
            $(document).on('click', '.remove-file', function () {
                var $parent = $(this).parent();
                $parent.remove();
                return false;
            });
        });
    </script>
@stop