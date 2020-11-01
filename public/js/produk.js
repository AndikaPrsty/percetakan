const urlParams = new URLSearchParams(window.location.search);
const nama_kategori = urlParams.get('kategori');
const baseURL = window.location.origin
let produk

let produkContainer = document.getElementById('produk-container')
let kategoriLabel = document.getElementById('kategori-label')


const fetchProduk = async () => {
    let res = await fetch(`${baseURL}/api/produk?kategori=${nama_kategori}`)
    res = await res.json()
    res.length === 0 ? window.location.replace(baseURL) : produk = res
    kategoriLabel.innerText = nama_kategori
    setProduk()
}

const setProduk = () => {
    produk.forEach((prod,i) => {
        let div = document.createElement('div')
        div.classList.add('col-lg-4')
        div.classList.add('col-sm-6')
        div.innerHTML = `
        <div class="card">
        <div class="card-header">
            <h4 class="h4 text-center">${prod.nama_produk}</h4>
        </div>
        <div class="card-body p-0">
            <div id="carouselExampleIndicators${i}" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators" id="image-indicators-${i}">
                </ol>
                <div class="carousel-inner" id="image-container-${i}">
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators${i}" role="button"
                    data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators${i}" role="button"
                    data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <figcaption class="figure-caption py-2 bg-secondary text-white text-center">
        Kemasan Makanan
    </figcaption>`
    produkContainer.append(div)
    })

    setProdukImage()
}

const setProdukImage = () => {
    produk.forEach((prod,i) => {
        let imageContainer = document.getElementById(`image-container-${i}`)
        prod.gambar.forEach((img,j) => {
            let div = document.createElement('div')
            div.classList.add('carousel-item')
            j === 0 ? div.classList.add('active') : null
            div.innerHTML += `<img class="d-block w-100 p-0" src="/image/produk/${img.gambar}">`
            imageContainer.append(div)
        })
    })
    produk.forEach((prod,i) => {
        let imageIndicators = document.getElementById(`image-indicators-${i}`)
        prod.gambar.forEach((img,j) => {
            imageIndicators.innerHTML += `<li data-target="#carouselExampleIndicators${i}" data-slide-to="${j}"
            class="bg-dark ${j === 0 ? 'active' : null}">
        </li>`
        })
    })
}


fetchProduk()