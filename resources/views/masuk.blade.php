@extends('adminlte::page')

@section('title', 'Product PAGE')

@section('content_header')
<h1 class="text-center text-bold">IMPORT BARANG</h1>
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
        <div style="text-align: center;">
        <div class="btn-group" role="group" aria-label="Basis Example">
            <a class="btn btn-info" style="color: white;" data-toggle="modal" data-target="#importDataModal">Import</a>
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
<!-- MODAL IMPORT DATA FORM -->
<div class="modal fade" id="importDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden='true'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal=tittle" id="exampleModalLabel">Import data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    <div class="modal-body">
        <form method="post" action="{{route('admin.product.import')}}" enctype="multipart/form-data>">
            @csrf
    <div class="form-group">
        <label for="cover">Upload File</label><input type="file" class="form-control" name="file"/>
    </div>
</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">batal</button><button type="submit" class="btn btn-primary">Import Data</button></form>
    </div>
</div>
</div>





@stop
@section('js')
<script>
</script>
@stop