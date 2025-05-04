<?php

namespace App\Helpers;

class DiagnosisHelper
{
    public static function calculateBMI($berat, $tinggi)
    {
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

    public static function ruleBase($gejala, $bmi)
    {
        // Check berdasarkan kombinasi rules
        $kodeGejala = $gejala;

        if ($bmi < 18.5) {
            if (self::match(['G01', 'G04', 'G06','G28'], $kodeGejala)) return 'Underweight';
            if (self::match(['G08', 'G13', 'G15', 'G31'], $kodeGejala)) return 'Underweight';
            if (self::match(['G17', 'G21', 'G22'], $kodeGejala)) return 'Underweight';
            return 'Underweight';
        } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
            if (self::match(['G04', 'G07','G09','G13'], $kodeGejala)) return 'Normal';
            if (self::match(['G16', 'G19','G21','G24'], $kodeGejala)) return 'Normal';
            if (self::match(['G28', 'G33', 'G01'], $kodeGejala)) return 'Normal';
            return 'Normal';
        } elseif ($bmi >= 25 && $bmi <= 29.9) {
            if (self::match(['G02', 'G04', 'G06', 'G09'], $kodeGejala)) return 'Overweight';
            if (self::match(['G13', 'G16', 'G19', 'G21'], $kodeGejala)) return 'Overweight';
            if (self::match(['G25', 'G28', 'G30'], $kodeGejala)) return 'Overweight';
            return 'Overweight';
        } else { // BMI > 30
            if (self::match(['G02', 'G03', 'G05', 'G10', 'G13'], $kodeGejala)) return 'Obesity';
            if (self::match(['G15', 'G18', 'G21', 'G26'], $kodeGejala)) return 'Obesity';
            if (self::match(['G28', 'G30'], $kodeGejala)) return 'Obesity';
            return 'Obesity';
        }
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
