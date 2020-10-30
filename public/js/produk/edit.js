let produk, kategori, ukuran, harga, image
let baseURL = window.location.origin
let btnPreview
let produkEdit = document.getElementById('edit-produk')
const urlParams = new URLSearchParams(window.location.search);
const id_produk = urlParams.get('id');
const formUkuran = document.getElementById('form-ukuran')
const imageContainer = document.getElementById('gambar-container')
const backButton = document.getElementById('btn-back')
const delButton = document.getElementById('btn-del')
let editMode


const fetchProduk = async () => {
    delButton.disabled = false
    produkEdit.disabled = false
    editMode ? Swal.showLoading() : null
    backButton.innerText = 'Kembali'
    let res = await fetch(`${baseURL}/api/produk?id=${id_produk}`)
    res = await res.json()
    produk = res.produk
    kategori = res.kategori
    ukuran = res.ukuran
    ukuran = res.ukuran
    image = res.gambar
    setKategori()
    setProdukLama()
    setUkuranLama()
    setGambar()
    disableAllInput()
    showImgDelete(false)
    showEditButton(false)
    editMode = false
    Swal.close()
}

const alertConfirmation = async (msg,color,func) => {
    let res = await Swal.fire({
        title: msg,
        showCancelButton: true,
        confirmButtonText: 'Konfirmasi' ,
        cancelButtonText:'Batal',
        confirmButtonColor: color ? color : 'red'
    })
    res.value ? func() : alert('batal')
}

const deleteImage = async () => {
    let res = await fetch(`${baseURL}/api/produk`)
}

const previewGambar = async (id) => {
    let prevImg = image.filter(img => {
        return img.id === id
    })
    prevImg = prevImg[0].gambar
    await Swal.fire({
        imageUrl: `${baseURL}/image/produk/${prevImg}`,
        imageHeight: 420,
    })
}

const setGambar = () => {
    let content = ''
    image.forEach(img => {
        content += `<tr>
        <td>${img.gambar}</td>
        <td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
                <button onClick="previewGambar('${img.id}')" class="btn btn-preview btn-info mr-1"><i
                        class="fas fa-eye"></i></button>
                <button class="btn btn-danger img-del"><i
                        class="fas fa-trash"></i></button>
            </div>
        </td>`
    })
    imageContainer.innerHTML = content
    showImgDelete(false)
}

const showImgDelete = (cond = true) => {
    let imgDel = imageContainer.getElementsByClassName('img-del')
    imgDel = [].slice.call(imgDel)
    imgDel.forEach(img => {
        cond ? img.style.display = '' : img.style.display = 'none'
    })
}

const showEditButton = (cond = false) => {
    let editButton = document.getElementsByClassName('btn-edit')
    editButton = [].slice.call(editButton)
    editButton.forEach(btn => {
        cond ? btn.style.display = '' : btn.style.display = 'none'
    })
}

const disableAllInput = (cond = true) => {
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
}

const setUkuranLama = () => {
    formUkuran.innerHTML = null
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

produkEdit.addEventListener('click', (e) => {
    produkEdit.disabled = true
    showImgDelete()
    disableAllInput(false)
    backButton.innerText = 'Batal'
    showEditButton(true)
    delButton.disabled = true
    editMode = true
})

backButton.addEventListener('click', () => {
    !editMode ? window.location.replace(`${baseURL}/admin/produk`) : fetchProduk()
})