@extends('layouts.main')

@section('style')
<style media="screen">
  .uppercase::first-letter {
    text-transform: capitalize;
  }
  .card.in-cart-product{
    margin-bottom: 0;
    border-bottom: 1px solid #eef5f9;
  }
  .card:hover{
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.12), 0 2px 4px 0 rgba(0,0,0,0.08);
  }
</style>
@endsection

@section('content')
<header class="page-header mb-3">
  <div class="container-fluid">
    <h2>Transaksi Jual Barang</h2>
  </div>

</header>

<section class="point-of-sale">
  <div class="container-fluid">
    <div class="alert alert-info mt-4">
      <strong>Penjualan</strong> adalah tempat menjual barang. Pilih barang yang diinginkan oleh pembeli, lalu isi data disebelah kanan.<br>
    </div>
    <div class="row">
      <div class="col-md-7">
        <h3>Pilihan Barang</h3>
        <div class="card" style="padding: 20px;">
          <table class="table products">
            <thead>
              <tr>
                <th scope="col">NAMA</th>
                <th scope="col">HARGA</th>
                <th scope="col">STOK</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $p)
                <tr>
                  <td class="uppercase" id="product-name-id-{{$p->id_product}}">{{$p->name}}</td>
                  <td id="product-price-id-{{$p->id_product}}">Rp {{$p->price}}</td>
                  <td align="center" id="product-quantity-id-{{$p->id_product}}">{{$p->quantity - $p->on_rent}}</td>
                  <td align="center">
                    <input type="number" name="" required min="1" max="{{$p->quantity - $p->on_rent}}" id="product-chosen-id-{{$p->id_product}}" style="width: 50%" class="angka" value="1">
                    <button type="submit" name="button" class="btn btn-sm add-to-cart" product-id={{$p->id_product}}><i style="color: green" class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
      <div class="col-md-5">
        <h3>Keranjang <i class="fa fa-shopping-cart" aria-hidden="true"></i></h3>
        <div class="cart">
          <div class="card">
            <table class="table">
              <thead>
                <div class="alert alert-primary" role="alert">
                  <small>1. klik 'Bayar uang muka' jika pembeli hanya membayar sebagian<br>
                  2. klik 'Tambahkan diskon' jika anda memberi diskon<br>3. klik Lanjutkan jika transaksi sudah benar</small>
                </div>
                <tr>
                  <th scope="col">NAMA BARANG</th>
                  <th scope="col">JUMLAH BARANG</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody id="cart_body">



              </tbody>
            </table>
            <div class="card-body">
              <h4 id="total_price">Total: Rp 0</h4>
              <hr>
                <form id="myForm" autocomplete="off">
                  <div class="form-group">
                    <label for="nama_penyewa">Nama pembeli</label>
                    <input type="text" class="form-control" id="nama_penyewa" placeholder="Nama pembeli" required name="cust_name">
                  </div>
                  <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea class="form-control" id="address" placeholder="Alamat pembeli" name="address" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="address">No. Telepon</label>
                    <input type="text" class="form-control" id="cust_phone" placeholder="No. Telepon" name="cust_phone" required>
                  </div>
                  <div class="form-group" style="display: none" id="dp_field">
                    <label for="dp">Uang muka</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">Rp</div>
                      </div>
                      <input type="text" class="angka form-control" id="dp" placeholder="Uang muka" name="dp">
                    </div>
                    <small class="text-danger">Kosongi jika pembayaran langsung lunas</small>
                  </div>
                  <div class="form-group">
                    <label for="cash">Tunai (Uang yang anda terima)</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">Rp</div>
                      </div>
                      <input type="text" class="angka form-control" id="cash" placeholder="Tunai" required name="cash">
                    </div>
                  </div>
                  <div class="form-group" style="display: none" id="discount_field">
                    <label for="discount">Diskon (Diskon yang anda berikan)</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">Rp</div>
                      </div>
                      <input type="text" class="angka form-control" id="discount" placeholder="Opsional" name="discount">
                    </div>
                    <small class="text-danger">Kosongi jika tidak ada diskon</small>
                  </div>

                  <div class="form-group">
                    <label for="product_description">Keterangan</label>
                    <textarea class="form-control" id="product_description" placeholder="Opsional" name="product_description"></textarea>
                  </div>

                <button id="add_dp" type="button" class="btn btn-sm btn-info mb-2" name="button">Bayar Uang Muka</button>
                <button id="add_discount" type="button" class="btn btn-sm btn-success mb-2" name="button">Tambahkan Diskon</button>
                <button class="btn btn-primary btn-sm mb-2" type="submit" name="button">Lanjutkan</button>

                <input type="hidden" name="total_price_hidden" value="" id="total_price_hidden">
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container-fluid">
  <div class="modal fade after-transaction" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h3>Transaksi Pemesanan Berhasil!</h3>
          <p id="change"></p>
          <a href="#" class="btn btn-sm btn-success see-invoice mb-2" target="_blank">Klik untuk melihat nota!</a><br>
          <a href="#" class="btn btn-sm btn-success download-invoice" target="_blank">Klik untuk download nota!</a>
        </div>
      </div>
  </div>
