<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    </head>
    <body>

        <div class="container">
            <div class="row text-center">
                <div class="form-group">
                    <h5 for="file-input">Slider Önizle</h5> <br>
                    <img src="{{asset('slider').'/'.$slider->image}}" id="image-preview" style="height: 250px; width: 250px;object-fit: cover; object-position: center" alt="">
                </div>
            </div>

            <form action="{{route('slider.update',$slider->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    @if (session('error'))
                        <div class="col-12">
                            <div class="alert alert-success" role="alert">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label">Slider Görsel:</label>
                            <input type="file" id="file-input" class="form-control" onchange="previewImage()" name="image" value="{{$slider->image}}" >
                        </div>


                        <div class="form-group">
                            <label class="col-form-label">Slider Başlık:</label>
                            <input type="text" class="form-control" name="title" value="{{$slider->title}}" >
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Slider Açıklama:</label>
                            <input type="text" class="form-control" name="description" value="{{$slider->description}}" >
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Slider Açıklama:</label>
                            <input type="number" class="form-control" name="order" value="{{$slider->order}}"  min="0">
                        </div>

                        <div class="row d-flex justify-content-center align-items-center">
                            <button class="btn btn-primary mt-3" type="submit">Güncelle</button>
                            <a href="{{route('slider.index')}}" class="btn btn-secondary">Sliderlar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function previewImage() {
                var fileInput = document.getElementById('file-input');
                var imagePreview = document.getElementById('image-preview');

                // Dosya seçilip seçilmediğini kontrol et
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();

                    // Dosyayı okuyup önizlemeyi güncelle
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                    };

                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        </script>

    </body>
</html>
