<?php

namespace App\Helpers;

class DiagnosisHelper
{
   public static function calculateBMI($berat, $tinggi)
    {
        if (!$tinggi || $tinggi <= 0) {
            return 0; // atau bisa juga throw Exception jika ingin lebih ketat
        }

        $tinggiMeter = $tinggi / 100;
        return round($berat / ($tinggiMeter * $tinggiMeter), 1);
    }

    public static function gejalaPertanyaan()
{
    return [
        'G01' => [
            'pertanyaan' => 'Apakah ada anggota keluarga Anda yang mengalami kelebihan berat badan atau obesitas?',
            'opsi' => [
                'G02' => 'Iya dok, Aku memiliki keluarga yang obesitas',
                'G01' => 'Tidak, aku tidak memiliki keluarga yang obesitas',
            ],
        ],
        'G03' => [
            'pertanyaan' => 'Seberapa sering Anda mengonsumsi makanan cepat saji dalam seminggu?',
            'opsi' => [
                'G03' => 'Aku Sering makan fast food',
                'G04' => 'Aku jarang/tidak makan fast food',
            ],
        ],
        'G05' => [
            'pertanyaan' => 'Berapa kali dalam seminggu Anda mengonsumsi sayur-sayuran?',
            'opsi' => [
                'G05' => 'Aku tidak makan sayur dan buah ',
                'G06' => 'Aku sering makan sayur dan buah',
                'G07' => 'Aku sangat sering makan sayur dan buah',
            ],
        ],
        'G08' => [
            'pertanyaan' => 'Berapa kali Anda makan makanan utama dalam sehari (misalnya: sarapan, makan siang, dan makan malam)?',
            'opsi' => [
                'G08' => 'Aku makan hanya 1 kali sehari',
                'G09' => 'Aku makan 2-3 kali sehari',
                'G10' => 'Aku makan lebih dari 3 kali sehari',
            ],
        ],
        'G11' => [
            'pertanyaan' => 'Apakah Anda sering mengonsumsi makanan ringan atau camilan di antara waktu makan utama?',
            'opsi' => [
                'G11' => 'Aku tidak suka ngemil',
                'G12' => 'Aku ngemil sesekali saja',
                'G13' => 'Aku sering ngemil',
                'G14' => 'Aku setiap waktu ngemil',
            ],
        ],
        'G15' => [
            'pertanyaan' => 'Apakah Anda merokok? Jika ya, seberapa sering?',
            'opsi' => [
                'G15' => 'Aku Perokok aktif',
                'G16' => 'Aku tidak merokok',
            ],
        ],
        'G17' => [
            'pertanyaan' => 'Berapa banyak air atau cairan yang Anda konsumsi setiap harinya (dalam liter atau gelas)?', 
            'opsi' => [
                'G17' => 'Aku jarang minum air putih',
                'G18' => 'Aku minum air putih 1-2 liter/hari',
                'G19' => 'Aku minum air putih lebih dari 2 liter/hari',
            ],
        ],
        'G20' => [
            'pertanyaan' => 'Apakah Anda menghitung jumlah kalori yang Anda konsumsi setiap hari?', 
            'opsi' => [
                'G20' => 'Aku Menghitung kalori makanan yang aku konsumsi ',
                'G21' => 'Aku tidak menghitung kalori makanan yang aku konsumsi',
            ],
        ],
        'G22' => [
            'pertanyaan' => 'Apakah Anda rutin melakukan aktivitas fisik atau olahraga? Jika ya, jenis dan seberapa sering?', 
            'opsi' => [
                'G22' => 'Aku tidak pernah berolahraga',
                'G23' => 'Aku berolahraga 1-2 kali seminggu',
                'G24' => 'Aku berolahraga 3-4 kali seminggu',
                'G25' => 'Aku berolahraga 5-6 kali seminggu',
                'G26' => 'Aku berolahraga sangat rutin 6+ kali seminggu',
            ],
        ],
        'G27' => [
            'pertanyaan' => 'Berapa jam dalam sehari Anda habiskan untuk menggunakan perangkat teknologi seperti ponsel, komputer, atau menonton TV?', 
            'opsi' => [
                'G27' => 'Aku Scrolling media sosial 0-2 jam/hari',
                'G28' => 'Aku Scrolling media sosial 3-5 jam/hari',
                'G29' => 'Aku Scrolling media sosial lebih dari 5 jam/hari ',
            ],
        ],
        'G30' => [
            'pertanyaan' => 'Jenis transportasi apa yang paling sering Anda gunakan untuk bepergian sehari-hari? (misalnya: jalan kaki, sepeda, motor, mobil, transportasi umum)', 
            'opsi' => [
                'G30' => 'Aku menggunakan Mobil sebagai transportasi sehari-hari',
                'G31' => 'Aku menggunakan sepeda motor sebagai transportasi sehari-hari',
                'G32' => 'Aku menggunakan sepeda sebagai transportasi sehari-hari ',
                'G33' => 'Aku menggunakan transportasi umum sebagai transportasi sehari-hari  ',
                'G34' => 'Aku berjalan kaki sebagai transportasi sehari-hari ',
            ],
        ],


        
    ];
}

