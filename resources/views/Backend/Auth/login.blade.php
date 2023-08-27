 @extends('Backend.Auth.auth_master')
 @section('customCss')
     <style>
         .errorBorder {
             border: 1px solid red !important;
         }
     </style>
 @endsection
 @section('title')
     Login | Admin Panel
 @endsection

 @section('main_content')
     <div class="login-area">
         <div class="container">
             <div class="login-box ptb--100">
                 <form method="POST" action="{{ route('admin.login.submit') }}">
                     @csrf
                     <div class="login-form-head">
                         <h4>Admin Login</h4>
                     </div>


                     <div class="login-form-body {{ Session::has('error') ? 'errorBorder' : '' }}">
                         @if (Session::has('error'))
                             <div class="text-center text-light font-weight-bold bg-danger py-3 mb-5 rounded">
                                 <span>{{ Session::get('error') }}</span>
                             </div>
                         @endif
                         <div class="form-gp">
                             <label for="email">Email / Username</label>
                             <input name="email" type="text" id="email"
                                 class="@error('email') errorBorder @enderror">
                             <i class="ti-email mt-2"></i>
                             <div class="text-danger">
                                 @error('email')
                                     <span class="fw-bold text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                         <div class="form-gp">
                             <label for="password">Password</label>
                             <input name="password" type="password" id="password"
                                 class="@error('password') errorBorder @enderror">
                             <i class="ti-lock mt-2"></i>
                             <div class="text-danger">
                                 @error('password')
                                     <span class="fw-bold text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                         <div class="row mb-4 rmber-area">
                             <div class="col-6">
                                 <div class="custom-control custom-checkbox mr-sm-2">
                                     <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                     <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                                 </div>
                             </div>
                             <div class="col-6 text-right">
                                 <a href="#">Forgot Password?</a>
                             </div>
                         </div>
                         <div class="submit-btn-area">
                             <button id="form_submit" class="" type="submit">Submit <i
                                     class="ti-arrow-right"></i></button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 @endsection
