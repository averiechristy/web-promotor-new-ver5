@extends('layouts.user.app')

@section('content')

    <!-- ======= Change Password Section ======= -->
    <section id="edit-profil" class="edit-profil">
        <div class="container">
  
          <div class="row justify-content-between">
            <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
              
               
                <img src="{{asset('img/password-edit.png')}}" class="img-fluid" alt="">
              
           
                
            </div>

            
            <div class="col-lg-6 pt-5 pt-lg-0">
              <form action="#" method="post" role="form" class="php-email-form">

                <div class="button-income2">
                   

                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label-nama">Current Password</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" style="width: 50%;" placeholder="" required>
                      </div>

                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label-email">New Password</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" style="width: 50%;" placeholder="" required>
                      </div>

                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label-email">Re-type Password</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" style="width: 50%;" placeholder="" required>
                      </div>
                </div>
                <div class="d-grid gap-2 d-md-flex  btn-edit">
                    <button class="btn-save " type="submit">Save</button>
                    <button class="btn-cancel" type="button">Cancel</button>
                  </div>
             </form>
            </div>
  
            
          </div>
  
        </div>
      </section><!-- End change passwrod Section -->
@endsection