    private static function countMatch($rule, $gejala)
    {
        return count(array_intersect($rule, $gejala));
    }


    public static function ruleBase($gejala, $bmi)
    {
            $kodeGejala = $gejala;

            // Rule untuk masing-masing kategori
            $ruleUnderweight = [
                ['G01', 'G04', 'G06', 'G28'],
                ['G08', 'G13', 'G15', 'G31'],
                ['G17', 'G21', 'G22']
            ];

            $ruleNormal = [
                ['G04', 'G07', 'G09', 'G13'],
                ['G16', 'G19', 'G21', 'G24'],
                ['G28', 'G33', 'G01']
            ];

            $ruleOverweight = [
                ['G02', 'G04', 'G06', 'G09'],
                ['G13', 'G16', 'G19', 'G21'],
                ['G25', 'G28', 'G30']
            ];

            $ruleObesity = [
                ['G02', 'G03', 'G05', 'G10', 'G13'],
                ['G15', 'G18', 'G21', 'G26'],
                ['G28', 'G30']
            ];

            // Minimum jumlah gejala cocok dalam rule agar dianggap valid
            $minMatch = 2;

            // Evaluasi berdasarkan BMI dan cocokkan gejala
            if ($bmi < 18.5) {
                foreach ($ruleUnderweight as $rule) {
                    if (self::countMatch($rule, $kodeGejala) >= $minMatch) {
                        return 'Underweight';
                    }
                }
            } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
                foreach ($ruleNormal as $rule) {
                    if (self::countMatch($rule, $kodeGejala) >= $minMatch) {
                        return 'Normal';
                    }
                }
            } elseif ($bmi >= 25 && $bmi <= 29.9) {
                foreach ($ruleOverweight as $rule) {
                    if (self::countMatch($rule, $kodeGejala) >= $minMatch) {
                        return 'Overweight';
                    }
                }
            } else {
                foreach ($ruleObesity as $rule) {
                    if (self::countMatch($rule, $kodeGejala) >= $minMatch) {
                        return 'Obesity';
                    }
                }
            }

