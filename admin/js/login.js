
 // Sample data structure
 const data = {
    "Agusan del Norte": {
      "Butuan City": ["Barangay Ambago", "Barangay Amparo", "Barangay Anticala"],
      "Cabadbaran City": ["Barangay Bay-ang", "Barangay Caasinan", "Barangay Comagascas"],
      "Carmen": ["Barangay Abilan", "Barangay Cahayagan", "Barangay Gosoon"],
      "Jabonga": ["Barangay Bangonay", "Barangay Bunga", "Barangay Colorado"]
    },
    "Agusan del Sur": {
      "Bayugan City": ["Barangay Anahaw", "Barangay Bucac", "Barangay Calaitan"],
      "Bunawan": ["Barangay Consuelo", "Barangay Libertad", "Barangay Mambalili"],
      "Prosperidad": ["Barangay Awa", "Barangay Azpetia", "Barangay La Caridad"],
      "San Francisco": ["Barangay Alegria", "Barangay Pisaan", "Barangay Tagbina"]
    },
    "Basilan": {
      "Isabela City": ["Barangay Aguada", "Barangay Baluno", "Barangay Binuangan"],
      "Lamitan City": ["Barangay Balobo", "Barangay Bohesapa", "Barangay Campo Uno"],
      "Maluso": ["Barangay Abong-Abong", "Barangay Batu-Batu", "Barangay Townsite"],
      "Sumisip": ["Barangay Benembengan", "Barangay Baiwas", "Barangay Cabcaban"]
    },
    "Bukidnon": {
      "Malaybalay City": ["Barangay Aglayan", "Barangay Bangcud", "Barangay Cabangahan"],
      "Valencia City": ["Barangay Bagontaas", "Barangay Batangan", "Barangay Catumbalon"],
      "Don Carlos": ["Barangay Bocboc", "Barangay Calao", "Barangay Kibatang"],
      "Manolo Fortich": ["Barangay Alae", "Barangay Dalirig", "Barangay Damilag"]
    },
    "Camiguin": {
      "Mambajao": ["Barangay Agoho", "Barangay Anito", "Barangay Balbagon"],
      "Catarman": ["Barangay Bonbon", "Barangay Bura", "Barangay Catibac"],
      "Mahinog": ["Barangay Benoni", "Barangay Binatubo", "Barangay Hubangon"],
      "Sagay": ["Barangay Alangilan", "Barangay Bacnit", "Barangay Baring"]
    },
    "Compostela Valley": {
      "Mabini": ["Barangay Anitapan", "Barangay Cadunan", "Barangay Cuambog"],
      "Monkayo": ["Barangay Awao", "Barangay Banlag", "Barangay Baylo"],
      "Nabunturan": ["Barangay Antequera", "Barangay Basak", "Barangay Bukal"],
      "Pantukan": ["Barangay Bongabong", "Barangay Camingawan", "Barangay Kingking"]
    },
    "Cotabato": {
      "Kidapawan City": ["Barangay Amas", "Barangay Balindog", "Barangay Birada"],
      "Midsayap": ["Barangay Anonang", "Barangay Baguer", "Barangay Bual Sur"],
      "Pigcawayan": ["Barangay Anick", "Barangay Balogo", "Barangay Banucagon"],
      "Pikit": ["Barangay Balabak", "Barangay Balatican", "Barangay Batulawan"]
    },
    "Davao del Norte": {
      "Panabo City": ["Barangay A.O. Floirendo", "Barangay Buenavista", "Barangay Cacao"],
      "Samal City": ["Barangay Adecor", "Barangay Babak", "Barangay Caliclic"],
      "Tagum City": ["Barangay Apokon", "Barangay Bincungan", "Barangay Canocotan"],
      "Talaingod": ["Barangay Dagohoy", "Barangay Datu Davao", "Barangay Santo Niño"]
    },
    "Davao del Sur": {
      "Davao City": ["Barangay 1-A", "Barangay 2-A", "Barangay 3-A", "Barangay Marapang"],
      "Digos City": ["Barangay Aplaya", "Barangay Dawis", "Barangay Sinawilan"],
      "Bansalan": ["Barangay Altavista", "Barangay Anonang", "Barangay Bitaug"],
      "Hagonoy": ["Barangay Balutakay", "Barangay Clib", "Barangay Guihing"]
    },
    "Davao Occidental": {
      "Malita": ["Barangay Bito", "Barangay Bolila", "Barangay Buhangin"],
      "Santa Maria": ["Barangay Basiawan", "Barangay Buca", "Barangay Datu Daligasao"],
      "Don Marcelino": ["Barangay Calian", "Barangay Dalupan", "Barangay Kibulongan"],
      "Jose Abad Santos": ["Barangay Buayan", "Barangay Calian", "Barangay Culaman"]
    },
    "Davao Oriental": {
      "Mati City": ["Barangay Badas", "Barangay Bobon", "Barangay Calapagan"],
      "Baganga": ["Barangay Baculin", "Barangay Batawan", "Barangay Bobonao"],
      "Banaybanay": ["Barangay Cabangcalan", "Barangay Caganganan", "Barangay Calubihan"],
      "Boston": ["Barangay Cabasagan", "Barangay Carmen", "Barangay Cawayanan"]
    },
    "Dinagat Islands": {
      "San Jose": ["Barangay Aurelio", "Barangay Cuarinta", "Barangay Don Ruben"],
      "Basilisa": ["Barangay Asia", "Barangay Benglen", "Barangay Cabilisan"],
      "Cagdianao": ["Barangay Boa", "Barangay Cabalawan", "Barangay Del Pilar"],
      "Libjo": ["Barangay Albor", "Barangay Bayanihan", "Barangay Doña Helene"]
    },
    "Lanao del Norte": {
      "Iligan City": ["Barangay Abuno", "Barangay Bagong Silang", "Barangay Bonbonon"],
      "Tubod": ["Barangay Baroy", "Barangay Dalama", "Barangay Taguranao"],
      "Kapatagan": ["Barangay Bagong Silang", "Barangay Bel-is", "Barangay Concepcion"],
      "Lala": ["Barangay Abaga", "Barangay Andil", "Barangay Benian"]
    },
    "Lanao del Sur": {
      "Marawi City": ["Barangay Banggolo", "Barangay Basak Malutlut", "Barangay Bubonga Lilod Madaya"],
      "Balabagan": ["Barangay Bagoaingud", "Barangay Bagoingud", "Barangay Calilangan"],
      "Balindong": ["Barangay Bangco", "Barangay Cadayonan", "Barangay Lumbac Bacayawan"],
      "Bayang": ["Barangay Alog", "Barangay Bacayawan", "Barangay Bacayawan Ditsaan"]
    },
    "Maguindanao": {
      "Cotabato City": ["Barangay Bagua", "Barangay Kalanganan", "Barangay Poblacion"],
      "Buluan": ["Barangay Digal", "Barangay Lower Siling", "Barangay Maslabeng"],
      "Datu Odin Sinsuat": ["Barangay Badak", "Barangay Benolen", "Barangay Dinaig Proper"],
      "Sultan Kudarat": ["Barangay Banubo", "Barangay Buliok", "Barangay Dalumangcob"]
    },
    "Misamis Occidental": {
      "Oroquieta City": ["Barangay Canubay", "Barangay Dullan Norte", "Barangay Layawan"],
      "Ozamiz City": ["Barangay Aguada", "Barangay Bacolod", "Barangay Banadero"],
      "Tangub City": ["Barangay Bagumbang", "Barangay Balatacan", "Barangay Bintana"],
      "Baliangao": ["Barangay Misom", "Barangay Lumipac", "Barangay Landing"]
    },
    "Misamis Oriental": {
      "Cagayan de Oro City": ["Barangay Agusan", "Barangay Balulang", "Barangay Bonbon"],
      "Gingoog City": ["Barangay Anakan", "Barangay Lunao", "Barangay Odiongan"],
      "El Salvador": ["Barangay Amoros", "Barangay Bolisong", "Barangay Hinigdaan"],
      "Jasaan": ["Barangay Aplaya", "Barangay Bobuntugan", "Barangay Corrales"]
    },
    "North Cotabato": {
      "Kidapawan City": ["Barangay Amas", "Barangay Balindog", "Barangay Birada"],
      "M'lang": ["Barangay Bagontapay", "Barangay Bialong", "Barangay Dungos"],
      "Makilala": ["Barangay Batasan", "Barangay Bulakanon", "Barangay San Vicente"],
      "Midsayap": ["Barangay Anonang", "Barangay Baguer", "Barangay Bual Sur"]
    },
    "Sarangani": {
      "Alabel": ["Barangay Alegria", "Barangay Bagacay", "Barangay Baluntay"],
      "Glans": ["Barangay Batomelong", "Barangay Batulaki", "Barangay Bual"],
      "Kiamba": ["Barangay Katubao", "Barangay Kling", "Barangay Lagundi"],
      "Maitum": ["Barangay Kalaneg", "Barangay Kiambing", "Barangay Kipunget"]
    },
    "South Cotabato": {
      "General Santos City": ["Barangay Apopong", "Barangay Bula", "Barangay Labangal"],
      "Koronadal City": ["Barangay Assumption", "Barangay Avanceña", "Barangay Cacub"],
      "Polomolok": ["Barangay Bentung", "Barangay Cannery Site", "Barangay Glamang"],
      "T'boli": ["Barangay Aflek", "Barangay Basag", "Barangay Basag Caba"]
    },
    "Sultan Kudarat": {
      "Tacurong City": ["Barangay Buenaflor", "Barangay Calean", "Barangay EJC Montilla"],
      "Isulan": ["Barangay Bambad", "Barangay Kalawag I", "Barangay Lagandang"],
      "Lebak": ["Barangay Barurao I", "Barangay Barurao II", "Barangay Basak"],
      "Lutayan": ["Barangay Bayasong", "Barangay Blingkong", "Barangay Maguindanao"]
    },
    "Sulu": {
      "Jolo": ["Barangay Alat", "Barangay Asturias", "Barangay Bus-bus"],
      "Maimbung": ["Barangay Baligtang", "Barangay Bandong", "Barangay Bawisan"],
      "Pata": ["Barangay Daie", "Barangay Daungdong", "Barangay Latih"],
      "Parang": ["Barangay Alu Layag-Layag", "Barangay Bonbon", "Barangay Buton"]
    },
    "Surigao del Norte": {
      "Surigao City": ["Barangay Anomar", "Barangay Balibayon", "Barangay Bonifacio"],
      "Alegria": ["Barangay Alipao", "Barangay Anahaw", "Barangay Budlingin"],
      "Bacuag": ["Barangay Cabugao", "Barangay Cambuayon", "Barangay Campo"],
      "Burgos": ["Barangay Baybay", "Barangay Bitaug", "Barangay Poblacion"]
    },
    "Surigao del Sur": {
      "Bislig City": ["Barangay Poblacion", "Barangay Mangagoy", "Barangay San Isidro"],
      "Tandag City": ["Barangay Awasian", "Barangay Bioto", "Barangay Buenavista"],
      "Barobo": ["Barangay Amaga", "Barangay Bahi", "Barangay Dughan"],
      "Carmen": ["Barangay Bacolod", "Barangay Esperanza", "Barangay Poblacion"]
    },
    "Tawi-Tawi": {
      "Bongao": ["Barangay Balimbing", "Barangay Datu Amilhamja Jaafar", "Barangay Lakit Lakit"],
      "Panglima Sugala": ["Barangay Batu-Batu", "Barangay Baligtang", "Barangay Bato-bato"],
      "Mapun": ["Barangay Gujangan", "Barangay Lupa", "Barangay Paguipuilan"],
      "Sibutu": ["Barangay Ambolodevi", "Barangay Hadji Taha", "Barangay Talisay"]
    },
    "Zamboanga del Norte": {
      "Dipolog City": ["Barangay Barra", "Barangay Biasong", "Barangay Central"],
      "Dapitan City": ["Barangay Burgos", "Barangay Dawo", "Barangay Polo"],
      "Roxas": ["Barangay Balubo", "Barangay Denoyan", "Barangay Labuay"],
      "Sibutad": ["Barangay Delapa", "Barangay Calube", "Barangay Calit"]
    },
    "Zamboanga del Sur": {
      "Pagadian City": ["Barangay Balangasan", "Barangay Banale", "Barangay Bomba"],
      "Zamboanga City": ["Barangay Ayala", "Barangay Baliwasan", "Barangay Boalan"],
      "Molave": ["Barangay Alicia", "Barangay Bagong Silang", "Barangay Blancia"],
      "Labangan": ["Barangay Binayan", "Barangay Buco", "Barangay Dalapang"]
    },
    "Zamboanga Sibugay": {
      "Ipil": ["Barangay Bacalan", "Barangay Banca-banca", "Barangay Caparan"],
      "Kabasalan": ["Barangay Azusano", "Barangay Datu Tumanggong", "Barangay Lumbayao"],
      "Mabuhay": ["Barangay Bagong Silang", "Barangay Caliran", "Barangay Malinao"],
      "Malangas": ["Barangay Bacao", "Barangay Bangan", "Barangay La Dicha"]
    }
  };
  
    
    const provinceSelect = document.getElementById('province');
    const citySelect = document.getElementById('city');
    const barangaySelect = document.getElementById('barangay');
    
    // Populate provinces
    for (let province in data) {
        let option = document.createElement('option');
        option.value = province;
        option.text = province;
        provinceSelect.appendChild(option);
    }
    
    // Handle province change
    provinceSelect.addEventListener('change', function() {
        citySelect.innerHTML = '<option value="">Select City</option>';
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
        
        let cities = data[this.value];
        for (let city in cities) {
            let option = document.createElement('option');
            option.value = city;
            option.text = city;
            citySelect.appendChild(option);
        }
    });
    
    // Handle city change
    citySelect.addEventListener('change', function() {
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
        
        let barangays = data[provinceSelect.value][this.value];
        for (let i = 0; i < barangays.length; i++) {
            let option = document.createElement('option');
            option.value = barangays[i];
            option.text = barangays[i];
            barangaySelect.appendChild(option);
        }
    });
  
  //handle the password to show
  document.addEventListener('DOMContentLoaded', function () {
    // Toggle password visibility in the login modal
    const toggleLoginPassword = document.querySelector('#toggleLoginPassword');
    const loginPassword = document.querySelector('#loginPassword');
    
    if (toggleLoginPassword && loginPassword) {
        toggleLoginPassword.addEventListener('click', function () {
            const type = loginPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            loginPassword.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });
    }
  
    // Toggle password visibility in the registration modal
    const toggleRegisterPassword = document.querySelector('#toggleRegisterPassword');
    const registerPassword = document.querySelector('#registerPassword');
  
    if (toggleRegisterPassword && registerPassword) {
        toggleRegisterPassword.addEventListener('click', function () {
            const type = registerPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            registerPassword.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });
    }
  });
  