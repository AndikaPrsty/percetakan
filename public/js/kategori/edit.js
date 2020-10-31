let baseURL = window.location.origin
const urlParams = new URLSearchParams(window.location.search);
const id_kategori = urlParams.get('id');
let kategori

const navLink = document.getElementById('nav-link-masterdata')
const KategoriLink = document.getElementById('kategori-link')
navLink.classList.add('active')
navLink.parentElement.classList.add('menu-open')
KategoriLink.classList.add('active')

let nama_kategori = document.getElementById('nama_kategori')
let submit = document.getElementById('submit')
let back = document.getElementById('btn-back')

const showLoading = () => {
    Swal.fire({
        allowOutsideClick: false
    })
    Swal.showLoading()
}

const formErrors = (cond = false) => {
    !cond ? nama_kategori.classList.add('is-invalid') : nama_kategori.classList.add('is-valid')
}

const  alertSuccess = async (msg,cond,opt,redc) => {
   await Swal.fire({
        icon: cond ? 'success' : 'error',
        title: cond ? 'Berhasil...' :'Oops...',
        text: msg.errors ? Object.values(msg.errors).join(' | ') : msg,
      })
    opt ? fetchKategori() : null
    redc ? window.location.replace(`${baseURL}/admin/kategori`) : null
}
 
const updateKategori = async () => {
    showLoading()
    let kategoriData = {
        id:kategori.id,
        nama_kategori:nama_kategori.value
    }
    kategoriData = JSON.stringify(kategoriData)

    let res = await fetch(`${baseURL}/api/kategori/update`,{
        method:"POST",
        headers:{
            "Content-Type":"application/json",
        },
        body:kategoriData
    })
    res = await res.json()
    res.isValid ? formErrors(res.isValid) : formErrors(res.isValid)
    res.isValid ? alertSuccess('Berhasil mengubah data kategori',true,false,true) : alertSuccess(res,res.isValid,false,false)

}


const fetchKategori = async () => {
    let res = await fetch(`${baseURL}/api/kategori?id=${id_kategori}`)
    res = await res.json()
    res.kategori.length > 0 ? kategori = res.kategori[0] : alertSuccess('ID Kategori tidak valid',false,false,true)
    console.log(kategori)
    setKategori()
    Swal.close()
}

const setKategori = () => {
    nama_kategori.value = kategori.nama_kategori
}

fetchKategori()

submit.addEventListener('click',(e) => {
    e.preventDefault()
    updateKategori()
})

back.addEventListener('click',() => {
    window.location.replace(`${baseURL}/admin/kategori`)
})