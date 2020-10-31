const baseURL = window.location.origin
let kategoriKontainer = document.getElementById('kategori-container')

let kategori


const fetchKategori  = async () => {
    let res = await fetch(`${baseURL}/api/kategori`)
    res = await res.json()
    kategori = res.kategori
    setKategori()
    console.log(res)
}

const setKategori = () => {

    kategori.map(ktg => {
        if(ktg.gambar !== null){
            let div = document.createElement('div')
            div.classList.add('col-lg-4')
            div.classList.add('col-sm-6')
            div.innerHTML = `
            <a class="portfolio-box" href="${baseURL}/produk?kategori=${ktg.nama_kategori}" style="cursor:pointer;">
            <img class="img-fluid" src="/image/produk/${ktg.gambar}" alt="" />
            <div class="portfolio-box-caption">
            <div class="project-category text-white-50">Kategori</div>
            <div class="project-name">${ktg.nama_kategori}</div>
            </div>
            </a>
            <figcaption class="figure-caption py-2 bg-secondary text-white text-center">
            ${ktg.nama_kategori}
            </figcaption>
            `
            kategoriKontainer.appendChild(div)
        }
    })
}

fetchKategori()