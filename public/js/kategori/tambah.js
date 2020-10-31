let baseURL = window.location.origin
let nama_kategori = document.getElementById('nama_kategori')
let submit = document.getElementById('submit')
let back = document.getElementById('btn-back')

Swal.close()

const showLoading = () => {
    Swal.fire({
        allowOutsideClick: false
    })
    Swal.showLoading()
}

const formErrors = (cond = false) => {
    !cond ? nama_kategori.classList.add('is-invalid') : nama_kategori.classList.add('is-valid')
}

const alertSuccess = async (msg, cond, redc) => {
    await Swal.fire({
        icon: cond ? 'success' : 'error',
        title: cond ? 'Berhasil...' : 'Oops...',
        text: msg.errors ? Object.values(msg.errors).join(' | ') : msg,
    })
    redc ? window.location.replace(`${baseURL}/admin/kategori`) : null
}

const addKategori = async () => {
    showLoading()
    let kategoriData = {
        nama_kategori :nama_kategori.value
    }

    kategoriData = JSON.stringify(kategoriData)

    let res = await fetch(`${baseURL}/api/kategori/create`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: kategoriData
    })
    res = await res.json()
    res.isValid ? alertSuccess('Berhasil Menambahkan Kategori',true,false) : alertSuccess(res,false)
    res.isValid ? formErrors(true) : formErrors(false)
    console.log(res)
}

submit.addEventListener('click', (e) => {
    e.preventDefault()
    addKategori()
})

back.addEventListener('click',() => {
    window.location.replace(`${baseURL}/admin/kategori`)
})