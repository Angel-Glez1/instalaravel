@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subir nueva imagen</div>
                    <div class="card-body">
                        <form action="{{ route('image.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- Campo file para subir archivo --}}
                            &nbsp;
                            <img style="width: 35px; height: 35px; border-radius: 900px; overflow: hidden;" src="{{ route('image. file',['filename' => $image->imagen_paht]) }}">
                            &nbsp;
                            <div class="form-grup row">
                                <input type="hidden" name="imagen_id" value="{{ $imagen->id }}">
                                <label for="imagen" class="col-md-4 col-form-label text-md-right ">Actulizar imagen</label>
                                    <div class="col-md-7">
                                        <input type="file" id="image_path" name="image_paht" class="form-control">
                                            @if ($errors->has('image_paht'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('image_paht') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                            </div>
                            {{-- Description of image --}}
                            <div class="form-grup row mt-2">
                                <label for="description" class="col-md-4 col-form-label text-md-right ">Descripcion</label>
                                    <div class="col-md-7">
                                    <textarea name="description" id="description" class="form-control" >{{$image->description}}</textarea>
                                            @if ($errors->has('image_paht'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('image_paht') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                            </div>
                            {{-- Boton de envio --}}
                            <div class="from-group row mt-2"></div>
                                    <div class="col-md-7 offset-md-4">
                                        <input type="submit" value="Actulizar Imagen" class="btn btn-primary">
                                    </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



