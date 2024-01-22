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
                                @if (isset($tenantEdit))
                                    <h4 class="fw-bold mt-2">Edit Tanent</h4>
                                @else
                                    <h4 class="fw-bold mt-2">Create Tanent</h4>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <x-link-btn class="bg-secondary" href="{{route('tenant.index')}}">List</x-link-btn>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form @if(isset($tenantEdit)) action="{{route('tenant.update' , $tenantEdit->id)}}" @else action="{{route('tenant.store')}}" @endif method="POST">
                        @if(isset($tenantEdit))
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="form-group mt-2">
                            <label class="fw-bold" for="name">Tenant Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Tenant Name" @if(isset($tenantEdit)) value="{{$tenantEdit->name}}" @else value="{{old('name')}}" @endif>
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mt-2">
                            <label class="fw-bold" for="domain">Domain Name</label>
                            <input type="text" class="form-control" id="domain" name="code" placeholder="Enter Domain Name"  @if(isset($tenantEdit)) value="{{$tenantEdit->id}}" @else value="{{old('code')}}" @endif readonly>
                            @error('code')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mt-2">
                            <label class="fw-bold" for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address"  @if(isset($tenantEdit)) value="{{$tenantEdit->email}}" @else value="{{old('email')}}" @endif>
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        @if(isset($tenantEdit)) @else 
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
    <script>
        $(document).ready(function() {
            $('#name').on('keyup', function() {
                var tenantName = $(this).val();
                var domainName = tenantName.toLowerCase().replace(/[^a-zA-Z0-9_]/g, '_');
                $('#domain').val(domainName);
            });
        });
    </script>
</x-tenant-app-layout>
