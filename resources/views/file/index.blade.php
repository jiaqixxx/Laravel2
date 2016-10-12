@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">List of Product Files</div>
                    <table class="table table-bordered">
                        @if(count($files) > 0)
                            @foreach($files as $file)
                                <tr>
                                    <td style="vertical-align: middle; width: 10%">{{$file->id}}</td>
                                    @if(File::extension($file->filename) == 'docx')
                                        <td style="text-align: center; width: 50%"><img src="{{URL::to('word-icon.png')}}" style="width: 100px; height: 100px"></td>
                                    @elseif(File::extension($file->filename) == 'xlsx')
                                        <td style="text-align: center; width: 50%"><img src="{{URL::to('excel-icon.png')}}" style="width: 100px; height: 100px"></td>
                                    @elseif(File::extension($file->filename) == 'pdf')
                                        <td style="text-align: center; width: 50%"><img src="{{URL::to('pdf-icon.png')}}" style="width: 100px; height: 100px"></td>
                                    @else
                                        <td style="text-align: center; width: 50%"><img src="{{URL::to('/'.'uploads/'.$file->filename)}}" style="width: 100px; height: 100px"></td>
                                    @endif
                                    <td style="vertical-align: middle; text-align: center">
                                        <form action="{{url('delete/'.$file->id)}}" method="POST" style="display: inline-block">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-danger"><i class="fa fa-btn fa-trash"></i>Delete</button>
                                        </form>
                                        <form action="{{url('download/'.$file->id)}}" method="GET" style="display: inline-block">
                                            <button class="btn btn-info"><i class="fa fa-btn fa-arrow-down"></i>Download</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td></td>
                            <tr>
                        @endif
                    </table>
                </div>
                <div class="container">
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Upload New File</button>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Files Gallery</h4>
                                </div>
                                <form action="{{url('/upload_file')}}" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        {{ csrf_field() }}
                                        <input type="file" name="file_field[]" multiple>
                                    </div>
                                    <div id="mydrop" class="dropzone"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-primary" id="upload">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>

</script>
@stop