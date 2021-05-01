@extends('adminlte::page')

@section('title', 'Product PAGE')

@section('content_header')
<h1 class="text-center text-bold">EKSPORT BARANG</h1>
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
        <div style="text-align: center;">
        <div class="btn-group" role="group" aria-label="Basis Example">
            <a href="{{ route('admin.product.export') }}" class="btn btn-info" target="_blank">Export</a>
        </div>
        </div>
          <table id="table-data" class="table table-borderer display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>NO</th>
                <th>FOTO</th>
                <th>NAMA</th>
                <th>KATEGORI</th>
                <th>MEREK</th>
                <th>HARGA</th>
                <th>STOK</th>
              </tr>
            </thead>
            <tbody>
              @php $no=1; @endphp
              @foreach($barang as $key)
              <tr>
                <td>{{$no++}}</td>
                <td>
                  @if($key->photo !== null)
                  <img src="{{ asset('storage/photo_barang/'.$key->photo) }}" width="100px" />
                  @else
                  [Picture Not Found]
                  @endif
                </td>
                <td>{{$key->name}}</td>
                <td>{{$key->categories->name}}</td>
                <td>{{$key->brands->name}}</td>
                <td>{{$key->harga}}</td>
                <td>{{$key->qty}}</td>
                
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>





@stop
@section('js')
<script>
</script>
@stop