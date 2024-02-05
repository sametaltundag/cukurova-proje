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
            <div class="row">
                <h1 class="text-center">Hoşgeldiniz | Sliderlar</h1>
            </div>

            <div class="row">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">

                    <div class="carousel-inner">
                      @foreach ($sliderlar as $key => $slider)
                      <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" style="height: 500px;">
                        <img src="{{asset('slider').'/'.$slider->image}}" style="height: 100%;object-fit: cover; object-position: center;" class="d-block w-100" alt="{{$slider->title}}">
                        <div class="carousel-caption d-none d-md-block">
                          <h5>{{$slider->title}}</h5>
                          <p>{{$slider->description}}</p>
                        </div>
                      </div>

                      @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>

            <div class="row">
                <div class="col-12">
                    @if (session('error'))
                        <div class="col-12">
                            <div class="alert alert-success" role="alert">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif

                    <button data-bs-toggle="modal" data-bs-target="#sliderekle" class="btn btn-outline-success">Yeni Slider <i class="fas fa-plus"></i></button>

                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Görsel</th>
                                <th>Başlık</th>
                                <th>Açıklama</th>
                                <th>Sıra</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (count($sliderlar) != 0)
                                @foreach ($sliderlar as $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td><img src="{{asset('slider').'/'.$slider->image}}" style="height: 50px; width: 50px;object-fit: cover; object-position: center" alt="{{$slider->title}}"></td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td>{{ $slider->order }}</td>
                                    <td>
                                        <a href="{{route('slidershow',$slider->id)}}" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="modal fade" id="sliderekle" tabindex="-1" aria-labelledby="sliderekleLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="sliderekleLabel">Yeni Slider</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{route('slidercreate')}}" enctype="multipart/form-data">
                    @csrf

                    <img src="https://static.vecteezy.com/system/resources/thumbnails/004/141/669/small/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg" id="image-preview" style="object-fit: cover; object-position: center;height: 200px; width: 200px;" >

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Slider Görsel</label>
                        <input type="file" id="file-input" required name="image" onchange="previewImage()" class="form-control">
                      </div>


                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Slider Başlık:</label>
                      <input type="text" required name="title" placeholder="Slider Başlık yazın" class="form-control">
                    </div>

                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Slider Açıklama:</label>
                      <input type="text" class="form-control" name="description" placeholder="Slider Açıklama yazın">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Sıra</label>
                        <input type="number" name="order" class="form-control" placeholder="Slider Sıra yazın">
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-success">Oluştur <i class="fas fa-plus"></i></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vazgeç</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
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
