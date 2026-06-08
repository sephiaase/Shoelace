/* ── Navigation ── */
  function navigate(page, el) {
    document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    document.getElementById('page-' + page).classList.add('active');
    if (el) el.classList.add('active');

    // NOTE: menu submenu persediaan tidak ada di index.html,
    // jadi kita tidak memanggil elemen yang tidak tersedia.
  }


  const toggle = document.getElementById('masterDataToggle');
  const menu = document.getElementById('masterDataMenu');
  const chevron = document.getElementById('masterChevron');

  if (toggle && menu && chevron) {
      toggle.addEventListener('click', () => {
          menu.classList.toggle('open');
          chevron.classList.toggle('rotate');
      });
  }

  function toggleSub(el) {
    const subId = el.getAttribute('data-sub');
    const sub = document.getElementById(subId);
    const toggle = el.querySelector('.nav-toggle');
    sub.classList.toggle('open');
    toggle.classList.toggle('open');
  }
  

  /* ── Chart ── */
  const chartEl = document.getElementById('inventoryChart');
  if (chartEl) {
    const ctx = chartEl.getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep'],
      datasets: [{
        data: [1800000, 2700000, 2200000, 2900000, 1100000, 2400000, 1600000, 2600000, 1900000],
        backgroundColor: '#1a1916',
        borderRadius: 5,
        borderSkipped: false,
        barPercentage: 0.55,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            label: v => 'Rp ' + (v.raw/1000000).toFixed(1) + 'jt'
          }
        }
      },
      scales: {
        y: {
          grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
          ticks: {
            font: { family: 'DM Sans', size: 11 },
            color: '#9e9d97',
            callback: v => (v/1000000).toFixed(0) + 'jt'
          },
          border: { display: false }
        },
        x: {
          grid: { display: false },
          ticks: { font: { family: 'DM Sans', size: 11 }, color: '#9e9d97' },
          border: { display: false }
        }
      }
    }
  })
};

  /* ── Pagination buttons ── */
  document.querySelectorAll('.pagination').forEach(pag => {
    pag.querySelectorAll('.page-btn').forEach(btn => {
      if (!isNaN(btn.textContent.trim())) {
        btn.addEventListener('click', () => {
          pag.querySelectorAll('.page-btn').forEach(b => b.classList.remove('active'));
          btn.classList.add('active');
        });
      }
    });
  });

  /* Persediaan Features */

  // Data mock inventori (contoh dari tabel statis sebelumnya)
  const inventoryEvents = {
    masuk: [
      { kode: 'B001', nama: 'Lace Lynelle', jenis: 'Flat Shoes', tanggal: 'Mei 1, 2026', jumlah: 12, status: 'Masuk' },
      { kode: 'B002', nama: 'Damelia', jenis: 'Wedges', tanggal: 'April 25, 2026', jumlah: 12, status: 'Masuk' },
      { kode: 'B003', nama: 'Amazara', jenis: 'Loafers', tanggal: 'April 18, 2026', jumlah: 20, status: 'Masuk' },
      { kode: 'B004', nama: 'Buccheri', jenis: 'Sandals', tanggal: 'April 17, 2026', jumlah: 10, status: 'Masuk' },
      { kode: 'B005', nama: 'Urban & Co', jenis: 'Ballet Flats', tanggal: 'April 9, 2026', jumlah: 14, status: 'Masuk' },
    ],
    keluar: [
      // contoh agar stok bisa menjadi tersedia/kosong
      { kode: 'B001', nama: 'Lace Lynelle', jenis: 'Flat Shoes', tanggal: 'Mei 1, 2026', jumlah: 6, status: 'Keluar' },
      { kode: 'B005', nama: 'Urban & Co', jenis: 'Ballet Flats', tanggal: 'April 9, 2026', jumlah: 14, status: 'Keluar' },
      { kode: 'B006', nama: 'Rubi', jenis: 'Ballet Flats', tanggal: 'Maret 11, 2026', jumlah: 18, status: 'Keluar' },
    ]
  };

  function statusPillMasukKeluar(text, kind){
    // kind: 'masuk' | 'keluar'
    // gunakan class yang sudah ada: pengiriman (biru)
    return `
      <span class="status pengiriman">${text}</span>
    `;
  }

  function statusPillStok(stok){
    if (stok > 0) {
      return `<span class="status tersedia">Tersedia</span>`;
    }
    return `<span class="status habis">Kosong</span>`;
  }

  // parse tanggal Indonesia sederhana agar bisa diurutkan (untuk demo)
  const months = {
    'Januari': 0, 'Februari': 1, 'Maret': 2, 'April': 3, 'Mei': 4, 'Juni': 5,
    'Juli': 6, 'Agustus': 7, 'September': 8, 'Oktober': 9, 'November': 10, 'Desember': 11
  };

  function toSortableDate(tgl){
    // format kira-kira: "Mei 1, 2026" atau "Maret 11, 2026" atau "April 25, 2026"
    const parts = tgl.replace(/\s+/g,' ').trim().split(' ');
    const monthName = parts[0];
    const dayPart = parts[1];
    const year = parts[2].replace(',', '');
    const day = parseInt(dayPart, 10);
    const monthIdx = months[monthName] ?? 0;
    return new Date(parseInt(year,10), monthIdx, day);
  }

  // Build tabel masuk/keluar
  function renderMasuk(){
    document.getElementById('inventoryTableHead').innerHTML = `
      <th>Nama Barang</th>
      <th>Jenis Barang</th>
      <th>Tanggal</th>
      <th>Jumlah</th>
      <th>Status</th>
    `;

    const tbody = document.getElementById('inventoryTableBody');
    tbody.innerHTML = inventoryEvents.masuk.map(ev => `
      <tr>
        <td>${ev.nama}</td>
        <td>${ev.jenis}</td>
        <td>${ev.tanggal}</td>
        <td>${ev.jumlah}</td>
        <td>${statusPillMasukKeluar('Masuk', 'masuk')}</td>
      </tr>
    `).join('');
  }

  function renderKeluar(){
    document.getElementById('inventoryTableHead').innerHTML = `
      <th>Nama Barang</th>
      <th>Jenis Barang</th>
      <th>Tanggal</th>
      <th>Jumlah</th>
      <th>Status</th>
    `;

    const tbody = document.getElementById('inventoryTableBody');
    tbody.innerHTML = inventoryEvents.keluar.map(ev => `
      <tr>
        <td>${ev.nama}</td>
        <td>${ev.jenis}</td>
        <td>${ev.tanggal}</td>
        <td>${ev.jumlah}</td>
        <td>${statusPillMasukKeluar('Keluar', 'keluar')}</td>
      </tr>
    `).join('');
  }

  // Build stok saat ini: stok = akumulasi masuk - akumulasi keluar sampai tanggal
  function renderStok(){
    document.getElementById('inventoryTableHead').innerHTML = `
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Jenis Barang</th>
      <th>Tanggal</th>
      <th>Jumlah</th>
      <th>Status</th>
    `;

    const allEvents = [
      ...inventoryEvents.masuk.map(e => ({...e, type:'masuk'})),
      ...inventoryEvents.keluar.map(e => ({...e, type:'keluar'})),
    ].sort((a,b) => toSortableDate(a.tanggal) - toSortableDate(b.tanggal));

    // daftar unik kode
    const kodeList = Array.from(new Set([...inventoryEvents.masuk, ...inventoryEvents.keluar].map(e => e.kode)));

    // kumpulkan tanggal unik dari event (agar tabel per tanggal seperti permintaan)
    const tanggalList = Array.from(new Set(allEvents.map(e => e.tanggal)))
      .sort((a,b) => toSortableDate(a) - toSortableDate(b));

    const metaByKode = new Map();
    [...inventoryEvents.masuk, ...inventoryEvents.keluar].forEach(e => {
      metaByKode.set(e.kode, { kode: e.kode, nama: e.nama, jenis: e.jenis });
    });

    const tbody = document.getElementById('inventoryTableBody');
    tbody.innerHTML = tanggalList.flatMap(tgl => {
      // hitung stok per kode sampai tanggal tgl
      const upto = allEvents.filter(ev => toSortableDate(ev.tanggal) <= toSortableDate(tgl));

      return kodeList.map(kode => {
        const meta = metaByKode.get(kode);
        const stok = upto.reduce((acc, ev) => {
          if (ev.kode !== kode) return acc;
          return acc + (ev.type === 'masuk' ? ev.jumlah : -ev.jumlah);
        }, 0);

        return `
          <tr>
            <td>${meta?.kode ?? kode}</td>
            <td>${meta?.nama ?? '-'}</td>
            <td>${meta?.jenis ?? '-'}</td>
            <td>${tgl}</td>
            <td>${stok}</td>
            <td>${statusPillStok(stok)}</td>
          </tr>
        `;
      });
    }).join('');
  }

  function showInventoryTab(tab, btn){
    document
      .querySelectorAll('.tab-btn')
      .forEach(el => el.classList.remove('active'));

    if (btn) btn.classList.add('active');

    if (tab === 'masuk') {
      renderMasuk();
      return;
    }

    if (tab === 'keluar') {
      renderKeluar();
      return;
    }

    if (tab === 'stok') {
      renderStok();
      return;
    }

    // "semua" -> default tampilkan stok
    renderStok();
  }

  const inventoryBody = document.getElementById('inventoryTableBody');
  if (inventoryBody) {
      showInventoryTab('semua');
  }

  const highStockTable = document.getElementById('highStockTable');
  if (highStockTable) {
      highStockTable.innerHTML =
        highStock.map(p => `
            <tr>
                <td>${p.kode}</td>
                <td>${p.nama}</td>
                <td>${p.stok}</td>
            </tr>
        `).join('');
  }

    /* MASTER DATA TAB */
    function showMasterTab(tab, btn){
        document
            .querySelectorAll('.master-content')
            .forEach(el => el.classList.remove('active'));

        // highlight submenu yang diklik
        document
            .querySelectorAll('.submenu-link')
            .forEach(el => el.classList.remove('active'));

        document
            .getElementById('master-' + tab)
            .classList.add('active');

        if (btn) btn.classList.add('active');
    }

    // dipakai oleh submenu sidebar Master Data
    function openMasterSection(tab, btn) {
      // pastikan halaman master terlihat (page master)
      document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
      document.getElementById('page-master').classList.add('active');

      // tampilkan konten master yang sesuai
      showMasterTab(tab, btn);
    }


    /* CRUD MODAL */
    function openModal(title){
        document.getElementById('modalTitle').innerText = title;
        document
            .getElementById('crudModal')
            .classList.add('show');
    }

    function closeModal(){
        document
            .getElementById('crudModal')
            .classList.remove('show');
    }

    function openDetail(name){
        openModal('Detail : ' + name);
    }

    function openDelete(name){
        openModal('Hapus : ' + name);
    }