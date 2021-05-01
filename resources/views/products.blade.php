@extends('adminlte::page')

@section('title', 'Product PAGE')

@section('content_header')
<h1 class="text-center text-bold">KELOLA BARANG</h1>
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <button class="btn btn-primary float-left mr-3" data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah Barang</button>

          <div class="btn-group mb-5" role="group" aria-label="Basis Example">

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
                <th>ACTION</th>
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
                <td>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" id="btn-edit-product" class="btn" data-toggle="modal" data-target="#editProductModal" data-id="{{ $key->id }}" data-photo="{{$key->photo}}" data-name="{{$key->name}}" data-categories_id="{{$key->categories->id}}" data-brands_id="{{$key->brands->id}}" data-harga="{{$key->harga}}" data-qty="{{$key->qty}}"><i class="fa fa-edit"></i></button>
                    <button type="button" id="btn-delete-product" class="btn" data-toggle="modal" data-target="#deleteProductModal" data-id="{{ $key->id }}" data-photo="{{ $key->photo }}"><i class="fa fa-trash"></i></button>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body col-md-12">
        <form method="post" action="{{ route('admin.product.submit') }}" enctype="multipart/form-data">
          @csrf
          <div class="container-fluid">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="judul">Nama</label>
                <input type="text" placeholder="Masukan Nama Barang" class="form-control" name="name" id="name" required />
              </div>
              <div class="form-group col-md-6 ml-auto">
                <label for="penulis">Jumlah</label>
                <input type="number" min="0" class="form-control" placeholder="Masukan Jumlah" name="qty" id="qty" required />
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="tahun">Harga</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input type="number" min="0" placeholder="Masukan Harga" class="form-control" name="harga" id="harga" aria-label="Amount (to the nearest dollar)">

            </div>
          </div>
          <div class="form-group">
                        <label for="name">Nama Kategori</label>
                        <select class="form-control" placeholder="Masukan kategori barang" name="categories_id" id="categories_id" required />
                          <option value="">-pilih-</option>
                          @foreach ($categories as $item)
                          <option value={{ $item->id }}>{{ $item->name }}</option> 
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Merek</label>
                        <select class="form-control" placeholder="Masukan kategori barang" name="brands_id" id="brands_id" required />
                          <option value="">-pilih-</option>
                          @foreach ($brands as $item)
                          <option value={{ $item->id }}>{{ $item->name }}</option> 
                          @endforeach
                        </select>
                    </div>
          <div class="form-group">
            <label for="cover">Photo Barang</label>
            <input type="file" class="form-control" placeholder="Masukan Photo barang" name="photo" id="photo" />
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah User  -->

<!-- Modal Edit User -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Porduct</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.product.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Barang</label>
                                <input type="text" class="form-control" name="name" id="edit-name" required />
                            </div>
                            <div class="form-group">
                            <select class="form-control" placeholder="kategori barang" name="categories_id" id="edit-categories_id" required />
                              <option value="">-pilih-</option>
                                @foreach ($categories as $item)
                                <option value={{ $item->id }}>{{ $item->name }}</option> 
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                            <select class="form-control" placeholder="Merek barang" name="brands_id" id="edit-brands_id" required />
                              <option value="">-pilih-</option>
                                @foreach ($brands as $item)
                                <option value={{ $item->id }}>{{ $item->name }}</option> 
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input min="0" type="text" class="form-control" name="harga" id="edit-harga" required />
                            </div>
                            <div class="form-group">
                                <label for="qty">Stok</label>
                                <input min="0" type="text" class="form-control" name="qty" id="edit-qty" required />
                            </div>
                                <!-- <div class="input-group">
                                    <input type="text" name="roles_id" id="edit-roles_id" class="form-control" aria-label="Text input with dropdown button">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#roles_id" aria-valuetext="Admin">Admin</a>
                                            <a class="dropdown-item" href="#roles_id" aria-valuetext="User">User</a>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="image-area"></div>
                            <div class="form-group">
                                <label for="edit-photo">photo</label>
                                <input type="file" class="form-control" name="photo" id="edit-photo" />
                            </div>
                        </div>
                    </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="edit-id" />
                <input type="hidden" name="old_photo" id="edit-old-photo" />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit User -->

<!-- Modal Delete User -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah anda yakin akan menghapus data <strong class="font-italic"></strong>?
        <form method="post" action="{{ route('admin.product.delete') }}" enctype="multipart/form-data">
          @csrf
          @method('DELETE')
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" id="delete-id" value="" />
        <input type="hidden" name="old_photo" id="delete-old-photo"/>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>





@stop
@section('js')
<script>
  $(function() {
    $(document).on('click', '#btn-delete-product', function() {
      let id = $(this).data('id');
      let photo = $(this).data('old_photo');
      $('#delete-id').val(id);
      $('#delete-old-photo').val(photo);
    });


$(document).on('click', '#btn-edit-product', function() {
    let id = $(this).data('id');
    let name = $(this).data('name');
    let categories_id = $(this).data('categories_id');
    let brands_id = $(this).data('brands_id');
    let harga = $(this).data('harga');
    let qty = $(this).data('qty');
    let photo = $(this).data('old_photo');

    $('#image-area').empty();
    $('#edit-name').val(name);
    $('#edit-categories_id').val(categories_id);
    $('#edit-brands_id').val(brands_id);
    $('#edit-harga').val(harga);
    $('#edit-qty').val(qty);
    $('#edit-id').val(id);
    $('#edit-photo').val(photo);
    if (photo !== null) {
        $('#image-area').append(
            "<img src='" + baseurl + "/storage/photo_product/" + photo + "' width='200px'/>"
        );
    } else {
        $('#image-area').append('[Gambar tidak tersedia]');
    }


    // $.ajax({
    //     type: "get",
    //     url: baseurl + '/admin/ajaxadmin/dataUser/' + id,
    //     dataType: 'json',
    //     success: function(res) {
    //         console.log(res);
    //         $('#edit-name').val(res.name);
    //         $('#edit-username').val(res.username);
    //         $('#edit-email').val(res.email);
    //         $('#edit-password').val(res.password);
    //         $('#edit-roles_id').val(res.roles_id);
    //         $('#edit-id').val(res.id);
    //         $('#edit-old-photo').val(res.photo);

    //         if (res.photo !== null) {
    //             $('#image-area').append(
    //                 "<img src='" + baseurl + "/storage/photo_user/" + res.photo + "' width='200px'/>"
    //             );
    //         } else {
    //             $('#image-area').append('[Gambar tidak tersedia]');
    //         }
    //     },
    // });
  });
});

</script>
@stop