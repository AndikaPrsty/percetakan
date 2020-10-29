let formUkuran = document.getElementById('form-ukuran')
let formUkuranBaru
let kategoriInput = document.getElementById('id_kategori')
let tombolTambahUkuran = document.getElementById('tambah-ukuran')
let tombolHapusUkuran = document.querySelectorAll('.btn-hapus-ukuran')
let tombolTambahGambar = document.getElementById('btn-img')
let submit = document.getElementById('submit')
let nama_produk = document.getElementById('nama_produk')
let id_kategori = document.getElementById('id_kategori')
let harga = document.querySelectorAll('.harga')
let nama_ukuran = document.querySelectorAll('.nama_ukuran')
let ukuran = document.querySelectorAll('.ukuran')
let nomor = 0
let kategori
let images = []
let produk

const fetchKategori = async () => {
    let res = await fetch(`${window.location.origin}/api/kategori`)
    res = await res.json()
    kategori = res.kategori
    setKategori()
}

fetchKategori()

const setKategori = () => {
    let content = ''
    kategori.map(ktg => {
        return content += `<option value="${ktg.id}">${ktg.nama_kategori}</option>`
    })
    kategoriInput.innerHTML = content
    Swal.close()
}

const tambahFormUkuran = () => {
    let div = document.createElement('div')
    div.classList.add('row')
    div.classList.add(`ukuran-${nomor}`)
    let content = ''
    content += ` <div class="col-3">
    <div class="form-group">
        <label>Nama Ukuran</label>
        <input type="text" required="true" name="nama_ukuran" class="form-control nama_ukuran"
            placeholder="Enter email">
    </div>
</div>
<div class="col-3">
    <div class="form-group">
        <label>Ukuran</label>
        <input type="text" required="true" name="ukuran" class="form-control ukuran"
            placeholder="Enter email">
    </div>

</div>
<div class="col-3">
    <div class="form-group">
        <label>Harga (Rp)</label>
        <div class="input-group">
            <input type="text" class="form-control harga">
            <span class="input-group-append">
                <button type="button" id=${nomor} onClick="hapusFormUkuran('ukuran-${nomor}')"
                    class="btn btn-danger btn-hapus-ukuran btn-flat"><i
                        class="fas fa-minus"></i></button>
            </span>
        </div>
    </div>
</div>`
    div.innerHTML = content
    formUkuran.append(div)
    ukuran = document.querySelectorAll('.ukuran')
    nama_ukuran = document.querySelectorAll('.nama_ukuran')
    harga = document.querySelectorAll('.harga')
}

const hapusFormUkuran = (id) => {
    console.log(id)
    let tombol = document.querySelector(`.${id}`)
    tombol.remove()
}

const tambahGambar = () => {
    if (images.length !== 0) {
        document.getElementById('img-form').style.display = ''
        let imageContainer = document.getElementById('img-container')
        let content = ''
        images.forEach((img) => {
            content += `<span class="badge badge-secondary mr-1" id="img-${img.id}" onClick="tampilGambar(${img.id})" style="cursor:pointer;">${img.name}</span>`
        })
        imageContainer.innerHTML = content
    }

}

const tampilGambar = (id) => {
    const reader = new FileReader()
    reader.onload = async (e) => {
        let res = await Swal.fire({
            title: 'Gambar yang akan diupload',
            imageHeight: 420,
            showCancelButton: true,
            confirmButtonColor: 'red',
            confirmButtonText: `Hapus`,
            imageUrl: e.target.result,
            imageAlt: 'The uploaded picture'
        })
        res.value ? hapusGambar(id) : null
    }
    let image = images.filter(img => {
        return img.id === id
    })
    console.log(image)
    reader.readAsDataURL(image[0])
}

const hapusGambar = (id) => {
    let gambar = document.getElementById(`img-${id}`)
    gambar.remove()
    images = images.filter(img => {
        return img.id !== id
    })
    images.length === 0 ? document.getElementById('img-form').style.display = 'none' : null
}

tombolTambahUkuran.addEventListener('click', () => {
    tambahFormUkuran()
    nomor++
})

tombolTambahGambar.addEventListener('click', async () => {
    const {
        value: file
    } = await Swal.fire({
        title: 'Select image',
        input: 'file',
        inputAttributes: {
            'accept': 'image/*',
            'aria-label': 'Upload your profile picture'
        }
    })
    file.id = Date.now()
    file ? images.push(file) : null
    tambahGambar()
})

submit.addEventListener('click', (e) => {
    e.preventDefault()
    sendProduk()
})