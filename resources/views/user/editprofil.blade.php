@extends('layouts.user.app')

@section('content')

  <!-- ======= Edit Profil Section ======= -->
  <section id="edit-profil" class="edit-profil">
        <div class="container">
  
          <div class="row justify-content-between">
            <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
               
                <img src="{{asset('img/editprofil.png')}}" class="img-fluid" alt="" >
                
            </div>

            
            <div class="col-lg-6 pt-5 pt-lg-0">
              <form action="#" method="post" role="form" class="php-email-form">

                <div class="button-income">
                    <img src="{{asset('img/profil.png')}}" class="img-edit"> Amanda </img>   
                    <div class="mb-3">
                        <label for="formFileSm" class="form-label">Upload New Profil Photo</label>
                        <input  style="width: 80%;" class="form-control form-control-sm" id="formFileSm" type="file" value="profil1.png" required>
                      </div>

                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label-nama">Nama</label>
                        <input style="width: 80%;" type="text" class="form-control" id="exampleFormControlInput1" value="Amanda" required>
                      </div>

                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label-email">Email</label>
                        <input style="width: 80%;" type="email" class="form-control" id="exampleFormControlInput1" value="amanda@gmail.com" required>
                      </div>

                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label-email">Phone Number</label>
                        <input style="width: 80%;" type="text" class="form-control" id="exampleFormControlInput1" value="087727123123" required>
                      </div>

                      <div class="d-grid gap-2 d-md-flex  btn-edit">
                        <button class="btn-save me-md-2" type="submit">Save</button>
                        <button class="btn-cancel" type="button">Cancel</button>
                      </div>
                </div>
                

              </form>
             
            </div>
  
            
          </div>
  
        </div>
      </section><!-- End Edit Profil Section -->
  

@endsection