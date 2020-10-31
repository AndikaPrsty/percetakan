let produk, kategori, ukuran, harga, image
let baseURL = window.location.origin
let updatedProduk = {
    id_produk: null,
    nama_produk: null,
    id_kategori: null,
    ukuran: [],
    harga: []
}
let nomor = 1
let btnPreview
let newImages = []
let produkEdit = document.getElementById('edit-produk')
let btnTambahUkuran = document.getElementById('tambah-ukuran')
const urlParams = new URLSearchParams(window.location.search);
const id_produk = urlParams.get('id');
const formUkuran = document.getElementById('form-ukuran')
const imageContainer = document.getElementById('gambar-container')
const backButton = document.getElementById('btn-back')
const delButton = document.getElementById('btn-del')
const submit = document.getElementById('submit')
const addImageButton = document.getElementById('btn-img')
let formUkuranBaru = document.getElementById('form-ukuran-baru')
let nama_produkLama = document.getElementById('nama_produk')
let id_kategoriLama = document.getElementById('id_kategori')
let hargaLama, nama_ukuranLama, ukuranLama
let ukuran_baru = document.querySelectorAll('.ukuran_baru')
let nama_ukuran_baru = document.querySelectorAll('.nama_ukuran_baru')
let harga_baru = document.querySelectorAll('.harga_baru')
let btnUkuranToggle = document.getElementById('ukuran_baru_toggle')
let btnUkuranRemove = document.getElementById('ukuran_baru_remove')
let ukuranBaru = null
let editMode
let idFormUkuran = []


const showLoading = () => {
    Swal.fire({
        allowOutsideClick: false
    })
    Swal.showLoading()
}

const fetchProduk = async () => {
    delButton.disabled = false
    produkEdit.disabled = false
    editMode ? showLoading() : null
    backButton.innerText = 'Kembali'
    let res = await fetch(`${baseURL}/api/produk?id=${id_produk}`)
    res = await res.json()
    res.isValid ? null : alertSuccess(res.msg, false, false, true)
    produk = res.produk
    kategori = res.kategori
    ukuran = res.ukuran
    harga = res.harga
    image = res.gambar
    setKategori()
    setProdukLama()
    setUkuranLama()
    setGambar()
    disableAllInput()
    showImgDelete(false)
    showEditButton(false)
    editMode = false
    btnUkuranRemove.style.display = 'none'
    formUkuranBaru.style.display = 'none'
    Swal.close()
}

const alertConfirmation = async (msg, color) => {
    let res = await Swal.fire({
        title: msg,
        showCancelButton: true,
        confirmButtonText: 'Konfirmasi',
        cancelButtonText: 'Batal',
        confirmButtonColor: color ? color : 'red'
    })
    return res
}

const alertSuccess = async (msg, cond = true, opt = false, red = false) => {
    await Swal.fire({
        icon: cond ? 'success' : 'error',
        title: cond ? 'Berhasil' : 'Oops...',
        text: msg,
    })
    opt ? fetchProduk() : null
    red ? window.location.replace(`${baseURL}/admin/produk`) : null
}

const responseAlert = (msg, cond = false) => {
    let message
    cond ? message = msg : message = Object.values(msg.errors).join(' | ')
    Swal.fire({
        icon: cond ? 'success' : 'error',
        title: cond ? 'Success' : 'Oops...',
        text: message
    })

    // cond ? clearInput() : null
    // cond ? formValid(true) : formValid(false, msg.errors)
    // disableAllInput(false)

}

const deleteImage = async (id) => {
    showLoading()
    let res = await fetch(`${baseURL}/api/produk/delete_image?id_image=${id}`)
    res = await res.json()
    res.isDeleted ? alertSuccess(res.msg, true, true, false) : alertSuccess(res.msg, false, true, false)
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
    imageContainer.innerHTML = null
    image.forEach(img => {
        content += `<tr>
        <td>${img.gambar}</td>
        <td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
                <button onClick="previewGambar('${img.id}')" class="btn btn-preview btn-info mr-1"><i
                        class="fas fa-eye"></i></button>
                <button onClick="getImageId('${img.id}')" data-id=${img.id} class="btn btn-danger img-del"><i
                        class="fas fa-trash"></i></button>
            </div>
        </td>`
    })
    imageContainer.innerHTML = content
    image.length === 0 ? imageContainer.innerHTML = `<tr><td class="text-dark bg-secondary" style="text-align: center;" colspan="2">klik edit untuk menambah gambar</td></tr>` : null
    showImgDelete(false)
}

