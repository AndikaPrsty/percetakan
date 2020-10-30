let produk
let kategori
let ukuran
let harga
let baseURL = window.location.origin
const urlParams = new URLSearchParams(window.location.search);
const id_produk = urlParams.get('id');
const formUkuran = document.getElementById('form-ukuran')


const fetchProduk = async () => {
    let res = await fetch(`${baseURL}/api/produk?id=${id_produk}`)
    res = await res.json()
    produk = res.produk
    kategori = res.kategori
    ukuran = res.ukuran
    ukuran = res.ukuran
    setKategori()
    setProdukLama()
    setUkuranLama()
    disableAllInput()
    Swal.close()
}

const disableAllInput  = (cond = true) => {
    let inputs = document.getElementsByClassName('form-produk')
    inputs = [].slice.call(inputs)
    inputs.forEach(input => {
        cond ? input.disabled = true : input.disabled = false
    })
}

const setKategori = () => {
    let select = document.getElementById('id_kategori')
    let content = ''
    kategori.forEach(ktg => {
        content += `<option value="${ktg.id}">${ktg.nama_kategori}</option>` 
    })
    select.innerHTML = content
}

const setProdukLama = () => {
    let nama_produk = document.getElementById('nama_produk')
    let id_kategori = document.getElementById('id_kategori')
    nama_produk.value = produk.nama_produk
    id_kategori.value = produk.id_kategori
    console.log(produk.id_kategori)
}

const setUkuranLama = () => {
    ukuran.forEach(ukuran => {
        let div = document.createElement('div')
        div.classList.add('row')
        div.innerHTML = `
        <div class="col-4">
            <div class="form-group">
                <label>Nama Ukuran</label>
                <input type="text" required="true" value="${ukuran.nama_ukuran}" name="nama_ukuran"
                    class="form-control nama_ukuran old-ukuran form-produk">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label>Ukuran</label>
                <input type="text" required="true" value="${ukuran.ukuran}" name="ukuran"
                    class="form-control ukuran old-ukuran form-produk">
            </div>

        </div>
        <div class="col-4">
            <div class="form-group">
                <label>Harga (Rp)</label>
                <div class="input-group">
                    <input type="text" value="${ukuran.harga}" name="harga"
                        class="form-control harga form-produk old-ukuran">
                </div>
            </div>
        </div>`

        formUkuran.append(div)
    })

}

fetchProduk()