 @extends('Backend.layouts.master')

 @section('customCss')
     @include('Backend/pages/users/partials/custom_css')
 @endsection

 @section('title')
     Admin Dashboard - Edit User ({{ $user->name }})
 @endsection


 @section('main_content')
     <!-- page title area start -->
     <div class="page-title-area">
         <div class="row align-items-center">
             {{-- header breadcrumbs area --}}
             <div class="col-sm-6 clearfix">
                 <div class="breadcrumbs-area clearfix">
                     <h4 class="page-title pull-left">Dashboard</h4>
                     <ul class="breadcrumbs pull-left">
                         <li><a href="{{ route('admin.users.index') }}">Users</a></li>
                         <li><span>Edit User</span></li>
                     </ul>
                 </div>
             </div>
             {{-- header right corner profile view --}}
             <div class="col-sm-6">
                 <x-myProfileInHeader>

                 </x-myProfileInHeader>
             </div>
         </div>
     </div>
     <!-- page title area end -->
     <div class="main-content-inner">
         <div class="row">
             <!-- Primary table start -->
             <div class="col-3"></div>
             <div class="col-6 mt-5">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="header-title">
                             Edit User ({{ $user->name }})
                             <a href="{{ route('admin.users.index') }}" class="btn btn-info btn-xs float-right">All
                                 Users</a>
                         </h4>
                         <form action="{{ route('admin.users.update', $user->id)  }}" id="UserSubmissionForm" method="POST">
                            @method('PUT')
                             @csrf
                             <div class="form-group">
                                 <label for="name">User Name</label>
                                 <input type="text" class="form-control  @error('name') is-invalid @enderror "
                                     id="name" name="name" placeholder="User Name" value="{{ $user->name }}">
                                 @error('name')
                                     <span class="fw-bold text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                             <div class="form-group">
                                 <label for="email">User Email</label>
                                 <input type="email" class="form-control  @error('email') is-invalid @enderror "
                                     id="email" name="email" placeholder="User Email" value="{{ $user->email }}">
                                 @error('email')
                                     <span class="fw-bold text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                             <div class="form-group password_grp">
                                 <label for="password">User Password</label>
                                 <input type="password" class="form-control  @error('password') is-invalid @enderror "
                                     id="password" name="password" placeholder="User Password">
                                 <i class="fa fa-eye togglePassword" onclick="togglePassView(this)" aria-hidden="true"></i>
                                 @error('password')
                                     <span class="fw-bold text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                             <div class="form-group confirm_password_grp">
                                 <label for="confirm_password">Confirm Password</label>
                                 <input type="password"
                                     class="form-control  @error('confirm_password') is-invalid @enderror "
                                     id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                                 <i class="fa fa-eye toggleConfirmPassword" onclick="togglePassView(this)"
                                     aria-hidden="true"></i>
                                 @error('confirm_password')
                                     <span class="fw-bold text-danger">{{ $message }}</span>
                                 @enderror
                             </div>

                             {{-- this error border not worked in select tag that's why i use a customErrorCss and apply it in parent div tag --}}
                             <div class="form-group @error('roles') customErrorCss @enderror">
                                 <label for="roles">Assign Roles</label>
                                 <select name="roles[]" id="roles" multiple="multiple" class="3col active">
                                     @foreach ($roles as $role)
                                     {{-- hasRole() this is a spatie default function to check user role --}}
                                         <option value="{{ $role->name }}"
                                             {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}
                                         </option>
                                     @endforeach
                                 </select>
                                 @error('roles')
                                     <span class="fw-bold text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                             <button type="submit" class="btn btn-sm btn-success mt-4 pr-4 pl-4">Update User</button>
                         </form>
                     </div>




                 </div>
             </div>
         </div>
         <!-- Primary table end -->
     </div>
 @endsection


 @section('customJs')
     {{-- <script src="{{ asset('backend/assets/js/vendor/jquery_3.6.4.min.js') }}"></script> --}}
     {{-- include update jquery plugins.old one not work properly --}}
     @include('Backend/pages/users/partials/script')
 @endsection
