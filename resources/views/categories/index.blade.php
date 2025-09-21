@extends('layouts.app')
@section('title', '分类列表')

@section('content')
<div class="overflow-x-auto w-full">

<div class="overflow-x-auto">
  <table class="table w-full">
    <!-- head -->
    <thead>
      <tr>
        <th></th>
        <th>Name</th>
        <th>type</th>
        <th>parent_id</th>
        <th>icon</th>
      </tr>
    </thead>
    <tbody>
      <!-- row 1 -->
    @forelse($categories as $category)
      <tr>
        <th></th>
        <td>{{$category->name}}</td>
        <td>{{$category->type}}</td>
        <td>{{$category->parent_id}}</td>
        <td>{{$category->icon}}</td>
      </tr>
    @empty
    
    @endforelse
    </tbody>
  </table>
</div>
    
            
</div>
@endsection


@section('scriptsAfterJs')
  <script>
  </script>
@endsection