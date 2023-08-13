@extends('layouts.admin.app')

@section('content')



<div class="container">
                    <div class="row">
                       
                            <img src="{{asset('img/undraw_profile.svg')}}" style="height: 100px; width: 100px;">
                            <h3 style="margin-top: 34px; margin-left: 12px;">Admin</h3>
                            

                           
                       
                    </div>
                    <form>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Current Password</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label"> New Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Re- type Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" required>
                          </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>


@endsection