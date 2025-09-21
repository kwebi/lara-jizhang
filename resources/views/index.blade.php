@extends('layouts.app')
@section('title', '商品列表')

@section('content')
  @forelse  ($transactions as $transaction)
            {{ $transaction->id }} 
            - {{ $transaction->amount }}
            - {{ $transaction->category->name ?? 'No Category' }}
            - {{ $transaction->account->name ?? 'No Account' }}
            - {{ $transaction->member->name ?? 'No Member' }}
            - {{ $transaction->tag->name ?? 'No Tag' }}
            - {{ $transaction->note ?? 'No Note' }}
            - {{ $transaction->time }} 
          <br>
    @empty
        {{$name}}

        <p>Copyrite{{$year}}</p>
         <a href="{{ route('transaction.create') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
            新建
        </a>
  @endforelse

@endsection


@section('scriptsAfterJs')
  <script>
  </script>
@endsection