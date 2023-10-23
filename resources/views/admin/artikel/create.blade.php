@extends('layouts.admin.app')

@section('content')



                <!-- Begin Page Content -->
             

                <div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Tambah Berita Baru
                                    </div>
                                    <div class="card-body">
                                       <form name="saveform" action="{{route('admin.artikel.simpan')}}" method="post"  enctype="multipart/form-data" onsubmit="return validateForm()">
                                            @csrf
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Judul Berita</label>
                                                <input name="judul_artikel" type="text" class="form-control {{$errors->has('judul_artikel') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="{{old('judul_artikel')}}"  oninvalid="this.setCustomValidity('Judul artikel tidak boleh kosong')"  oninput="setCustomValidity('')" />
                                                @if ($errors->has('judul_artikel'))
                                                    <p class="text-danger">{{$errors->first('judul_artikel')}}</p>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                  <label for="exampleFormControlFile1">Upload Gambar (PNG atau JPG, maksimum 5 MB):</label>
                                                  <input  name="gambar_artikel" type="file"  class="form-control-file {{$errors->has('gambar_artikel') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="{{old('gambar_artikel')}}"  oninvalid="this.setCustomValidity('Gambar artikel tidak boleh kosong')" oninput="setCustomValidity('')"  accept=".png, .jpg, .jpeg" 
               title="Hanya file dengan ekstensi .png, .jpg, atau .jpeg yang diterima" 
               size="5000" onchange="previewImage(this)" accept="image/*">
               <img id="image-preview" src="#" alt="Preview" style="max-width: 100%; max-height: 200px; display: none;">

                                                  @if ($errors->has('gambar_artikel'))
                                                    <p class="text-danger">{{$errors->first('gambar_artikel')}}</p>
                                                @endif
                                                </div>
                                                
                                                <script>
                                                  function previewImage(input) {
    var preview = document.getElementById('image-preview');
    var file = input.files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }

        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
}

                                                </script>
                                                <div class="form-group mb-4">
                                              <label>Isi Artikel</label>
                                              <div class="form-group">
                                              <!-- <textarea name="isi_artikel" class="my-editor form-control {{$errors->has('isi_artikel') ? 'is-invalid' : ''}}" style="border-color: #01004C;" id="my-editor" cols="30" rows="10" required>{{old('isi_artikel')}}</textarea>                                             -->
                                              <textarea name="isi_artikel" class="my-editor form-control {{$errors->has('isi_artikel') ? 'is-invalid' : ''}} " id="my-editor"cols="30" rows="10" style="border-color: #01004C;" value="" required oninvalid="this.setCustomValidity('Isi artikel tidak boleh kosong')" oninput="setCustomValidity('')">{{ old('isi_artikel') }}
                                            
                                            
                                            </textarea>

                                            
</div>



                                              <div class="form-group mb-4">
                                                <button type="submit" class="btn " style="background-color: #01004C; color: white;">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
          
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

    
<script>
function validateForm() {
  let judul_artikel = document.forms["saveform"]["judul_artikel"].value;
  let gambar_artikel = document.forms["saveform"]["gambar_artikel"].value;
  let isi_artikel = document.forms["saveform"]["isi_artikel"].value;


  if (judul_artikel == "") {
    alert("Judul artikel tidak boleh kosong");
    return false;
  } else   if (gambar_artikel == "") {
    alert("Gambar artikel tidak boleh kosong");
    return false;
  
  } else   if (isi_artikel == "") {
    alert("Isi artikel tidak boleh kosong");
    return false;
  
  }
}

</script>

@endsection