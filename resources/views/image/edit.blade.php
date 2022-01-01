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
                       

                        </div>
                        <div class="col-sm-6">
            @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
            </div>
            @endif
                                {{-- Add image form here --}}

                                <form action="{{url('image/update/'.$images->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Image Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{$images->name}}" aria-describedby="emailHelp">
    @error('name')
    <span class="text-danger">{{$message}}</span>    
    @enderror
    
  </div>
  <div class="mb-3">
    <img src="{{asset($images->img)}}" alt="" style="width: 200px; height:150px;">
   
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">upload image</label>
    <input type="file" class="form-control" name="img" value="{{$images->img}}" id="exampleInputPassword1">
    @error('img')
    <span class="text-danger">{{$message}}</span>    
    @enderror
  </div>
  <div class="mb-3">
    
    <input type="hidden" class="form-control" name="old_img" value="{{$images->img}}" id="exampleInputPassword1">
   
  </div>
   <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Description</label>
    <input type="text" class="form-control" name="description" value="{{$images->description}}" id="exampleInputPassword1">
    @error('description')
    <span class="text-danger">{{$message}}</span>    
    @enderror
  </div>
 
  <button type="submit" class="btn btn-primary">Update image</button>

 
</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>