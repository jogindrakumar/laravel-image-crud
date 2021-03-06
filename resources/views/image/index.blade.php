<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           All Image
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                

                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            {{-- All image here --}}
                            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image Name</th>
      <th scope="col">image </th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
    @php($i = 1)
    @foreach ($images as $image)
      
   
    <tr>
      <th scope="row">{{$i++}}</th>
      <td>{{$image->name}}</td>
      <td>{{$image->description}}</td>
      <td><img src="{{asset($image->img)}}" alt="" style="width: 150px; height:100px"></td>
      <td><a href="{{url('image/delete/'.$image->id)}}" class="btn btn-danger">Delete</a></td>
      <td><a href="{{url('image/edit/'.$image->id)}}" class="btn btn-warning">Edit</a></td>
      
    </tr>
    @endforeach
  </tbody>
</table>

                        </div>
                        <div class="col-sm-6">
            @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
            </div>
            @endif
                                {{-- Add image form here --}}

                                <form action="{{route('store.image')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Image Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
    @error('name')
    <span class="text-danger">{{$message}}</span>    
    @enderror
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">upload image</label>
    <input type="file" class="form-control" name="img" id="exampleInputPassword1">
    @error('img')
    <span class="text-danger">{{$message}}</span>    
    @enderror
  </div>
   <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Description</label>
    <input type="text" class="form-control" name="description" id="exampleInputPassword1">
    @error('description')
    <span class="text-danger">{{$message}}</span>    
    @enderror
  </div>
 
  <button type="submit" class="btn btn-primary">upload image</button>

 
</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>