const getImageId = async (id) => {
    let res = await alertConfirmation('Apakah Anda Yakin Ingin Menghapus Gambar Ini ?', 'red')
    res.value ? deleteImage(id) : null
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
    ukuran.forEach((ukuran, i) => {

        let div = document.createElement('div')
        div.classList.add('row')
        div.innerHTML = `
        <div class="col-4">
            <div class="form-group">
                <label>Nama Ukuran</label>
                <input type="text" data-id="${ukuran.id}" required="true" value="${ukuran.nama_ukuran}" name="nama_ukuran"
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
                    <input type="text" data-id="${harga[i].id}" value="${ukuran.harga}" name="harga"
                        class="form-control harga form-produk old-ukuran">
                </div>
            </div>
        </div>`
        formUkuran.append(div)

        nama_ukuranLama = document.querySelectorAll('.nama_ukuran')
        ukuranLama = document.querySelectorAll('.ukuran')
        hargaLama = document.querySelectorAll('.harga')
    })

}

const tambahGambar = () => {
    if (newImages.length !== 0) {
        document.getElementById('img-form').style.display = ''
        let imageContainer = document.getElementById('img-container')
        let content = ''
        newImages.forEach((img) => {
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
    let image = newImages.filter(img => {
        return img.id === id
    })
    reader.readAsDataURL(image[0])
}

const hapusGambar = (id) => {
    let gambar = document.getElementById(`img-${id}`)
    id ? gambar.remove() : null
    newImages = newImages.filter(img => {
        return img.id !== id
    })
    newImages.length === 0 ? document.getElementById('img-form').style.display = 'none' : null
}

const tambahUkuranHarga = async () => {
    showLoading()
    ukuran_baru.forEach((uk, i) => {
        ukuranBaru.ukuran.push({
            nama_ukuran: nama_ukuran_baru[i].value,
            ukuran: uk.value,
            harga: harga_baru[i].value
        })
        ukuranBaru.harga.push({
            harga: harga_baru[i].value
        })
    })
    ukuranBaru = JSON.stringify(ukuranBaru)
    console.log(ukuranBaru)
    let res = await fetch(`${baseURL}/api/produk/ukuran_harga`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: ukuranBaru
    })
    res = await res.json()
    res.isValid ? hapusSemuaFormUkuran() : null
    return res
}

const updateProduk = async () => {
    showLoading()
    updatedProduk.nama_produk = nama_produkLama.value
    updatedProduk.id_kategori = id_kategoriLama.value
    updatedProduk.id_produk = produk.id
    updatedProduk.ukuran = []
    updatedProduk.harga = []
    ukuranLama.forEach((uk, i) => {
        updatedProduk.ukuran.push({
            id: nama_ukuranLama[i].dataset.id,
            nama_ukuran: nama_ukuranLama[i].value,
            ukuran: uk.value,
            id_kategori: id_kategoriLama.value,
            harga: hargaLama[i].value
        })
        updatedProduk.harga.push({
            id: hargaLama[i].dataset.id,
            harga: hargaLama[i].value
        })
    })
    let produkData = JSON.stringify(updatedProduk)
    let res = await fetch(`${window.location.origin}/api/produk/update`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: produkData
    })
    console.log(produkData)
    res = await res.json()
    res.isValid ? sendNewImages() : null
    !newImages.length > 0 && res.isValid ? sendNewImages() : null
    res.isValid ? alertSuccess('Berhasil memperbarui data produk', res.isValid, true, false) : responseAlert(res, res.isValid)
}

const deleteProduk = async () => {
    showLoading()
    let res = await fetch(`${baseURL}/api/produk/delete?id=${id_produk}`)
    res = await res.json()
    res.isDeleted ? alertSuccess(res.msg, res.isDeleted, false, true) : alertSuccess(res.msg, false, true, false)
}

const sendNewImages = () => {
    let formData = new FormData
    newImages.forEach(async img => {
        formData.append('image', img)
        formData.append('id_produk', produk.id)
        formData.append('id_kategori', id_kategoriLama.value)
        let res = await fetch(`${baseURL}/api/produk/upload`, {
            method: "POST",
            body: formData
        })
        res = await res.json()
    })

    newImages = []
    hapusGambar(null)
}

const tambahFormUkuranBaru = () => {
    let div = document.createElement('div')
    div.classList.add('row')
    div.classList.add(`ukuran-${nomor}`)
    let content = ''
    content += ` <div class="col-4">
    <div class="form-group">
        <label>Nama Ukuran</label>
        <input type="text" required="true" name="nama_ukuran" class="form-control nama_ukuran_baru"
            placeholder="Enter email">
    </div>
</div>
<div class="col-4">
    <div class="form-group">
        <label>Ukuran</label>
        <input type="text" required="true" name="ukuran" class="form-control ukuran_baru"
            placeholder="Enter email">
    </div>

</div>
<div class="col-4">
    <div class="form-group">
        <label>Harga (Rp)</label>
        <div class="input-group">
            <input type="text" class="form-control harga_baru">
            <span class="input-group-append">
                <button type="button" id=${nomor} onClick="hapusFormUkuran('ukuran-${nomor}')"
                    class="btn btn-danger btn-hapus-ukuran btn-flat"><i
                        class="fas fa-minus"></i></button>
            </span>
        </div>
    </div>
</div>`
    idFormUkuran.push({
        id: `ukuran-${nomor}`
    })
    div.innerHTML = content
    formUkuranBaru.append(div)
    ukuran_baru = document.querySelectorAll('.ukuran_baru')
    nama_ukuran_baru = document.querySelectorAll('.nama_ukuran_baru')
    harga_baru = document.querySelectorAll('.harga_baru')
}

const hapusFormUkuran = (id) => {
    console.log(id)
    let tombol = document.querySelector(`.${id}`)
    tombol.remove()
}

const hapusSemuaFormUkuran = () => {
    idFormUkuran.forEach(id => {
        document.getElementById(`.${id}`).remove()
    })
}

const showTambahUkuran = () => {
    document.getElementById('form-ukuran-baru').style.display = ''

}
fetchProduk()

btnTambahUkuran.addEventListener('click', () => {
    tambahFormUkuranBaru()
    nomor++
})


produkEdit.addEventListener('click', (e) => {
    produkEdit.disabled = true
    showImgDelete()
    disableAllInput(false)
    backButton.innerText = 'Batal'
    showEditButton(true)
    delButton.disabled = true
    document.getElementById('ukuran_baru_toggle').style.display = ''
    editMode = true
})

backButton.addEventListener('click', () => {
    !editMode ? window.location.replace(`${baseURL}/admin/produk`) : fetchProduk()
    document.getElementById('form-ukuran-baru').style.display = 'none'
    btnUkuranToggle.style.display = 'none'
})

delButton.addEventListener('click', async () => {
    let res = await alertConfirmation('Apakah Anda Yakin Ingin Menghapus Produk Ini?')
    res.value ? deleteProduk() : null
})

addImageButton.addEventListener('click', async () => {
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
    file ? file.id = Date.now() : null
    file ? newImages.push(file) : null
    tambahGambar()
})

btnUkuranToggle.addEventListener('click', (e) => {
    e.preventDefault()
    ukuranBaru = {
        id_produk: produk.id,
        id_kategori: produk.id_kategori,
        ukuran: [],
        harga: []
    }
    showTambahUkuran()
    btnUkuranToggle.style.display = 'none'
    btnUkuranRemove.style.display = ''
})

btnUkuranRemove.addEventListener('click', (e) => {
    e.preventDefault()
    btnUkuranToggle.style.display = ''
    btnUkuranRemove.style.display = 'none'
    formUkuranBaru.style.display = 'none'
    ukuranBaru = null
})

submit.addEventListener('click', async () => {
    let res = await alertConfirmation('Apakah Anda Yakin Ingin Memperbarui Produk Ini?', 'green')
    if (ukuranBaru === null) {
        if (res.value) {
            updateProduk()
        }
    } else {
        if (res.value) {
            let res = await tambahUkuranHarga()
            res.isValid ? updateProduk() : responseAlert(res, res.isValid)
        }
    }

})