            // Jika BMI masuk tapi tidak ada rule cocok, fallback ke kategori BMI
            if ($bmi < 18.5) return 'Underweight';
            if ($bmi <= 24.9) return 'Normal';
            if ($bmi <= 29.9) return 'Overweight';
            return 'Obesity';
    }


   public static function diagnose($request)
    {
        $nama = $request->input('nama');
        $usia = $request->input('umur');
        $gender = $request->input('gender');
        $berat = $request->input('berat');
        $tinggi = $request->input('tinggi');
        $gejalaDipilih = $request->input('gejala', []);

        // Hitung BMI
        $bmi = self::calculateBMI($berat, $tinggi);

        // Tentukan diagnosis berdasarkan input user
        $diagnosa = self::ruleBase($gejalaDipilih, $bmi);

        // Dapatkan rekomendasi diet dan serat
        $rekomendasi = self::dietRecommendation($diagnosa);
        $serat = self::fiberTable($usia, strtolower($gender), $diagnosa);

        // Daftar rule untuk pembuktian logika
        $rules = [
            'R01' => [
                ['G01', 'G04', 'G06', 'G28'],
                ['G08', 'G13', 'G15', 'G31'],
                ['G17', 'G21', 'G22'],
            ],
            'R02' => [
                ['G04', 'G07', 'G09', 'G13'],
                ['G16', 'G19', 'G21', 'G24'],
                ['G28', 'G33', 'G01'],
            ],
            'R03' => [
                ['G02', 'G04', 'G06', 'G09'],
                ['G13', 'G16', 'G19', 'G21'],
                ['G25', 'G28', 'G30'],
            ],
            'R04' => [
                ['G02', 'G03', 'G05', 'G10', 'G13'],
                ['G15', 'G18', 'G21', 'G26'],
                ['G28', 'G30'],
            ],
        ];


        // Cari rule yang diagnosis-nya cocok dan jumlah kecocokan gejala terbanyak
        $rule_id = null;
        $rule_gejala = [];
        $maxMatch = 0;

       foreach ($rules as $kode => $listKombinasi) {
            foreach ($listKombinasi as $syarat) {
                $matchedGejala = array_intersect($syarat, $gejalaDipilih);
                $matchCount = count($matchedGejala);
                $expectedDiagnosis = self::ruleBase($syarat, $bmi);

                $minMatch = 2;
                if ($expectedDiagnosis === $diagnosa && $matchCount >= $minMatch && $matchCount > $maxMatch) {
                    $rule_id = $kode;
                    $rule_gejala = $syarat;
                    $maxMatch = $matchCount;
                }
            }
        }


        $daftarGejalaDeskriptif = [];

        foreach ($rule_gejala as $kodeGejala) {
            foreach (self::gejalaPertanyaan() as $parent => $obj) {
                if (isset($obj['opsi'][$kodeGejala])) {
                    $daftarGejalaDeskriptif[] = $kodeGejala . ' (' . $obj['opsi'][$kodeGejala] . ')';
                }
            }
        }


        return [
            'nama' => $nama,
            'usia' => $usia,
            'gender' => $gender,
            'berat' => $berat,
            'tinggi' => $tinggi,
            'bmi' => $bmi,
            'kategori_bmi' => $diagnosa,
            'diagnosis' => $diagnosa,
            'rekomendasi_diet' => explode("\n", $rekomendasi),
            'fiber_recommendation' => $serat,
            'gejala_dipilih' => $gejalaDipilih,
            'rule_id' => $rule_id,
            'rule_gejala' => $rule_gejala,
            'rule_gejala_deskripsi' => $daftarGejalaDeskriptif,
        ];
    }



    private static function match($rule, $gejala)
    {
        foreach ($rule as $r) {
            if (!in_array($r, $gejala)) {
                return false;
            }
        }
        return true;
    }

    public static function dietRecommendation($diagnosa)
    {
        switch ($diagnosa) {
            case 'Underweight':
                return "Tingkatkan asupan kalori harian, makan lebih sering (5–6x sehari), konsumsi protein tinggi, karbohidrat kompleks, serta susu tinggi kalori untuk membantu peningkatan berat badan.\n\n"
                    . "✅ Protein: Telur, Dada Ayam, Daging Sapi, Ikan Tuna, Tempe, Tahu\n"
                    . "✅ Serat: Brokoli, Bayam, Wortel, Buncis\n"
                    . "✅ Karbohidrat: Nasi Merah, Kentang, Oatmeal, Ubi Jalar\n"
                    . "❌ Hindari: Makanan rendah nutrisi seperti soda diet, makanan cepat saji rendah kalori, snack kosong kalori.";
    
            case 'Overweight':
                return "Tingkatkan konsumsi serat hingga memenuhi Angka Kecukupan Gizi (AKG) harian:\n"
                    . "- Laki-laki usia 16–29 tahun: 37 gram/hari\n"
                    . "- Perempuan usia 19–29 tahun: 32 gram/hari\n"
                    . "Atur porsi makan, perbanyak konsumsi sayur dan buah, kurangi karbohidrat sederhana, tingkatkan aktivitas fisik ringan seperti jalan kaki 30 menit setiap hari.\n\n"
                    . "✅ Protein: Ikan, Ayam Tanpa Kulit, Tahu, Tempe\n"
                    . "✅ Serat: Bayam, Sawi, Brokoli, Wortel\n"
                    . "✅ Karbohidrat: Beras Merah, Jagung, Kentang Panggang\n"
                    . "❌ Hindari: Fast food > 1x/minggu, makanan olahan tinggi gula (soft drink, permen), gorengan, makanan tinggi lemak trans.";
    
            case 'Obesity':
                return "Lakukan diet rendah kalori ketat, defisit 500–1000 kkal/hari, perbanyak konsumsi serat 35g/hari, konsumsi protein rendah lemak, aktivitas fisik terstruktur bertahap minimal 30 menit per hari.\n\n"
                    . "✅ Protein: Dada Ayam, Ikan, Tahu, Tempe, Kacang-Kacangan\n"
                    . "✅ Serat: Bayam, Kacang Panjang, Daun Singkong, Tomat, Terong\n"
                    . "✅ Karbohidrat: Nasi Merah, Jagung, Ubi, Talas\n"
                    . "❌ Hindari: Gorengan, snack, junk food, minuman bersoda, minuman teh kemasan, es krim, boba, makanan tinggi karbohidrat sederhana seperti kue dan donat.";
    
            default:
                return "Pertahankan pola makan sehat dan olahraga rutin.";
        }
    }

    public static function fiberTable($umur, $gender, $diagnosa)
    {
            // Hanya hitung kebutuhan serat jika Overweight atau Obesity atau Underweight
        if (!in_array($diagnosa, ['Overweight', 'Obesity', 'Underweight'])) {
            return null; // atau bisa juga return '-' jika kamu ingin menampilkan teks kosong di UI
        }
        if ($gender == 'male') {
            if ($umur <= 18) return '38 gram serat/hari';
            if ($umur <= 50) return '38 gram serat/hari';
            return '30 gram serat/hari';
        } else { // female
            if ($umur <= 18) return '26 gram serat/hari';
            if ($umur <= 50) return '25 gram serat/hari';
            return '21 gram serat/hari';
        }
    }
}