</div>

</div>


@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function(){

    $('.angka').mask('0.000.000.000.000', {reverse: true});

    var selected_products = [];
    var selected_products_objects = [];
    var invoice_id;
    var diskon, dp = 0;

    $("#add_discount").click(function(){
      if (!diskon) {
        $("#discount_field").css('display', 'block');
        $("#add_discount").text('Hilangkan Diskon');
        $("#discount").val(0);
        diskon = 1;
      }else {
        $("#discount_field").css('display', 'none');
        $("#add_discount").text('Tambahkan Diskon');
        diskon = 0;
      }
    })

    $("#add_dp").click(function(){
      if (!dp) {
        $("#dp_field").css('display', 'block');
        $("#add_dp").text('Hilangkan Uang Muka');
        $("#dp_field").val(0);
        dp = 1;
      }else {
        $("#dp_field").css('display', 'none');
        $("#add_dp").text('Tambahkan Uang Muka');
        dp = 0;
      }
    })

    function Product(){
      this.name= '';
      this.id_product= '';
      this.price = '';
      this.chose = 0;
    }

    var total_price = 0;

    function searchProducts(id_prod, quantity){
      for (var i = 0; i < selected_products_objects.length; i++) {
        if (selected_products_objects[i].id_product == id_prod) {
          selected_products_objects[i].chose += quantity;
          return;
          // return selected_products_objects;
        }
      }
    }

    function returnProductIndex(id_product){
      for (var i = 0; i < selected_products_objects.length; i++) {
        if (selected_products_objects[i].id_product == id_product) {
          return i;
        }
      }
    }


    function findProduct(id_product){
      for (var i = 0; i < selected_products.length; i++) {
        if (selected_products[i] == id_product) {
          return i;
        }
      }
    }

    $(document).on('click', '.remove', function(){

      console.log(selected_products)


      id_product = $(this).attr('id-product');
      amount = parseInt($("#in-cart-quantity-product-" + id_product).text());
      $("#t-row-" + id_product).remove();
      price = parseInt($("#product-price-id-" + id_product).text().slice(2));

      index = findProduct(id_product);
      selected_products.splice(index, 1);
      total_price -= (amount*price);

      quantity = parseInt($("#product-quantity-id-" + id_product).text());
      $("#product-quantity-id-" + id_product).text(quantity + amount);
      max_quantity = $("#product-chosen-id-" + id_product).attr('max');
      $("#product-chosen-id-" + id_product).attr('max', max_quantity + amount);

      var	reverse = total_price.toString().split('').reverse().join(''),
        ribuan 	= reverse.match(/\d{1,3}/g);
        ribuan	= ribuan.join('.').split('').reverse().join('');
        // console.log(price)
      $("#total_price").text("Total: Rp " + ribuan);
      $("#total_price_hidden").val(total_price);

      indexProd = returnProductIndex(id_product);
      selected_products_objects.splice(indexProd, 1);
      // return false;
    });


    $(document).on('click','.add-to-cart', function(){
      id_product = $(this).attr('product-id');
      quantity = $("#product-quantity-id-" + id_product).text();


      prod_obj = $("#product-chosen-id-" + id_product)
      quantity_chosen = $("#product-chosen-id-" + id_product).val();
      product_name = $("#product-name-id-" + id_product).text();
      console.log(quantity_chosen)
      console.log(prod_obj)

      if (parseInt(quantity_chosen) > $("#product-chosen-id-" + id_product).attr('max')) {
        // console.log("max is " + $("#product-chosen-id-" + id_product).attr('max'))
        return false;
      }

      product_name =  $("#product-name-id-" + id_product).text()

      $("#product-quantity-id-" + id_product).text(parseInt(quantity) - parseInt(quantity_chosen));
      $("#product-chosen-id-" + id_product).attr('max', parseInt(quantity) - parseInt(quantity_chosen));

      price = parseInt($("#product-price-id-" + id_product).text().slice(2)) * parseInt(quantity_chosen);
      total_price+=price;


      //cek udah ada di cart belum?
      if (selected_products.includes(id_product)) {
        // console.log("1")
        searchProducts(id_product, parseInt(quantity_chosen));
        // product.chose += parseInt(quantity_chosen);
        incart_quantity = $("#in-cart-quantity-product-"+id_product).text();
        $("#in-cart-quantity-product-"+id_product).text(parseInt(incart_quantity) + parseInt(quantity_chosen));
        console.log("udah pernah")
      }else {
        selected_products.push(id_product);

        product = new Product();
        product.id_product = id_product;
        product.name = product_name;
        product.chose += parseInt(quantity_chosen);
        product.price = $("#product-price-id-" + id_product).text().slice(2);
        selected_products_objects.push(product);
        // console.log("quantity chosen ", quantity_chosen)

        html = '<tr id="t-row-'+id_product+'">'+
          '<td>'+product_name+'</td>'+
          '<td id="in-cart-quantity-product-'+id_product+'">'+quantity_chosen+'</td>'+
          '<td><button class="remove" id="remove-product-'+id_product+'" id-product="'+id_product+'" class="btn"><i style="color: red" class="fa fa-trash"></i></button></td>'+
        '</tr>';

        $(".cart tbody").append(html);

      }
      var	reverse = total_price.toString().split('').reverse().join(''),
      	ribuan 	= reverse.match(/\d{1,3}/g);
      	ribuan	= ribuan.join('.').split('').reverse().join('');

      $("#product-chosen-id-" + id_product).val(1)
      $("#total_price").text("Total: Rp " + ribuan);
      $("#total_price_hidden").val(total_price);
      // console.log(selected_products_objects);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#myForm").submit(e => {

      if (selected_products.length == 0) {
        alertify.error("Mohon untuk memilih barang.")
        return false;
      }

      $("#cash").val($("#cash").val().split('.').join(""))
      $("#dp").val($("#dp").val().split('.').join(""))
      $("#discount").val($("#discount").val().split('.').join(""))

      if (diskon && dp) {
        dp_amount = parseInt($("#dp").val())
        discount_amount = parseInt($("#discount").val())
        cash = parseInt($("#cash").val())
        total_item_price = parseInt($("#total_price_hidden").val())

        if (cash < dp_amount) {
          console.log("hihi")
          alertify.error("Tunai tidak mencukupi untuk membayar uang muka!");
          return false;
        }
      }

      else if (diskon) {
        discount_amount = parseInt($("#discount").val())
        cash = parseInt($("#cash").val())
        total_item_price = parseInt($("#total_price_hidden").val())
        if (total_item_price - discount_amount > cash) {
          alertify.error("Tunai tidak mencukupi untuk membayar barang!");
          return false;
        }
        console.log("ok")
        // $("#total_price_hidden").val(parseInt(total_price) - parseInt(discount_amount));
      }

      else if (dp){
        cash = parseInt($("#cash").val())
        dp_amount = parseInt($("#dp").val())
        if (cash < dp_amount) {
          alertify.error("Tunai tidak mencukupi untuk membayar uang muka!");
          return false;
        }
      }
      else {
        cash = parseInt($("#cash").val())
        total_item_price = parseInt($("#total_price_hidden").val())
        if (cash < total_item_price) {
          alertify.error("Tunai tidak mencukupi untuk membayar barang!");
          return false;
        }
      }



      html_content = '';
      e.preventDefault();
      //cek bayar uang muka
      var myForm = document.getElementById('myForm');
      formData = new FormData(myForm);

      formData.append('products', JSON.stringify(selected_products_objects));

      total_item_price = parseInt($("#total_price_hidden").val())
      cash = parseInt($("#cash").val());
      console.log(total_item_price)

      change = 0;

      change = total_item_price - cash;

      if(diskon && dp){
        diskon_amount = parseInt($("#discount").val())
        dp_amount = parseInt($("#dp").val());

        change = cash - dp_amount;
      }
      else if (dp) {
        dp_amount = parseInt($("#dp").val());
        change = cash - dp_amount;
      }
      else if (diskon) {
        diskon_amount = parseInt($("#discount").val())
        change = total_item_price - diskon_amount - cash;
      }
      else {
        change = total_item_price - cash;
      }


      console.log("change is" + parseInt(change))


        ribuan = "Rp " + Math.abs(change).toString();
      // tak comment disek, soale pas submit ribuan is null


      $.ajax({
          url: '{{route('new.transaction.sell')}}',
          method: "POST",
          processData: false,
          contentType: false,
          data: formData,
          dataType: 'JSON',
          success: data => {
              if (data.message == "success") {
                $("#change").html("Kembalian: " + ribuan)
                $(".after-transaction").modal('show');
                invoice_id = data[0].id_invoice;
                var url = '{{url('/lihat/nota')}}/' + invoice_id;
                var url2 = '{{url('/download/nota')}}/' + invoice_id;
                $(".see-invoice").attr('href', url);
                $(".download-invoice").attr('href', url2);
              }
              $("#cart_body").text("");
              total_price = 0;
              $("#total_price").text("Total: Rp 0");
              selected_products_objects.splice(0,selected_products_objects.length);
              selected_products.splice(0,selected_products.length);
              $('#myForm').trigger("reset");
          },
          error: data => {
            alert("Server Error")
            console.log(data)
            newData = JSON.parse(data.responseText)
            alert(newData.message + ", file: " + newData.file
            + ", line: " + newData.line);
          }
      });

    });

    table1 = $('table.products').DataTable({
    stateSave: true,
    language: {
      searchPlaceholder: "Cari barang ..."
    }
  });

  });
</script>
@endsection
