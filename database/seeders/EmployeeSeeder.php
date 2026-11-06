// database/seeders/EmployeeSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $employees = [
            "LEONY CIPTA ANDRYA", "DIANA", "MESAYU NURLIANTI", "BINTANG RAMDHAN",
            "MARIA DONNA OCTAVIA", "ALIF ISLAM MAURIZA", "RIMNI MANULLANG", "AULIA RAMADHANI",
            "ELVARETTA SAVANA RAZAQI", "AHMAD BAEDOWI", "HALIYYA ZHAHWA ZOHAYNA", "YULIA HERVINA",
            "ANTASARI SIHOMBING", "SULTAN KEMAL PIAGIO", "WAHONO", "SUNYOTO",
            "ROMY SANTOSO", "AJI ADHITYA", "MUHAMAD JAMIL", "KUMAR JAYA",
            "ABANG FACHROZI RAHMAD", "DIKI PRATAMA", "ELISABET JUNIITA HIA", "SHAFIRA NURULITA R"
        ];

        foreach ($employees as $index => $name) {
            Employee::create([
                'employee_code' => 'EMP-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'name'          => $name,
                'status'        => 'Aktif'
            ]);
        }
    }
}