function numThousand(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

let barcode = document.querySelector("#barcode");
// let barcodelHidden = document.querySelector("#barcodeHidden");
let jmlhJual = document.querySelector("#jmlhJual");

let namaBarang = document.querySelector("#namaBarang");
let namaBarangHidden = document.querySelector("#namaBarangHidden");
let hrgBeli = document.querySelector("#hrgBeli");
let hrgJual = document.querySelector("#hrgJual");
let hrgJualHidden = document.querySelector("#hrgJualHidden");

let btnTambah = document.querySelector("#btnTambah");
let total = document.querySelector("#total");
let kode = document.querySelector("#kode");
let save = document.querySelector("#save");

// let tabelKasir = document
//     .querySelector("#tabelKasir")
//     .getElementsByTagName("tbody")[0];

barcode.addEventListener("input", function () {
  fetch(`/kasir-barcode-data?barcode=${barcode.value}`)
    .then((response) => response.json())
    .then((data) => {
      if (data.barang !== null) {
        barcode.value = data.barang.barcode;
        namaBarang.value = data.barang.namaBarang;
        hrgBeli.value = data.barang.hrgBeli;
        hrgJual.value = data.barang.hrgJual;

        // barcodelHidden.value = data.barang.barcode;
        namaBarangHidden.value = data.barang.namaBarang;
        hrgJualHidden.value = data.barang.hrgJual;
        console.log(barcode.value, namaBarang.value, hrgBeli.value, hrgJual.value,
          namaBarangHidden.value, hrgJualHidden.value);
      } else {
        barcode.value = "";
        namaBarang.value = "";
        hrgBeli.value = "";
        hrgJual.value = "";
      }
    });
});

$(document).ready(function () {
  detail();
  total();

  function detail() {
    $.ajax({
      type: "GET",
      url: "/kasir/detail/{noFakturJualan}",
      dataType: "json",
      success: function (response) {

        // console.log(response.penjualan);
        // console.log(response.total);

        $('#total').innerHtml = response.total;

        $('tbody').html('');
        $.each(response.penjualan, function (key, item) {
          $('tbody').append(
            '<tr class= "border-b bg-white text-black hover:bg-gray-50 text-center w-full">\
                              <td class="items-center py-3 px-7 dark:text-white">' + parseInt(key + 1) + '</td>\
                              <td class="items-center py-3 px-7 dark:text-white">' + item.barcode + '</td>\
                              <td class="items-center py-3 px-7 dark:text-white">' + item.namaBarang + '</td>\
                              <td class="items-center py-3 px-7 dark:text-white">' + item.jmlhJual + '</td>\
                              <td class="items-center py-3 px-7 dark:text-white">' + item.hrgJual + '</td>\
                              <td class="items-center py-3 px-7 dark:text-white">' + item.jmlhJual * item
              .hrgJual + '</td>\
                            </tr>')
        });
      }
    })
  }

  function total() {
    $.ajax({
      type: "GET",
      url: "/kasir/detail/{noFakturJualan}",
      dataType: "json",
      success: function (response) {

        // console.log(response.penjualan);
        // console.log(response.total);
        $('#total').html('');
        $('#total').append(
          '<input type="number" class="w-full p-2" min="0" value="' +
          response
            .total + '" disabled>');
      }
    })
  }

  $(document).on("keyup", '#bayar', function (e) {
    e.preventDefault();
    var bayar = {
      'bayar': $('#bayar').val(),
    }

    $.ajax({
      type: "GET",
      url: "/kasir/detail/{noFakturJualan}",
      data: bayar,
      dataType: "json",
      success: function (response) {
        // console.log(response.penjualan);
        // console.log(response.total);
        // console.log(response.kembali);
        $('#kembali').html('');
        $('#kembali').append(
          '<input type="number"  min="0" class="w-full p-0" value="' +
          numThousand(response.kembali) + '" disabled>');
      }
    })
  })

  bayar.addEventListener('keyup', function () {
    document.querySelector("#bayar").innerHTML = numThousand(bayar.value);
  });

  $(document).on("click", '#btnTambah', function (e) {
    e.preventDefault();

    var data = {
      'noFakturJualan': $('#noFakturJualan').val(),
      'barcode': $('#barcode').val(),
      'namaBarang': $('#namaBarang').val(),
      'jmlhJual': $('#jmlhJual').val(),
      'hrgJual': $('#hrgJual').val(),
      'hrgBeli': $('#hrgBeli').val()
    }
    console.log(data);

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: "POST",
      url: "/kasir/store",
      data: data,
      dataType: "json",
      success: function (response) {
        barcode.value = "";
        namaBarangHidden.value = "";
        namaBarang.value = "";
        hrgJual.value = "";
        hrgJualHidden.value = "";
        jmlhJual.value = "";
        detail();
        total();
      }
    })
  });
});
