<x-tenant-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-title">
                                @if (isset($userEdit))
                                    <h4 class="fw-bold mt-2">Edit User</h4>
                                @else
                                    <h4 class="fw-bold mt-2">Create User</h4>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <x-link-btn class="bg-secondary" href="{{route('user.index')}}">List</x-link-btn>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form @if(isset($userEdit)) action="{{route('user.update' , $userEdit->id)}}" @else action="{{route('user.store')}}" @endif method="POST">
                        @if(isset($userEdit))
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="form-group mt-2">
                            <label class="fw-bold" for="name">User Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter User Name" @if(isset($userEdit)) value="{{$userEdit->name}}" @else value="{{old('name')}}" @endif>
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mt-2">
                            <label class="fw-bold" for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address"  @if(isset($userEdit)) value="{{$userEdit->email}}" @else value="{{old('email')}}" @endif>
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>     
                        @if(isset($userEdit) && count($userEdit->roles) > 0)
                            @foreach ($userEdit->roles as $selectedrole) @endforeach  
                        @endif
                        <div class="form-group mt-2"> 
                            <label class="fw-bold" for="email">Select Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="">Select Role</option>
                                @if(isset($userEdit))
                                    
                                    @foreach ($roles as $role)
                                        @if (isset($userEdit) && count($userEdit->roles) > 0)
                                            <option style="text-transform: capitalize" value="{{$role->name}}" @if(count($userEdit->roles) > 0  && $selectedrole->id == $role->id) selected @endif>{{$role->name}}</option>
                                        @else
                                            <option style="text-transform: capitalize" value="{{$role->name}}" @if(count($userEdit->roles) > 0 ) selected @endif>{{$role->name}}</option> 
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($roles as $role)
                                        <option style="text-transform: capitalize" value="{{$role->name}}" @if(isset($userEdit) && $userEdit->roles->id == $role->id) selected @endif>{{$role->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('role')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        @if(isset($userEdit)) @else 
                        <div class="form-group mt-2">
                            <label class="fw-bold" for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        @endif
                        
                        <div class="form-group mt-2 text-end">
                            <button type="submit" class="btn bg-secondary text-white">Save & Continue</button>
                        </div>
                    </form>             
                </div>
            </div>
        </div>
    </section>
</x-tenant-app-layout>
