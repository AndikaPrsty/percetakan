moment.locale('id')
const urlParams = new URLSearchParams(window.location.search);
const id_pesanan = urlParams.get('orderId');
const baseURL = window.location.origin

let pesanan

let timeline = document.getElementById('timeline')



const fetchPesanan = async () => {
    let res = await fetch(`${baseURL}/api/pesanan?orderId=${id_pesanan}`)
    res = await res.json()
    console.log(res)
    pesanan = res[0]
    setLogPesanan()
    Swal.close()
}

const setLogPesanan = () => {
    pesanan.log.forEach(log => {

        timeline.innerHTML += `
        <div class="time-label">
         <span class="bg-red">${moment('2020-11-06 15:27:51').fromNow()}</span>
        </div>
        <div>
            <i class="fas fa-info bg-blue"></i>
            <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i>${moment(log.created_at).format('LT')}</span>
                <h3 class="timeline-header">Sistem</h3>

                <div class="timeline-body">
                    ${log.log}
                </div>
            </div>
        </div>
`
    })
}



fetchPesanan()