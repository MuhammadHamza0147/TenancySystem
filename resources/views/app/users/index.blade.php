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
                                <h4 class="fw-bold mt-2">Tanent List</h4>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <x-link-btn class="bg-secondary" href="{{route('tenant.create')}}">Create</x-link-btn>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Domain</th>
                                    <th scope="col" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $tenant)
                                <tr>
                                    <th scope="row">{{$tenant->id}}</th>
                                    <td>{{$tenant->name}}</td>
                                    <td>{{$tenant->email}}</td>
                                    @foreach ($tenant->domains as $domain)
                                        <td>{{$domain->domain}}</td>
                                    @endforeach
                                    <td>
                                        <x-link-btn class="bg-secondary" href="{{route('tenant.edit', $tenant->id)}}">Edit</x-link-btn>
                                    </td>
                                    <td>
                                        <form action="{{route('tenant.destroy' , $tenant->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <input type="hidden" name="id" value="{{$tenant->id}}">
                                            <button type="submit" class="btn text-white bg-secondary">Delete</button>
                                        </form>
                                        {{-- <x-link-btn class="bg-secondary" href="{{route('tenant.destroy', $tenant->id)}}">Delete</x-link-btn> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    </section>
</x-tenant-app-layout>
