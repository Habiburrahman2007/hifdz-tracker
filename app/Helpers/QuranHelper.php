<?php

namespace App\Helpers;

class QuranHelper
{
    /**
     * All 114 surahs with juz, ayat count, and approximate lines
     * Format: [number, name, juz, ayat_count, lines_approx]
     */
    public static function getSurahs(): array
    {
        return [
            [1, 'Al-Fatihah', 1, 7, 7],
            [2, 'Al-Baqarah', 1, 286, 188],
            [3, 'Ali \'Imran', 3, 200, 130],
            [4, 'An-Nisa', 4, 176, 129],
            [5, 'Al-Maidah', 6, 120, 93],
            [6, 'Al-An\'am', 7, 165, 115],
            [7, 'Al-A\'raf', 8, 206, 144],
            [8, 'Al-Anfal', 9, 75, 56],
            [9, 'At-Tawbah', 10, 129, 99],
            [10, 'Yunus', 11, 109, 79],
            [11, 'Hud', 11, 123, 87],
            [12, 'Yusuf', 12, 111, 78],
            [13, 'Ar-Ra\'d', 13, 43, 35],
            [14, 'Ibrahim', 13, 52, 39],
            [15, 'Al-Hijr', 14, 99, 54],
            [16, 'An-Nahl', 14, 128, 93],
            [17, 'Al-Isra', 15, 111, 76],
            [18, 'Al-Kahf', 15, 110, 80],
            [19, 'Maryam', 16, 98, 58],
            [20, 'Ta-Ha', 16, 135, 80],
            [21, 'Al-Anbiya', 17, 112, 77],
            [22, 'Al-Hajj', 17, 78, 61],
            [23, 'Al-Mu\'minun', 18, 118, 72],
            [24, 'An-Nur', 18, 64, 57],
            [25, 'Al-Furqan', 18, 77, 54],
            [26, 'Ash-Shu\'ara', 19, 227, 110],
            [27, 'An-Naml', 19, 93, 70],
            [28, 'Al-Qasas', 20, 88, 75],
            [29, 'Al-Ankabut', 20, 69, 56],
            [30, 'Ar-Rum', 21, 60, 46],
            [31, 'Luqman', 21, 34, 29],
            [32, 'As-Sajdah', 21, 30, 22],
            [33, 'Al-Ahzab', 21, 73, 59],
            [34, 'Saba', 22, 54, 43],
            [35, 'Fatir', 22, 45, 38],
            [36, 'Ya-Sin', 22, 83, 52],
            [37, 'As-Saffat', 23, 182, 85],
            [38, 'Sad', 23, 88, 54],
            [39, 'Az-Zumar', 23, 75, 67],
            [40, 'Ghafir', 24, 85, 72],
            [41, 'Fussilat', 24, 54, 50],
            [42, 'Ash-Shura', 25, 53, 48],
            [43, 'Az-Zukhruf', 25, 89, 65],
            [44, 'Ad-Dukhan', 25, 59, 30],
            [45, 'Al-Jathiyah', 25, 37, 31],
            [46, 'Al-Ahqaf', 26, 35, 35],
            [47, 'Muhammad', 26, 38, 32],
            [48, 'Al-Fath', 26, 29, 27],
            [49, 'Al-Hujurat', 26, 18, 18],
            [50, 'Qaf', 26, 45, 29],
            [51, 'Adh-Dhariyat', 26, 60, 31],
            [52, 'At-Tur', 27, 49, 28],
            [53, 'An-Najm', 27, 62, 33],
            [54, 'Al-Qamar', 27, 55, 30],
            [55, 'Ar-Rahman', 27, 78, 32],
            [56, 'Al-Waqi\'ah', 27, 96, 40],
            [57, 'Al-Hadid', 27, 29, 31],
            [58, 'Al-Mujadila', 28, 22, 25],
            [59, 'Al-Hashr', 28, 24, 24],
            [60, 'Al-Mumtahanah', 28, 13, 17],
            [61, 'As-Saf', 28, 14, 12],
            [62, 'Al-Jumu\'ah', 28, 11, 10],
            [63, 'Al-Munafiqun', 28, 11, 10],
            [64, 'At-Taghabun', 28, 18, 15],
            [65, 'At-Talaq', 28, 12, 14],
            [66, 'At-Tahrim', 28, 12, 12],
            [67, 'Al-Mulk', 29, 30, 22],
            [68, 'Al-Qalam', 29, 52, 29],
            [69, 'Al-Haqqah', 29, 52, 25],
            [70, 'Al-Ma\'arij', 29, 44, 22],
            [71, 'Nuh', 29, 28, 17],
            [72, 'Al-Jinn', 29, 28, 20],
            [73, 'Al-Muzzammil', 29, 20, 14],
            [74, 'Al-Muddaththir', 29, 56, 29],
            [75, 'Al-Qiyamah', 29, 40, 18],
            [76, 'Al-Insan', 29, 31, 21],
            [77, 'Al-Mursalat', 29, 50, 24],
            [78, 'An-Naba', 30, 40, 22],
            [79, 'An-Nazi\'at', 30, 46, 23],
            [80, '\'Abasa', 30, 42, 18],
            [81, 'At-Takwir', 30, 29, 13],
            [82, 'Al-Infitar', 30, 19, 9],
            [83, 'Al-Mutaffifin', 30, 36, 18],
            [84, 'Al-Inshiqaq', 30, 25, 12],
            [85, 'Al-Buruj', 30, 22, 12],
            [86, 'At-Tariq', 30, 17, 9],
            [87, 'Al-A\'la', 30, 19, 9],
            [88, 'Al-Ghashiyah', 30, 26, 12],
            [89, 'Al-Fajr', 30, 30, 16],
            [90, 'Al-Balad', 30, 20, 10],
            [91, 'Ash-Shams', 30, 15, 8],
            [92, 'Al-Layl', 30, 21, 10],
            [93, 'Ad-Duha', 30, 11, 6],
            [94, 'Ash-Sharh', 30, 8, 4],
            [95, 'At-Tin', 30, 8, 5],
            [96, 'Al-Alaq', 30, 19, 9],
            [97, 'Al-Qadr', 30, 5, 4],
            [98, 'Al-Bayyinah', 30, 8, 9],
            [99, 'Az-Zalzalah', 30, 8, 5],
            [100, 'Al-Adiyat', 30, 11, 6],
            [101, 'Al-Qari\'ah', 30, 11, 6],
            [102, 'At-Takathur', 30, 8, 4],
            [103, 'Al-Asr', 30, 3, 3],
            [104, 'Al-Humazah', 30, 9, 5],
            [105, 'Al-Fil', 30, 5, 4],
            [106, 'Quraysh', 30, 4, 3],
            [107, 'Al-Ma\'un', 30, 7, 4],
            [108, 'Al-Kawthar', 30, 3, 2],
            [109, 'Al-Kafirun', 30, 6, 4],
            [110, 'An-Nasr', 30, 3, 3],
            [111, 'Al-Masad', 30, 5, 4],
            [112, 'Al-Ikhlas', 30, 4, 3],
            [113, 'Al-Falaq', 30, 5, 3],
            [114, 'An-Nas', 30, 6, 4],
        ];
    }

    public static function getSurahByNumber(int $number): ?array
    {
        $surahs = self::getSurahs();
        foreach ($surahs as $surah) {
            if ($surah[0] === $number) {
                return $surah;
            }
        }
        return null;
    }

    public static function getSurahsByJuz(int $juz): array
    {
        return array_filter(self::getSurahs(), fn($s) => $s[2] === $juz);
    }

    /**
     * Get total lines for juz 1-N
     */
    public static function getLinesForJuz(int $maxJuz): int
    {
        return $maxJuz * 20 * 15; // 20 pages * 15 lines
    }

    public static function getSurahOptions(): array
    {
        return array_map(fn($s) => [
            'number' => $s[0],
            'name' => $s[1],
            'juz' => $s[2],
            'ayat_count' => $s[3],
            'lines' => $s[4],
        ], self::getSurahs());
    }
}
