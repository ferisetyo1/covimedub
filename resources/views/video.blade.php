<section>
    <div class="container mt-5">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <form action="{{url('admin/video/create')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex justify-content-between">
                <h1>Tambah Video</h1>
                <button type="submit" class="btn btn-primary ps-5 pe-5" style="font-weight: 700;border-radius:15px">Simpan</button>
            </div>
            <hr>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="judul" value="" placeholder="Tuliskan judul" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Link Video</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="link_video" value="" placeholder="https://youtu.be/L6EqtUSRWDY => L6EqtUSRWDY" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Gambar Thumbail</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="gambar" value="" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Konten</label>
                <div class="col-sm-10">
                    <textarea rows="3" class="form-control" placeholder="Tuliskan konten video" name="konten" required></textarea>
                </div>
            </div>
        </form>
    </div>
</section>
<section>
    <div class="container mt-5">
        <div class="mb-3 row justify-content-between">
            <h1 class="col">List Video</h1>
            <form action="{{url('admin/video')}}" class="col-sm-12" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Nama rumah sakit" value="{{isset($_GET['query'])?$_GET['query']:''}}" name="query" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
        </div>
        <hr>
        <?php $start = (($paginate->currentPage() - 1) * $paginate->perPage() + 1) ?>
        @foreach($paginate->items() as $val)
        <div class="row justify-content-between mb-1">
            <h5 class="col">#{{$start++}}</h5>
            <div class="col d-flex justify-content-end">
                <button class="btn btn-outline-dark" data-json="{{json_encode($val)}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                <form action="{{url('admin/video/remove/'.$val->id)}}" class="ms-2" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-outline-danger">delete</button>
                </form>
            </div>
        </div>
        <form action="">
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" name="judul" value="{{$val->judul}}" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Link Video</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" name="link_video" value="{{$val->link_video}}" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Thumbnmail</label>
                <div class="col-sm-10">
                    <img src="{{asset('upload_file/'.$val->link_thumbnail)}}" alt="" class="w-100" style="max-width: 300px;">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Konten</label>
                <div class="col-sm-10">
                    <textarea rows="3" readonly class="form-control" placeholder="Tuliskan konten video" name="konten" required>{{$val->konten}}</textarea>
                </div>
            </div>
        </form>
        <hr>
        @endforeach
        <div class="d-flex justify-content-center">
            @if($paginate->previousPageUrl())
            <a href="{{$paginate->previousPageUrl().(isset($_GET['query'])?'&query='.$_GET['query']:'')}}" class="btn btn-outline-primary">Sebelumnya</a>
            @endif
            @if($paginate->nextPageUrl())
            <a href="{{$paginate->nextPageUrl().(isset($_GET['query'])?'&query='.$_GET['query']:'')}}" class="btn btn-primary ms-5">Selanjutnya</a>
            @endif
        </div>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Rumah Sakit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="edit_form" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    @method('put')
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="judul" value="" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Link Video</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="link_video" value="" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Gambar Thumbail</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="gambar" value="" >
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Konten</label>
                        <div class="col-sm-10">
                            <textarea rows="3" class="form-control" placeholder="Tuliskan konten video" name="konten" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget
        var obj = JSON.parse(button.getAttribute('data-json'))
        var input_id = document.getElementById('edit_form')
        var form = document.forms['edit_form']
        form.action = "{{url('admin/video/edit')}}/" + obj.id
        form["id"].value = obj.id
        form["judul"].value = obj.judul
        form["link_video"].value = obj.link_video
        // form["gambar"].value = obj.link_thumbnail
        form["konten"].innerHTML = obj.konten
    })
</script>