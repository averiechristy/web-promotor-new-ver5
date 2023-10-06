@extends('layouts.admin.app')

@section('content')


<div class="container">
<div class="form-group mb-4">
                                                <label for="" class="form-label">Kode Role</label>
                                            <select name="role_id" class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-label=".form-select-lg example"oninvalid="this.setCustomValidity('Pilih salah satu role')" oninput="setCustomValidity('')">
                                                <option value="" disabled selected>-- Pilih Kode Role--</option>
                                                @foreach ($role as $item)
                                                    @if ($item->Akses->jenis_akses === 'User') <!-- Ubah kondisi ini -->
                                                    <option value="{{ $item->id }}"{{ old('role_id') == $item->id ? 'selected' : '' }}> {{ $item->kode_role }} - {{$item->jenis_role}}</option>
                                                    @endif
                                                @endforeach
                                            </select> 
                                            @if ($errors->has('role_id'))
                                                <p class="text-danger">{{ $errors->first('role_id') }}</p>
                                            @endif
                                            </div>


                                            <div class="row">
        

                                            <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Leaderboard</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </a>
                                      
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                  
                                </div>
                            </div>
</div>
                        
                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Reward</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </a>
                                      
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                
                                    <div class="mt-4 text-center small">
                                      
                                    </div>
                                </div>
                            </div>
                        </div>

</div>
    
        
        </div>
@endsection